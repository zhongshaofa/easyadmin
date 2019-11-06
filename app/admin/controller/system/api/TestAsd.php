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

namespace app\admin\controller\system\api;



use app\common\controller\AdminController;
use think\facade\Request;

class TestAsd extends AdminController
{

    public function index(){
        $test = parse_name(Request::controller(true));
        echo Request::controller();
    }
}