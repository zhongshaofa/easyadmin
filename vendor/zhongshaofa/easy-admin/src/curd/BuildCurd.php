<?php


namespace EasyAdmin\curd;

use EasyAdmin\curd\exceptions\TableException;
use EasyAdmin\tool\CommonTool;
use think\facade\Db;

/**
 * 快速构建系统CURD
 * Class BuildCurd
 * @package EasyAdmin\curd
 */
class BuildCurd
{

    /**
     * 当前目录
     * @var string
     */
    protected $dir;

    /**
     * 应用目录
     * @var string
     */
    protected $rootDir;

    /**
     * 分隔符
     * @var string
     */
    protected $DS = DS;

    /**
     * 数据库名
     * @var string
     */
    protected $dbName;

    /**
     *  表前缀
     * @var string
     */
    protected $tablePrefix = 'ea';

    /**
     * 主表
     * @var string
     */
    protected $table;

    /**
     * 表注释名
     * @var string
     */
    protected $tableComment;

    /**
     * 主表列信息
     * @var array
     */
    protected $tableColumns;

    /**
     * 数据列表可见字段
     * @var string
     */
    protected $fields;

    /**
     * 是否删除模式
     * @var bool
     */
    protected $delete = false;

    /**
     * 是否强制覆盖
     * @var bool
     */
    protected $force = false;

    /**
     * 关联模型
     * @var array
     */
    protected $relationArray = [];

    /**
     * 控制器对应的URL
     * @var string
     */
    protected $controllerUrl;

    /**
     * 生成的控制器名
     * @var string
     */
    protected $controllerFilename;

    /**
     * 视图名
     * @var string
     */
    protected $viewFilename;

    /**
     * js文件名
     * @var string
     */
    protected $jsFilename;

    /**
     * 生成的模型文件名
     * @var string
     */
    protected $modelFilename;

    /**
     * 复选框字段
     * @var array
     */
    protected $checkboxFields;

    /**
     * 单选框字段
     * @var array
     */
    protected $radioFields;

    /**
     * 图片字段
     * @var array
     */
    protected $imageFields;

    /**
     * 文件字段
     * @var array
     */
    protected $fileFields;

    /**
     * 时间字段
     * @var array
     */
    protected $dateFields;

    /**
     * 开关组件字段
     * @var array
     */
    protected $switchFields;

    /**
     * 下拉选择字段
     * @var array
     */
    protected $selectFileds;

    /**
     * 富文本字段
     * @var array
     */
    protected $editorFields;

    /**
     * 排序字段
     * @var array
     */
    protected $sortFields;

    /**
     * 忽略字段
     * @var array
     */
    protected $ignorefields;

    /**
     * 相关生成文件
     * @var array
     */
    protected $fileList;

    public function __construct()
    {
        $this->tablePrefix = config('database.connections.mysql.prefix');
        $this->dbName = config('database.connections.mysql.database');
        $this->dir = __DIR__;
        $this->rootDir = root_path();
        return $this;
    }

    public function setTable($table)
    {
        $this->table = $table;
        try {

            // 获取表列注释
            $colums = Db::query("SHOW FULL COLUMNS FROM {$this->tablePrefix}{$this->table}");
            foreach ($colums as $vo) {
                $colum = [
                    'type'    => $vo['Type'],
                    'comment' => !empty($vo['Comment']) ? $vo['Comment'] : $vo['Field'],
                    'default' => $vo['Default'],
                ];
                $this->tableColumns[$vo['Field']] = $colum;
            }

            // 获取表名注释
            $tableSchema = Db::query("SELECT table_name,table_comment FROM information_schema.TABLES WHERE table_schema = 'easyadmin' AND table_name = '{$this->tablePrefix}{$this->table}'");
            $this->tableComment = (isset($tableSchema[0]['table_comment']) && !empty($tableSchema[0]['table_comment'])) ? $tableSchema[0]['table_comment'] : $this->table;
        } catch (\Exception $e) {
            throw new TableException($e->getMessage());
        }

        // 初始化默认控制器名
        $nodeArray = explode('_', $this->table);
        if (count($nodeArray) == 1) {
            $this->controllerFilename = ucfirst($nodeArray[0]);
        } else {
            foreach ($nodeArray as $k => $v) {
                if ($k == 0) {
                    $this->controllerFilename = "{$v}{$this->DS}";
                } else {
                    $this->controllerFilename .= ucfirst($v);
                }
            }
        }

        $this->buildViewJsUrl();

        // 初始化默认模型名
        $this->modelFilename = ucfirst(CommonTool::lineToHump($this->table));

        return $this;
    }

