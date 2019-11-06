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

namespace app\common\listener;


use EasyAddons\Http;
use think\App;
use think\facade\Request;

/**
 * 插件事件触发
 * Class Addons
 * @package app\common\listener
 */
class Addons
{

    public function handle()
    {
        $params = Request::param();
        $uri    = isset($params['s']) ? $params['s'] : null;
        if (strpos($uri, 'addons') !== false) {
             (new Http())->run();die;
        }
    }

}