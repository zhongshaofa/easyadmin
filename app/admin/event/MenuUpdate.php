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

namespace app\admin\event;

use think\facade\Cache;

/**
 * 菜单更新事件
 * Class MenuUpdate
 * @package app\admin\event
 */
class MenuUpdate
{

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
        $this->trigger();
    }

    protected function trigger()
    {
        Cache::tag('initAdmin')->clear();
    }

}