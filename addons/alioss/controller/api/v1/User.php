<?php

namespace addons\alioss\controller\api\v1;

// +----------------------------------------------------------------------
// | EasyAdmin
// +----------------------------------------------------------------------
// | PHP交流群: 763822524
// +----------------------------------------------------------------------
// | 开源协议  https://mit-license.org 
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zhongshaofa/EasyAdmin
// +----------------------------------------------------------------------

use EasyAddons\Controller;

class User extends Controller
{

    public function index()
    {
        return $this->fetch();
    }
}