<?php

namespace app\common\service;

use think\facade\App;
use think\facade\Db;

/**
 * 系统节点服务
 * Class NodeService
 * @package app\common\service
 */
class NodeService
{

    protected $config = [
        'system_node'             => 'system_node',                              // 节点表
        'admin_controller_object' => 'app\common\controller\AdBaseController',   // 后台控制器对象，必须继承才能获取到
        'read_module'             => ['admin'],                                  // 读取节点的模块
        'not_read_controller'     => ['Ajax'],                                   // 不读取该控制器
        'not_read_action'         => ['_', 'initialize'],                        // 不读取方法名首次出现该字符的方法
    ];

    /**
     * 更新节点以及清除失效节点方法
     * @return array
     */
    public function updateNode()
    {
        $autoNodeList = $this->getNodelist();
        $dbNodeList = Db::name($this->config['system_node'])->column('node');
        $inserNodelist = array_diff($autoNodeList, $dbNodeList);
        $deleteNodelist = array_diff($dbNodeList, $autoNodeList);

        if (empty($inserNodelist) && empty($deleteNodelist)) {
            return ['code' => 0, 'msg' => '暂无节点需要更新'];
        }

        Db::startTrans();
        try {

            if (!empty($inserNodelist)) {
                $createtime = time();
                foreach ($inserNodelist as $key => &$value) {
                    $value = [
                        'node'       => $value,
                        'createtime' => $createtime,
                    ];
                }
                Db::name($this->config['system_node'])->insertAll($inserNodelist);
            }

            if (!empty($deleteNodelist)) {
                Db::name($this->config['system_node'])
                    ->whereIn('node', $deleteNodelist)
                    ->delete();
            }

            Db::commit();
        } catch (\Exception $e) {
            Db::rollback();
            return ['code' => 0, 'msg' => '更新节点失败：' . $e->getMessage()];
        }
        return ['code' => 1, 'msg' => '更新节点成功'];
    }

    /**
     * 获取后台系统节点
     * @return array
     */
    public function getNodelist()
    {
        list($modules, $nodeList) = [$this->config['read_module'], []];
        foreach ($modules as $module) {
            $controllers = $this->getControllers($module);
            !empty($controllers) && $nodeList[] = humpToLine($module);
            foreach ($controllers as $key => $controller) {
                $actions = $this->getActions($module, $controller);
                if (!empty($actions)) {
                    $nodeList[] = humpToLine($module) . '/' . humpToLine(lcfirst($controller));
                    foreach ($actions as $action) {
                        $nodeList[] = humpToLine($module) . '/' . humpToLine(lcfirst($controller)) . '/' . humpToLine($action);
                    }
                } else {
                    unset($controllers[$key]);
                }
            }
            if (empty($controllers)) {
                $moduleKey = array_search(humpToLine($module), $nodeList);
                unset($nodeList[$moduleKey]);
            }
        }
        return $nodeList;
    }

    /**
     * 获取应用模块名
     * @return array|mixed
     */
    public function getModules()
    {
        list($appPath, $modules) = [App::getBasePath(), []];
        $listPath = glob($appPath . '/*');
        foreach ($listPath as $vo) {
            if (is_dir($vo)) {
                $module = str_replace($appPath . '/', '', $vo);
                !in_array($module, $this->config['not_read_module']) && $modules[] = $module;
            }
        }
        return $modules;
    }

    /**
     * 获取模块控制器名称
     * @param $module 模块名
     * @return array
     */
    public function getControllers($module)
    {
        list($modulePath, $controllers) = [App::getBasePath() . '/' . $module, []];
        $fileList = glob("{$modulePath}/controller/*");
        $this->buildListControllers($controllers, $fileList);
        $controllers = array_diff($controllers, $this->config['not_read_controller']);
        return $controllers;
    }

    /**
     * 构建无限层控制器
     * @param $controllers
     * @param $fileList
     */
    private function buildListControllers(&$controllers, $fileList)
    {
        foreach ($fileList as $vo) {
            if (is_dir($vo)) {
                $this->buildListControllers($controllers, glob("{$vo}/*"));
            } else {
                $className = explode("/controller/", $vo);
                $className = str_replace('.php', '', end($className));
                $controllers[] = str_replace('/', '.', $className);
            }
        }
    }

    /**
     * 获取模块、控制器中的方法名
     * @param $module 模块名
     * @param $controller 控制器名
     * @return array
     */
    public function getActions($module, $controller)
    {
        $controller = str_replace('.', '\\', $controller);
        list($classObject, $actions) = ["app\\{$module}\\controller\\{$controller}", []];
        $parentClassObject = get_parent_class($classObject);

        if (strpos($parentClassObject, $this->config['admin_controller_object']) !== false) {
            $actions = get_class_methods($parentClassObject);
            foreach ($actions as $key => $action) {
                foreach ($this->config['not_read_action'] as $notReadAction) {
                    if (strpos($action, $notReadAction) === 0) {
                        unset($actions[$key]);
                    }
                }
            }
        }
        return $actions;
    }
}