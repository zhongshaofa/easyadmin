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

namespace app\admin\service;

use think\facade\Cache;

class ConfigService
{

    public static function getVersion()
    {
        return  Cache::tag('sysconfig')->remember('version', function(){
            $version = sysconfig('site', 'site_version');
            Cache::tag('sysconfig')->set('site_version', $version);
            return $version;
        }, 3600);
    }

}
