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

namespace addons\alioss\controller;


use app\BaseController;
use EasyAddons\Controller;
use EasyAddons\facade\Route;

class Demo extends BaseController
{

    public function index()
    {
        $test = build_route('test');
        dump($test);
    }

}