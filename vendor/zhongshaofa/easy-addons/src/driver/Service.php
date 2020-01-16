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

use think\App;
use think\Console;
use think\exception\HttpException;
use think\facade\Config;
use think\facade\Env;
use think\Route;
use think\Service as BaseService;
use ReflectionClass;
use ReflectionMethod;
use EasyAddons\facade\Request;

/**
 * 插件服务
 * Class Service
 * @package EasyAddons\driver
 */
class Service extends BaseService
{

    /**
     * 插件路径
     * @var string
     */
    protected $addonsPath;

    /**
     * 安装的插件列表
     * @var array
     */
    protected $install = [];

    /**
     * 插件配置项
     * @var array
     */
    protected $config = [
        'autoload' => true,
        'path'     => 'addons',
    ];

    /**
     * 加载的插件文件
     * @var array
     */
    protected $autoloadFiles = [];

    /**
     * 当前安装的模块名
     * @var string
     */
    protected $module;

    /**
     * 当前请求控制器
     * @var string
     */
    protected $controller;

    /**
     * 当前请求的方法
     * @var string
     */
    protected $action;


    /**
     * 构造方法
     * Service constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->initialize();
    }

    /**
     * 初始化
     */
    protected function initialize()
    {
        // 加载配置项
        $configFile = config_path() . 'addons.php';
        if (is_file($configFile)) {
            $this->config = require $configFile;
        } else {
            $content = file_get_contents(root_path() . 'vendor/zhongshaofa/easy-addons/src/config.php');
            file_put_contents($configFile, $content);
        }

        // 判断文件夹是否存在
        $this->addonsPath = root_path('addons');
        if (!is_dir($this->addonsPath)) {
            mkdir($this->addonsPath);
        }

        // 加载安装插件
        $installFile = $this->addonsPath . DIRECTORY_SEPARATOR . 'install.php';
        if (is_file($installFile)) {
            $this->install = require $installFile;
        } else {
            file_put_contents($installFile, $this->getInstallContent());
        }
    }

    /**
     * 插件注册
     */
    public function register()
    {
        // 注册命令集
        $this->registerCommands();

        // 注册路由集合
        $this->registerAddonsRoutes();

        // TODO 自动加载插件,多文件下不知道会不会影响性能，后期观察进行修改
        $this->autoload();

        // 绑定插件容器
        $this->app->bind('addons', Service::class);
    }

    /**
     * 绑定路由
     * @param Route $route
     * @throws \ReflectionException
     */
    public function boot(Route $route)
    {
        $disPatch = $route->getName();
        $format = $this->formatRoute();
        if ($format === false) {
            return;
        }
        list($uri, $controller, $action) = $format;
        $route->rule('/' . $uri, "{$controller}@{$action}");
        $this->loadView();
        $this->loadApp();
    }

    /**
     * 注册插件路由
     */
    public function registerAddonsRoutes()
    {
        foreach ($this->install as $key => $val) {
            $file = $this->addonsPath . DIRECTORY_SEPARATOR . $key . DIRECTORY_SEPARATOR . 'route.php';
            is_file($file) && $this->loadRoutesFrom($file);
        }
    }

    /**
     * 注册插件指令集
     */
    public function registerCommands()
    {
        $commands = [];
        foreach ($this->install as $key => $val) {
            $file = $this->addonsPath . DIRECTORY_SEPARATOR . $key . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'console.php';
            if (is_file($file)) {
                $config = require $file;
                isset($config['commands']) && $commands = array_merge($commands, $config['commands']);
            }
        }
        !empty($commands) && $this->commands($commands);
    }

    /**
     * 自动加载已安装插件
     */
    protected function autoload()
    {
        if (!$this->config['autoload']) {
            $this->autoloadFiles = $this->readDirAllFiles($this->addonsPath);
            foreach ($this->autoloadFiles as $key => $autoloadFile) is_file($autoloadFile) && include_once $autoloadFile;
        }
    }

