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

namespace addons\answer\controller\home;


use addons\answer\controller\AnswerHomeController;

class Index extends AnswerHomeController
{

    public function index()
    {
        return $this->fetch();
    }
}