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

use think\Route;

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

        $this->registerRoutes(function (Route $route) {

            // 挂载插件的自定义路由
            $this->loadRoutes();

            // 路由脚本
            $execute = '\\EasyAddons\\Route::execute';

            // 注册控制器路由
            $route->rule("addons/:addon/[:controller]/[:action]", $execute)->middleware(Middleware::class);

        });

        // 绑定插件容器
        $this->app->bind('addons', Service::class);
    }

    public function boot()
    {

        // 加载插件
//        $this->loadApp();

//        dump($this->rou);


        // 加载插件命令集
        $this->loadCommands();

        // 加载插件系统服务
        $this->loadService();

    }

    /**
     * 加载插件
     */
    protected function loadApp()
    {
        return false;

        // todo 此处要实现获取当前插件名称才行
        $addon = 'email';

        $basePath = $this->addonsPath  . $addon . DIRECTORY_SEPARATOR;
        if (is_file($basePath . 'common.php')) {
            include_once $basePath . 'common.php';
        }

        $configPath = $this->app->getConfigPath();

        $files = [];

        if (is_dir($basePath . 'config')) {
            $files = array_merge($files, glob($basePath . 'config' . DIRECTORY_SEPARATOR . '*' . $this->app->getConfigExt()));
        } elseif (is_dir($configPath . $addon)) {
            $files = array_merge($files, glob($configPath .$addon . DIRECTORY_SEPARATOR . '*' . $this->app->getConfigExt()));
        }

        foreach ($files as $file) {
            $this->app->config->load($file, pathinfo($file, PATHINFO_FILENAME));
        }

        if (is_file($basePath . 'event.php')) {
            $this->app->loadEvent(include $basePath . 'event.php');
        }

        if (is_file($basePath . 'middleware.php')) {
            $this->app->middleware->import(include $basePath . 'middleware.php', 'app');
        }

        if (is_file($basePath . 'provider.php')) {
            $this->app->bind(include $basePath . 'provider.php');
        }

        // 加载应用默认语言包
        $this->app->loadLangPack($this->app->lang->defaultLangSet());
    }


    /**
     * 加载插件自定义命令行
     */
    protected function loadCommands(){
        $commands = [];
        $addonsDirs = scandir($this->addonsPath);
        foreach ($addonsDirs as $dir) {
            if (in_array($dir, ['.', '..'])) {
                continue;
            }
            $addonConsole = $this->addonsPath . $dir . DIRECTORY_SEPARATOR  . 'config' . DIRECTORY_SEPARATOR . 'console.php';
            if (is_file($addonConsole)) {
                $config = require $addonConsole;
                isset($config['commands']) && $commands = array_merge($commands, $config['commands']);
            }
        }
        !empty($commands) && $this->commands($commands);
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
            $addonDir = $this->addonsPath . $name . DIRECTORY_SEPARATOR;
            if (!is_dir($addonDir)) {
                continue;
            }

            if (!is_file($addonDir . 'Plugin.php')) {
                continue;
            }

            $service_file = $addonDir . 'Plugin.ini';
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