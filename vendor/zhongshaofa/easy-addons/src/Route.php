<?php

namespace EasyAddons;

use EasyAdmin\tool\CommonTool;
use think\facade\Config;
use think\exception\HttpException;

class Route
{

    public static function adminExecute($addon = null, $controller = null, $action = null)
    {
        return self::execute('admin',$addon,$controller,$action);
    }

    public static function homeExecute($addon = null, $controller = null, $action = null)
    {
        return self::execute('home',$addon,$controller,$action);
    }

    public static function apiExecute($addon = null, $controller = null, $action = null)
    {
        return self::execute('api',$addon,$controller,$action);
    }

    public static function execute($module, $addon = null, $controller = null, $action = null)
    {
        $app = app();
        $request = $app->request;

        $addonsRouteConfig = [];
        if (is_file($app->addons->getAddonsPath() . $addon . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'route.php')) {
            $addonsRouteConfig = include($app->addons->getAddonsPath() . $addon . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'route.php');
        }
        if (isset($addonsRouteConfig['url_route_must']) && $addonsRouteConfig['url_route_must']) {
            throw new HttpException(400, lang("插件{$addon}：路由规则有误, 已开启强制路由"));
        }

        empty($action) && $action = $app->route->config('default_action');

        if (empty($addon) || empty($controller) || empty($action)) {
            throw new HttpException(400, lang("插件{$addon}：路由规则有误"));
        }

        $request->addon = $addon;
        $request->action = $action;

        // 处理多层控制器
        $controllerArray = explode('.', $controller);
        $controllerArray[count($controllerArray) - 1] = CommonTool::lineToHump(ucfirst(end($controllerArray)));
        $controller = implode('.', $controllerArray);

        // 设置当前请求的控制器、操作方法
        $request->setController("{$module}.{$controller}")->setAction($action);

        // 重写视图基础路径
        $viewConfig = Config::get('view');
        $viewConfig['view_path'] = $app->addons->getAddonsPath() . $addon . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR;
        Config::set($viewConfig, 'view');

        // 生成控制器对象
        $controllerName = implode('\\', $controllerArray);
        $class = "\\addons\\{$addon}\\controller\\{$module}\\{$controllerName}";
        $instance = new $class($app);

        $vars = [];
        if (is_callable([$instance, $action])) {
            // 执行操作方法
            $call = [$instance, $action];
        } elseif (is_callable([$instance, '_empty'])) {
            // 空操作
            $call = [$instance, '_empty'];
            $vars = [$action];
        } else {
            // 操作不存在
            throw new HttpException(404, lang('addon action %s not found', [get_class($instance) . '->' . $action . '()']));
        }

        return call_user_func_array($call, $vars);
    }


}