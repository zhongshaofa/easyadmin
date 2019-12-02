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

class Demo extends Controller
{

    public function index()
    {
        return $this->fetch();
    }

}