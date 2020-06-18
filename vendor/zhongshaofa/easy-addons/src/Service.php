<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
namespace EasyAddons;

use think\event\RouteLoaded;
use think\Route;
use think\helper\Str;
use think\facade\Config;
use think\facade\Cache;
use think\facade\Event;

/**
 * 插件服务
 * Class Service
 * @package think\addons
 */
class Service extends \think\Service
{

    protected $addonsPath;

    public function register()
    {

        $this->addonsPath = $this->getAddonsPath();

        // 加载插件系统服务
        $this->loadService();

        // 绑定插件容器
        $this->app->bind('addons', Service::class);

    }

    public function boot()
    {
        $this->registerRoutes(function (Route $route) {

//            $this->app->event->withEvent($this->app->config->get('app.with_event', true));

            // 路由脚本
            $execute = '\\EasyAddons\\Route::execute';

            // 注册插件公共中间件
            if (is_file($this->app->addons->getAddonsPath() . 'middleware.php')) {
                $this->app->middleware->import(include $this->app->addons->getAddonsPath() . 'middleware.php', 'route');
            }

            // 注册控制器路由
            $route->rule("addons/:addon/[:controller]/[:action]", $execute)->middleware(Middleware::class);

            // 挂载插件的自定义路由
            $this->loadRoutes();

        });
    }

    /**
     *  加载插件自定义路由文件
     */
    protected function loadRoutes()
    {
        $addonsDirs = scandir($this->addonsPath);
        foreach ($addonsDirs as $dir) {
            if (in_array($dir, ['.', '..'])) {
                continue;
            }
            $addonRouteDir = $this->addonsPath . $dir . DIRECTORY_SEPARATOR . 'route' . DIRECTORY_SEPARATOR;
            if (is_dir($addonRouteDir)) {
                $files = glob($addonRouteDir . '*.php');
                foreach ($files as $file) {
                    include $file;
                }
            }
        }
    }

    /**
     * 挂载插件服务
     */
    private function loadService()
    {
        $results = scandir($this->addonsPath);
        $bind = [];
        foreach ($results as $name) {
            if ($name === '.' or $name === '..') {
                continue;
            }
            if (is_file($this->addonsPath . $name)) {
                continue;
            }
            $addonDir = $this->addonsPath . $name . DIRECTORY_SEPARATOR;
            if (!is_dir($addonDir)) {
                continue;
            }

            if (!is_file($addonDir . ucfirst($name) . '.php')) {
                continue;
            }

            $service_file = $addonDir . 'service.ini';
            if (!is_file($service_file)) {
                continue;
            }
            $info = parse_ini_file($service_file, true, INI_SCANNER_TYPED) ?: [];
            $bind = array_merge($bind, $info);
        }
        $this->app->bind($bind);
    }

    /**
     * 获取 addons 路径
     * @return string
     */
    public function getAddonsPath()
    {
        $addonsPath = $this->app->getRootPath() . 'addons' . DIRECTORY_SEPARATOR;
        if (!is_dir($addonsPath)) {
            @mkdir($addonsPath, 0755, true);
        }
        return $addonsPath;
    }

}