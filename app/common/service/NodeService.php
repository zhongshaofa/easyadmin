<?php

namespace app\common\service;

use think\facade\App;
use think\facade\Db;
use think\facade\Env;

/**
 * 节点获取服务
 * Class NodeService
 * @package zhongsf\service
 */
class NodeService
{

    protected static $config = [
        'admin_node'              => 'system_node',                              // 节点表
        'admin_controller_object' => 'app\common\controller\AdBaseController',   // 后台控制器对象，必须继承才能获取到
        'not_read_module'         => ['common', 'index'],                                // 不读取节点的模块
        'not_read_action'         => ['_', 'initialize'],                       // 不读取方法名首次出现该字符的方法
    ];

    /**
     * 更新节点以及清除失效节点方法
     * @return array
     */
    public static function updateNode()
    {
        $autoNodeList = self::getNodelist();
        $dbNodeList = Db::name(self::$config['admin_node'])->column('node');
        $inserNodelist = array_diff($autoNodeList, $dbNodeList);
        $deleteNodelist = array_diff($dbNodeList, $autoNodeList);
        if (empty($inserNodelist) && empty($deleteNodelist)) {
            return ['code' => 0, 'msg' => '暂无节点需要更新'];
        }
        Db::startTrans();
        try {
            if (!empty($inserNodelist)) {
                foreach ($inserNodelist as $key => &$value) $value = ['node' => $value];
                Db::name(self::$config['admin_node'])->insertAll($inserNodelist);
            }
            if (!empty($deleteNodelist)) {
                Db::name(self::$config['admin_node'])->whereIn('node', $deleteNodelist)->delete();
            }
            Db::commit();
        } catch (\Exception $e) {
            Db::rollback();
            return ['code' => 0, 'msg' => '更新节点失败：' . $e->getMessage()];
        }
        return ['code' => 1, 'msg' => '更新节点成功'];
    }

    /**
     * 获取后台系统节点 必须继承 AdminController
     * @return array
     */
    public static function getNodelist()
    {
        list($modules, $nodeList) = [self::getModules(), []];
        foreach ($modules as $module) {
            $controllers = self::getControllers($module);
            !empty($controllers) && $nodeList[] = humpToLine($module);
            foreach ($controllers as $key => $controller) {
                $actions = self::getActions($module, $controller);
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
     * @return array
     */
    public static function getModules()
    {
        list($appPath, $modules) = [App::getBasePath(), []];
        $listPath = glob($appPath . '/*');
        foreach ($listPath as $vo) {
            if (is_dir($vo)) {
                $module = str_replace($appPath . '/', '', $vo);
                !in_array($module, self::$config['not_read_module']) && $modules[] = $module;
            }
        }
        return $modules;
    }

    /**
     * 获取模块控制器名称
     * @param $module 模块名
     * @return array
     */
    public static function getControllers($module)
    {
        list($modulePath, $controllers) = [App::getBasePath() . '/' . $module, []];
        $fileList = glob("{$modulePath}/controller/*");

        function getListControllers($controllers, $fileList)
        {
            foreach ($fileList as $vo) {
                if (is_dir($vo)) {
                    return getListControllers($controllers, glob("{$vo}/*"));
                } else {
                    $className = explode("/controller/", $vo);
                    $className = str_replace('.php', '', end($className));
                    $controllers[] = str_replace('/', '.', $className);
                }
            }
            return $controllers;
        }

        $controllers = getListControllers($controllers, $fileList);

        return $controllers;
    }

    /**
     * 获取模块、控制器中的方法名
     * @param $module 模块名
     * @param $controller 控制器名
     * @return array
     */
    public static function getActions($module, $controller)
    {
        $controller = str_replace('.','\\',$controller);
        list($classObject, $actions) = ["app\\{$module}\\controller\\{$controller}", []];
        $parentClassObject = get_parent_class($classObject);
        if (strpos($parentClassObject, self::$config['admin_controller_object']) !== false) {
            $actions = array_diff(get_class_methods($classObject), get_class_methods($parentClassObject));
            if($controller =='system.Menu'){
                die;
            }
            foreach ($actions as $key => $action) {
                foreach (self::$config['not_read_action'] as $notReadAction) {
                    if (strpos($action, $notReadAction) === 0) {
                        unset($actions[$key]);
                    }
                }
            }
        }
        return $actions;
    }
}