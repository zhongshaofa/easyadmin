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

/**
 * 系统节点服务类
 * Class NodeService
 * @package app\common\service
 */
class NodeService {

    /**
     * 刷新节点
     * @param array $module $module['admin','index'] 不传默认为所有模块
     * @return array
     */
    public static function refreshNode($module = []) {
        $save_all = [];
        $model = new SysNode;
        empty($module) && $module = self::getFolders();
        foreach ($module as $vo_m) {
            $parse_module = AuthService::parseNodeStr($vo_m);
            empty($model->where(['node' => $parse_module, 'type' => 1])->find()) && $save_all[] = ['node' => $parse_module, 'type' => 1, 'is_auth' => 0];
            $controller = self::getControllers('../application/' . $vo_m . '/controller');
            foreach ($controller as $vo_c) {
                if ($vo_c != 'Login') {
                    $parse_controller = AuthService::parseNodeStr($vo_m . '/' . $vo_c);
                    empty($model->where(['node' => $parse_controller, 'type' => 2])->find()) && $save_all[] = ['node' => $parse_controller, 'type' => 2, 'is_auth' => 0];
                    $action = self::getActions('app\\' . $vo_m . '\\controller\\' . $vo_c);
                    foreach ($action as $vo_a) {
                        $parse_action = AuthService::parseNodeStr($vo_m . '/' . $vo_c . '/' . $vo_a);
                        empty($model->where(['node' => $parse_action, 'type' => 3])->find()) && $save_all[] = ['node' => $parse_action, 'type' => 3, 'is_auth' => 0];
                    }
                }
            }
        }
        $model->saveAll($save_all);
        return $save_all;
    }

    public static function getNodeList($module = []) {
        $list = [];
        empty($module) && $module = self::getFolders();
        foreach ($module as $vo_m) {
            $parse_module = AuthService::parseNodeStr($vo_m);
            $list[] = $parse_module;
            $controller = self::getControllers('../application/' . $vo_m . '/controller');
            foreach ($controller as $vo_c) {
                if ($vo_c != 'Login') {
                    $parse_controller = AuthService::parseNodeStr($vo_m . '/' . $vo_c);
                    $list[] = $parse_controller;
                    $action = self::getActions('app\\' . $vo_m . '\\controller\\' . $vo_c);
                    foreach ($action as $vo_a) {
                        $parse_action = AuthService::parseNodeStr($vo_m . '/' . $vo_c . '/' . $vo_a);
                        $list[] = $parse_action;
                    }
                }
            }
        }
        return $list;
    }

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
     * @param string $dir '../application'
     * @return array
     */
    public static function getFolders($dir = '../application') {
        $pathList = glob($dir . '/*');
        $folder_list = [];
        foreach ($pathList as $vo) is_dir($vo) && $folder_list[] = str_replace($dir . '/', '', $vo);
        return $folder_list;
    }

    /**
     * 获取指定模块中的控制器
     * @param $dir '../application/admin/controller'
     * @return array
     */
    public static function getControllers($dir) {
        $pathList = glob($dir . '/*.php');
        $res = [];
        foreach ($pathList as $key => $value) $res[] = basename($value, '.php');
        return $res;
    }

    /**
     * 获取指定控制器中的方法
     * @param $className 类名称  'app\admin\controller\Node'
     * @param string $base 去除父类中存在的方法 'app\common\controller\BasicController'
     * @return array
     */
    public static function getActions($className, $base = 'app\common\controller\AdminController') {
        $methods = get_class_methods(new $className());
        $baseMethods = get_class_methods(new $base());
        $res = array_diff($methods, $baseMethods);
        return $res;
    }
}