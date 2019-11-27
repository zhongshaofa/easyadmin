<?php

use \think\facade\Config;

if (!function_exists('addons_path')) {

    /**
     * 获取插件路径
     * @return string
     */
    function addons_path()
    {
        return root_path( Config::get('addons.path','addons'));
    }
}

if (!function_exists('lineToHump')) {
    /**
     * 下划线转驼峰
     * @param $str
     * @return null|string|string[]
     */
    function lineToHump($str)
    {
        $str = preg_replace_callback('/([-_]+([a-z]{1}))/i', function ($matches) {
            return strtoupper($matches[2]);
        }, $str);
        return $str;
    }
}

if (!function_exists('humpToLine')) {
    /**
     * 驼峰转下划线
     * @param $str
     * @return null|string|string[]
     */
    function humpToLine($str)
    {
        $str = preg_replace_callback('/([A-Z]{1})/', function ($matches) {
            return '_' . strtolower($matches[0]);
        }, $str);
        return $str;
    }
}