    public function setRelation($relationTable, $foreignKey, $primaryKey = null, $modelFilename = null)
    {
        if (!isset($this->tableColumns[$foreignKey])) {
            throw new TableException("主表不存在外键字段：{$foreignKey}");
        }
        try {
            $colums = Db::query("SHOW FULL COLUMNS FROM {$this->tablePrefix}{$relationTable}");
            $formatColums = [];
            foreach ($colums as $vo) {
                if (empty($primaryKey) && $vo['Key'] == 'PRI') {
                    $primaryKey = $vo['Field'];
                }
                $colum = [
                    'type'    => $vo['Type'],
                    'comment' => $vo['Comment'],
                    'default' => $vo['Default'],
                ];
                $formatColums[$vo['Field']] = $colum;
            }
            $relation = [
                'modelFilename' => empty($modelFilename) ? ucfirst(CommonTool::lineToHump($relationTable)) : $modelFilename,
                'foreignKey'    => $foreignKey,
                'primaryKey'    => $primaryKey,
                'tableColumns'  => $formatColums,
            ];
            $this->relationArray[$relationTable] = $relation;
        } catch (\Exception $e) {
            throw new TableException($e->getMessage());
        }
        return $this;
    }

    public function setControllerFilename($controllerFilename)
    {
        $this->controllerFilename = $controllerFilename;
        $this->buildViewJsUrl();
        return $this;
    }

    public function setFields($fields)
    {
        $this->fields = $fields;
        return $this;
    }

    public function setDelete($delete)
    {
        $this->delete = $delete;
        return $this;
    }

    public function setForce($force)
    {
        $this->force = $force;
        return $this;
    }

    protected function buildViewJsUrl()
    {
        $nodeArray = explode($this->DS, $this->controllerFilename);
        $formatArray = [];
        foreach ($nodeArray as $vo) {
            $formatArray[] = CommonTool::humpToLine(lcfirst($vo));
        }
        $this->controllerUrl = implode('.', $formatArray);
        $this->viewFilename = implode($this->DS, $formatArray);
        $this->jsFilename = $this->viewFilename;
        return $this;
    }

    public function render()
    {
        // 控制器
        $this->renderController();

        // 模型
        $this->renderModel();

        // 视图
        $this->renderView();

        // JS
        $this->renderJs();

        return $this;
    }

    protected function renderController()
    {
        $controllerFile = "{$this->rootDir}app{$this->DS}admin{$this->DS}controller{$this->DS}{$this->controllerFilename}.php";
        if (empty($this->relationArray)) {
            $controllerIndexMethod = '';
        } else {
            $relationCode = '';
            foreach ($this->relationArray as $key => $val) {
                $relation = CommonTool::lineToHump($key);
                $relationCode = "->withJoin('{$relation}', 'LEFT')\r";
            }
            $controllerIndexMethod = CommonTool::replaceTemplate(
                $this->getTemplate("controller{$this->DS}indexMethod"),
                [
                    'relationIndexMethod' => $relationCode,
                ]);
        }
        $controllerValue = CommonTool::replaceTemplate(
            $this->getTemplate("controller{$this->DS}controller"),
            [
                'controllerNamespace'  => "app/admin/controller/{$this->controllerFilename}",
                'controllerAnnotation' => $this->tableComment,
                'modelFilename'        => "app/admin/model/{$this->modelFilename}",
                'indexMethod'          => $controllerIndexMethod,
            ]);
        $this->fileList[$controllerFile] = $controllerValue;
        return $this;
    }

