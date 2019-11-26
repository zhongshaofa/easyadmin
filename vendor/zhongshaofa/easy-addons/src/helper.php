<?php

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