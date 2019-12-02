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

namespace EasyAddons;

use think\App;
use think\exception\ValidateException;
use think\Validate;
use think\facade\View;


/**
 * 控制器基础类
 */
abstract class Controller
{

    /**
     * Request实例
     * @var \think\Request
     */
    protected $request;

    /**
     * 应用实例
     * @var \think\App
     */
    protected $app;

    /**
     * 是否批量验证
     * @var bool
     */
    protected $batchValidate = false;

    /**
     * 控制器中间件
     * @var array
     */
    protected $middleware = [];

    /**
     * 插件路径
     * @var string
     */
    protected $addonsPath;

    /**
     * 插件模块
     * @var string
     */
    protected $module;

    /**
     * 控制器
     * @var string
     */
    protected $controller;

    /**
     * 方法
     * @var string
     */
    protected $action;

    /**
     * 构造方法
     * Controller constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->request = $this->app->request;
        $this->addonsPath = addons_path();
        $this->initRoute();
        // 控制器初始化
        $this->initialize();
    }


    protected function initRoute()
    {
        $dispatch = $this->app->route->check()->getDispatch();
        $routeArray = array_filter(explode('\\', $dispatch[0]));
        $this->module = $routeArray[2];
        $controllerArray = array_slice($routeArray, 3);
        $controllerArray[count($controllerArray) - 1] = lcfirst($controllerArray[count($controllerArray) - 1]);
        $this->controller = implode(DIRECTORY_SEPARATOR, $controllerArray);
        $this->action = $dispatch[1];
    }

    /**
     * 初始化
     */
    protected function initialize()
    {
    }

    /**
     * 模板变量赋值
     * @param string|array $name 模板变量
     * @param mixed $value 变量值
     * @return View
     */
    public function assign($name, $value = null)
    {
        return View::assign($name, $value);
    }

    /**
     * 解析和获取模板内容 用于输出
     * @param string $template
     * @param array $vars
     * @return string
     * @throws \Exception
     */
    public function fetch($template = '', $vars = [])
    {
        empty($template) && $template = $this->controller . DIRECTORY_SEPARATOR . $this->action;
        return View::fetch($template, $vars);
    }

    /**
     * 验证数据
     * @access protected
     * @param array $data 数据
     * @param string|array $validate 验证器名或者验证规则数组
     * @param array $message 提示信息
     * @param bool $batch 是否批量验证
     * @return array|string|true
     * @throws ValidateException
     */
    protected function validate(array $data, $validate, array $message = [], bool $batch = false)
    {
        if (is_array($validate)) {
            $v = new Validate();
            $v->rule($validate);
        } else {
            if (strpos($validate, '.')) {
                // 支持场景
                list($validate, $scene) = explode('.', $validate);
            }
            $class = false !== strpos($validate, '\\') ? $validate : $this->app->parseClass('validate', $validate);
            $v = new $class();
            if (!empty($scene)) {
                $v->scene($scene);
            }
        }

        $v->message($message);

        // 是否批量验证
        if ($batch || $this->batchValidate) {
            $v->batch(true);
        }

        return $v->failException(true)->check($data);
    }

}
