<?php
// +----------------------------------------------------------------------
// | 99PHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018~2020 https://www.99php.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Mr.Chung <chung@99php.cn >
// +----------------------------------------------------------------------

namespace app\common\service;

use app\common\model\SysNode;
use think\Env;
use think\Db;

/**
 * 系统节点服务类
 * Class NodeService
 * @package app\common\service
 */
class NodeService {

    /**
     * 获取指定模块的所有节点,默认获取所有模块的所有节点(树形形状)
     * @param array $module $module['admin','index'] 不传默认为所有模块
     * @return array
     */
    public static function getNodeTree($module = []) {
        empty($module) && $module = self::getFolders();
        $node_list = [];
        foreach ($module as &$vo_m) {
            $controller = self::getControllers('../application/' . $vo_m . '/controller');
            foreach ($controller as &$vo_c) {
                if ($vo_c != 'Login') {
                    $action = self::getActions('app\\' . $vo_m . '\\controller\\' . $vo_c);
                    foreach ($action as &$vo_a) $vo_a = AuthService::parseNodeStr($vo_m . '/' . $vo_c . '/' . $vo_a);
                    !empty($action) && $node_list[AuthService::parseNodeStr($vo_m)][AuthService::parseNodeStr($vo_m . '/' . $vo_c)] = $action;
                }
            }
        }
        return $node_list;
    }

    /**
     * 获取指定目录下的所有文件夹名称
     * @param $dir
     * @return array
     */
    public static function getFolders($dir) {
        $pathList = glob($dir . '/*');
        $folder_list = [];
        foreach ($pathList as $vo) is_dir($vo) && $folder_list[] = str_replace($dir . '/', '', $vo);
        return $folder_list;
    }

    /**
     * 获取指定模块中的控制器
     * @param $dir
     * @return array|mixed
     */
    public static function getControllers($dir) {
        list($folders, $pathList, $controllerList) = [self::getFolders($dir), glob($dir . '\*.php'), []];
        foreach ($folders as $folder) {
            $pathFolders = glob("{$dir}\\{$folder}\\*.php");
            foreach ($pathFolders as $pathFolder) {
                $pathList[] = $pathFolder;
            }
        }
        foreach ($pathList as $vo) {
            $className = explode("\controller\\", $vo);
            $className = str_replace('.php', '', end($className));
            $className = str_replace('\\', '.', $className);
            $controllerList[] = $className;
        }
        return $controllerList;
    }

    /**
     * 获取控制器中的方法
     * @param $className
     * @return array|mixed
     */
    public static function getActions($className) {
        list($actions, $actionList) = [get_class_methods($className), []];
        if (!empty($actions)) {
            foreach ($actions as $action) {
                if (strpos($action, '_') !== 0 && $action !== 'initialize') {
                    $actionList[] = $action;
                }
            }
        }
        return $actionList;
    }

    /**
     * 获取系统节点
     * @param array $modules 模块名
     * @return array|mixed 节点列表
     */
    public static function getNodeList($modules = []) {
        list($nodeList, $appPath, $appNamespace) = [[], env('app_path'), env('app_namespace')];
        empty($modules) && $modules = self::getFolders($appPath);
        foreach ($modules as $module) {
            $nodeList[] = AuthService::parseNodeStr($module);
            $modulePath = "{$appPath}\\{$module}\\controller";
            $controllers = self::getControllers($modulePath);
            foreach ($controllers as $controller) {
                $nodeList[] = AuthService::parseNodeStr("{$module}/{$controller}");
                $controller_replace = str_replace('.', '\\', $controller);
                $controllerPath = "{$appNamespace}\\{$module}\\controller\\{$controller_replace}";
                $actions = self::getActions($controllerPath);
                foreach ($actions as $action) {
                    $nodeList[] = AuthService::parseNodeStr("{$module}/{$controller}/{$action}");
                }
            }
        }
        return $nodeList;
    }

    /**
     * 刷新系统节点
     * @param array $modules
     */
    public static function refreshNode($modules = []) {
        empty($modules) && $modules = self::getFolders(env('app_path'));
        list($nodeList, $insertNode) = [self::getNodeList($modules), []];
        foreach ($nodeList as $vo) {
            $nodeInfo = Db::name('SystemNode')->where(['node' => $vo])->find();
            if (empty($nodeInfo)) {
                list($nodeCount, $nodeType) = [substr_count($vo, '/'), 0];
                switch ($nodeCount) {
                    case 0:
                        $nodeType = 1;
                        break;
                    case 1:
                        $nodeType = 2;
                        break;
                    case 2:
                        $nodeType = 3;
                        break;
                }
                $insertNode[] = ['type' => $nodeType, 'node' => $vo];
            }
        }
        if (!empty($insertNode)) {
            Db::startTrans();
            try {
                Db::name('SystemNode')->insertAll($insertNode);
                Db::commit();
            } catch (\Exception $e) {
                Db::rollback();
                return ['code' => 1, 'msg' => $e->getMessage()];
            }
            return ['code' => 0, 'msg' => '节点刷新成功！'];
        } else {
            return ['code' => 1, 'msg' => '节点数据暂无变化！'];
        }
    }

    /**
     * 清除失效节点
     * @param array $modules
     */
    public static function cleanNode($modules = []) {
        empty($modules) && $modules = self::getFolders(env('app_path'));
        $nodeList = Db::name('SystemNode')->where(['is_auto' => 0])->select();
        $autoNodeList = self::getNodeList($modules);
        foreach ($nodeList as $voNode) {
            $is_exist = false;
            foreach ($autoNodeList as $voAutoNode) {
                $voNode['node'] == $voAutoNode && $is_exist = true;
            }
            $is_exist == false && $delete[] = $voNode['id'];
        }
        if (!empty($delete)) {
            Db::startTrans();
            try {
                Db::name('SystemNode')->delete($delete);
                Db::commit();
            } catch (\Exception $e) {
                Db::rollback();
                return ['code' => 1, 'msg' => $e->getMessage()];
            }
            return ['code' => 0, 'msg' => '清除失效节点成功！'];
        } else {
            return ['code' => 1, 'msg' => '无失效节点！'];
        }
    }
}