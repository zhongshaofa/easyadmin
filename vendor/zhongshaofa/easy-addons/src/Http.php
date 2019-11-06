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
use think\facade\Request;

class Http
{

    /**
     * @var string
     */
    protected $uri;

    protected $module;

    protected $controller;

    protected $action;

    protected $param=[];

    protected $controllerClass;

    public function __construct()
    {

    }

    public function run()
    {
        $parme = Request::param();

        $this->callback();
    }

    /**
     * 回调控制器中的方法
     * @return mixed
     */
    public function callback()
    {
        return call_user_func_array([(new $this->controllerClass(new App())), $this->action], $this->param);
    }

}