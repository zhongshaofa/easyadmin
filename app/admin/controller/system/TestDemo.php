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

namespace app\admin\controller\system;


use app\common\controller\AdminController;
use EasyAdmin\annotation\ControllerAnnotation;
use EasyAdmin\annotation\NodeAnotation;

/**
 * Class TestDemo
 * @ControllerAnnotation(title="测试控制器")
 * @package app\admin\controller\system
 */
class TestDemo extends AdminController
{

    /**
     * @NodeAnotation(title="asdDemo")
     */
    public function asdDemo(){
        echo __METHOD__;
    }

    /**
     * @NodeAnotation(title="aaBbbCcc")
     */
    public function aaBbbCcc(){
        echo __METHOD__;
    }
}