    protected function renderModel()
    {
        // 主表模型
        $modelFile = "{$this->rootDir}app{$this->DS}admin{$this->DS}model{$this->DS}{$this->modelFilename}.php";
        if (empty($this->relationArray)) {
            $relationList = '';
        } else {
            $relationList = '';
            foreach ($this->relationArray as $key => $val) {
                $relation = CommonTool::lineToHump($key);
                $relationCode = CommonTool::replaceTemplate(
                    $this->getTemplate("model{$this->DS}relation"),
                    [
                        'relationMethod' => $relation,
                        'relationModel'  => "/app/admin/model/{$val['modelFilename']}",
                        'foreignKey'     => $val['foreignKey'],
                        'primaryKey'     => $val['primaryKey'],
                    ]);
                $relationList .= $relationCode;
            }

        }
        $modelValue = CommonTool::replaceTemplate(
            $this->getTemplate("model{$this->DS}model"),
            [
                'modelNamespace' => "app/admin/model/{$this->modelFilename}",
                'table'          => $this->table,
                'deleteTime'     => isset($this->tableColumns['delete_time']) ? 'delete_time' : false,
                'relationList'   => $relationList,
            ]);
        $this->fileList[$modelFile] = $modelValue;

        // 关联模型
        foreach ($this->relationArray as $key => $val) {
            $relationModelFile = "{$this->rootDir}app{$this->DS}admin{$this->DS}model{$this->DS}{$val['modelFilename']}.php";
            $relationModelValue = CommonTool::replaceTemplate(
                $this->getTemplate("model{$this->DS}model"),
                [
                    'modelNamespace' => "app/admin/model/{$this->modelFilename}",
                    'table'          => $key,
                    'deleteTime'     => isset($val['tableColumns']['delete_time']) ? 'delete_time' : false,
                    'relationList'   => '',
                ]);
            $this->fileList[$relationModelFile] = $relationModelValue;
        }
        return $this;
    }

    protected function renderView()
    {
        // 列表页面
        $viewIndexFile = "{$this->rootDir}app{$this->DS}admin{$this->DS}view{$this->DS}{$this->viewFilename}{$this->DS}index.html";
        $viewIndexValue = CommonTool::replaceTemplate(
            $this->getTemplate("view{$this->DS}index"),
            [
                'controllerUrl' => $this->controllerUrl,
            ]);
        $this->fileList[$viewIndexFile] = $viewIndexValue;

        // 添加页面


        // 编辑页面

        return $this;
    }

    protected function renderJs()
    {
        $jsFile = "{$this->rootDir}public{$this->DS}static{$this->DS}admin{$this->DS}js{$this->DS}{$this->jsFilename}.js";

        $indexCols = '{type: "checkbox"},\r';

        // 主表字段
        foreach ($this->tableColumns as $field => $val) {
            $indexCols .= "{field: '{$field}', title: '{$val['comment']}'},\r";
        }

        $indexCols .= "{width: 250, title: '操作', templet: ea.table.tool}\r";

        $jsValue = CommonTool::replaceTemplate(
            $this->getTemplate("static{$this->DS}js"),
            [
                'controllerUrl' => $this->controllerUrl,
                'indexCols'     => $indexCols,
            ]);
        $this->fileList[$jsFile] = $jsValue;
        return $this;
    }

    protected function check()
    {
        return $this;
    }

    public function create()
    {
        $this->check();
        return true;
    }

    public function delete()
    {
        return true;
    }

    protected function getTemplate($name)
    {
        return file_get_contents("{$this->dir}{$this->DS}templates{$this->DS}{$name}.code");
    }

}