<?php


namespace EasyAdmin\curd;

/**
 * 快速构建系统CURD
 * Class BuildCurd
 * @package EasyAdmin\curd
 */
class BuildCurd
{

    /**
     * 主表
     * @var string
     */
    protected $table;

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
    protected $relationArray = [
        'modelFilename' => '',//关联模型名
        'foreignkey'    => '',//表外键
        'primarykey'    => '',//关联模型表主键
    ];

    /**
     * 生成的控制器名
     * @var string
     */
    protected $controllerFilename;

    /**
     * 生成的模型文件名
     * @var string
     */
    protected $modelFilename;

    /**
     * 复选框字段
     * @var array
     */
    protected $setCheckboxFields;

    /**
     * 单选框字段
     * @var array
     */
    protected $setRadioFields;

    /**
     * 图片字段
     * @var array
     */
    protected $setImageFields;

    /**
     * 文件字段
     * @var array
     */
    protected $setFileFields;

    /**
     * 时间字段
     * @var array
     */
    protected $setDateFields;

    /**
     * 开关组件字段
     * @var array
     */
    protected $setSwitchFields;

    /**
     * 下拉选择字段
     * @var array
     */
    protected $setSelectFileds;

    /**
     * 富文本字段
     * @var array
     */
    protected $setEditorFields;

    /**
     * 排序字段
     * @var array
     */
    protected $setSortFields;

    /**
     * 忽略字段
     * @var array
     */
    protected $setIgnorefields;

    /**
     * 设置数据库主表
     * @param $name
     * @return $this
     */
    public function setTable($name)
    {
        $this->table = $name;
        return $this;
    }


}