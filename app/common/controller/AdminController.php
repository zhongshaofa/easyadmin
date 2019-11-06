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


namespace app\common\controller;


use app\BaseController;
use think\facade\View;

class AdminController extends BaseController
{

    /**
     * 是否开启权限控制
     * @var bool
     */
    protected $isAuth = true;

    /**
     * 是否登录控制
     * @var bool
     */
    protected $isLogin = true;

    /**
     * 初始化方法
     */
    protected function initialize()
    {
        parent::initialize();

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
        return View::fetch($template, $vars);
    }

}