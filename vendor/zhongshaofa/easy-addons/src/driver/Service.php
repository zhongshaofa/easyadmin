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

use addons\alioss\service\AliossService;
use think\App;
use think\facade\Config;
use think\facade\Request;
use think\Route;
use think\Service as BaseService;

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
     * 加载的插件控制器
     * @var array
     */
    protected $autoloadConteollers = [];

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
        $this->addonsPath = root_path() . $this->config['path'];

        // 加载安装插件
        $installFile = $this->addonsPath . DIRECTORY_SEPARATOR . 'install.php';
        if (is_file($installFile)) {
            $this->install = require $installFile;
        }
    }

    public function register()
    {
        // 自动加载插件
        $this->autoload();

        // 自动加载中间件
        $this->loadMiddleware();

        // 绑定插件容器
        $this->app->bind('addons', Service::class);
    }

    public function boot(Route $route)
    {
        $request = $this->app->request->request();
        if (!isset($request['s'])) {
            return;
        }
        $uri = substr($request['s'], 2);
        $uriArray = explode('/', $uri);
        if (count($uriArray) <= 2 && $uriArray[0] != 'addons') {
            return;
        }
        $controllerName = lineToHump(ucwords($uriArray[count($uriArray) - 2]));
        $action = end($uriArray);
        unset($uriArray[count($uriArray) - 1]);
        unset($uriArray[count($uriArray) - 1]);
        $uriArray = array_merge($uriArray, [
            'controller',
            $controllerName,
        ]);
        $controller = implode('\\', $uriArray);
        if(!in_array($controller,$this->autoloadConteollers)){
            return;
        }
        $route->rule('/' . $uri,  "{$controller}@{$action}");
    }

    protected function autoload()
    {
        $this->autoloadFiles = $this->readDirAllFiles($this->addonsPath);
        foreach ($this->autoloadFiles as $key => $autoloadFile) {
            is_file($autoloadFile) && include $autoloadFile;
            strpos($key, '/controller/') !== false && $this->autoloadConteollers[] = 'addons/'.str_replace('.php', '', $key);
        }
    }

    protected function loadMiddleware()
    {

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

}