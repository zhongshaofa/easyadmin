<?php

use \think\facade\Config;

if (!function_exists('addons_path')) {

    /**
     * 获取插件路径
     * @return string
     */
    function addons_path()
    {
        return root_path(Config::get('addons.path', 'addons'));
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

if (!function_exists('copy_dir')) {

    /**
     * 复制文件夹
     * @param $src
     * @param $dst
     */
    function copy_dir($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . DIRECTORY_SEPARATOR . $file)) {
                    copy_dir($src . DIRECTORY_SEPARATOR . $file, $dst . DIRECTORY_SEPARATOR . $file);
                } else {
                    copy($src . DIRECTORY_SEPARATOR . $file, $dst . DIRECTORY_SEPARATOR . $file);
                }
            }
        }
        closedir($dir);
    }
}