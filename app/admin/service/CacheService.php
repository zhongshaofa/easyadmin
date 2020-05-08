<?php


namespace app\admin\service;


use think\facade\Cache;

class CacheService
{

    /**
     * 清楚权限缓存
     * @return bool
     */
    public function cleanAuthCache(){
        Cache::tag('initAdmin')->clear();
        return true;
    }

}