<?php

// +----------------------------------------------------------------------
// | EasyAdmin
// +----------------------------------------------------------------------
// | PHP交流群: 763822524
// +----------------------------------------------------------------------
// | 开源协议  https://mit-license.org 
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zhongshaofa/EasyAdmin
// +----------------------------------------------------------------------

namespace EasyAddons\driver;


class Tool
{

    /**
     * 获取路由定位
     * @param $dispatch
     * @return array
     */
    public static function getRoutePositionByDispatch($dispatch)
    {
        strpos($dispatch[0], '\\') === 0 && $dispatch[0] = substr($dispatch[0], 1);
        $routeArray = array_filter(explode('\\', $dispatch[0]));
        $module = $routeArray[1];
        $controllerArray = array_slice($routeArray, 3);
        $controllerArray[count($controllerArray) - 1] = lcfirst($controllerArray[count($controllerArray) - 1]);
        $controller = implode(DIRECTORY_SEPARATOR, $controllerArray);
        $action = $dispatch[1];
        return [$module, $controller, $action];
    }

}