    /**
     * 加载应用文件
     * @return void
     */
    protected function loadApp()
    {
        $basePath = $this->addonsPath . DIRECTORY_SEPARATOR . $this->module . DIRECTORY_SEPARATOR;
        if (is_file($basePath . 'common.php')) {
            include_once $basePath . 'common.php';
        }

        $configPath = $this->app->getConfigPath();

        $files = [];

        if (is_dir($basePath . 'config')) {
            $files = array_merge($files, glob($basePath . 'config' . DIRECTORY_SEPARATOR . '*' . $this->app->getConfigExt()));
        } elseif (is_dir($configPath . $this->module)) {
            $files = array_merge($files, glob($configPath . $this->module . DIRECTORY_SEPARATOR . '*' . $this->app->getConfigExt()));
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
     * 重载视图模板路径
     */
    protected function loadView()
    {
        $this->module = Request::module();
        $this->controller = Request::controller();
        $this->action = Request::action();
        $baseTemplatePath = $this->addonsPath . DIRECTORY_SEPARATOR . $this->module . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR;
        $config = Config::get('view');
        $config['view_path'] = $baseTemplatePath;
        Config::set($config, 'view');
    }

    /**
     * 读取插件列表
     * @param $path
     * @param string $basePath
     * @return array|mixed
     */
    protected function readDirAllFiles($path, $basePath = '')
    {
        list($list, $temp_list) = [[], scandir($path)];
        empty($basePath) && $basePath = $path;
        foreach ($temp_list as $file) {
            if ($file == ".." || $file == ".") {
                continue;
            }
            if (is_dir($path . DIRECTORY_SEPARATOR . $file)) {
                $childFiles = $this->readDirAllFiles($path . DIRECTORY_SEPARATOR . $file, $basePath);
                $list = array_merge($childFiles, $list);
            } else {
                $filePath = $path . DIRECTORY_SEPARATOR . $file;
                $suffix = substr(strrchr($filePath, '.'), 1);
                if ($suffix != 'php') {
                    continue;
                }
                $fileName = str_replace($basePath . DIRECTORY_SEPARATOR, '', $filePath);
                $fileNameExplode = explode('/', $fileName);
                if (!isset($fileNameExplode[0]) || !isset($this->install[$fileNameExplode[0]])) {
                    continue;
                }
                $list[$fileName] = $filePath;
            }

        }
        return $list;
    }

    /**
     * 检测插件方法
     * @param $controller
     * @param $action
     * @return bool
     * @throws \ReflectionException
     */
    protected function checkActionByController($controller, $action)
    {
        $reflection = new ReflectionClass($controller);
        $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);
        $actions = array_diff(array_column($methods, 'name'), ['__construct']);
        return in_array($action, $actions) ? true : false;
    }

    /**
     * 获取格式化路由
     * @return array|bool
     * @throws \ReflectionException
     */
    protected function formatRoute()
    {
        $request = $this->app->request->request();
        if (!isset($request['s'])) {
            return false;
        }
        $uri = substr($request['s'], 2);
        $uriArray = explode('/', $uri);
        if (count($uriArray) <= 2 || $uriArray[0] != $this->config['path']) {
            return false;
        } elseif (!isset($this->install[$uriArray[1]])) {
            throw new HttpException(404, '插件不存在或者未安装:' . $uriArray[1]);
        } elseif (count($uriArray) == 3) {
            $controllerName = lineToHump(ucwords(end($uriArray)));
            $action = $this->config['default_action'];
        } else {
            $controllerArray = array_slice($uriArray, 2, -1);
            $controllerArray[count($controllerArray) - 1] = ucwords($controllerArray[count($controllerArray) - 1]);
            $controllerName = implode('\\', $controllerArray);
            $action = end($uriArray);
        }
        $uriArray = array_merge(array_slice($uriArray, 0, 2), [
            'controller',
            $controllerName,
        ]);
        $controller = implode('\\', $uriArray);
        if (!class_exists($controller)) {
            throw new HttpException(404, 'controller not exists:' . $controller);
        }
        $check = $this->checkActionByController($controller, $action);
        if (!$check) {
            throw new HttpException(404, 'method not exists:' . $controller . '->' . $action . '()');
        }
        return [$uri, $controller, $action];
    }

    /**
     * 获取安装的信息
     * @return string
     */
    protected function getInstallContent()
    {
        return <<<EOT
<?php
return [
];
EOT;
    }

}