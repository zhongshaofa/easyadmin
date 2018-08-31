<?php
/**
 * Created by Mr.Chung
 * Date: 2018\7\15 0015
 * Time: 6:15
 */

//后台公共文件


if (!function_exists('__log')) {

    /**
     * 写入系统日志
     * @param $data 数据
     * @param $type 日志类型
     */
    function __log($data, $type) {
        app('Log')::write(json_encode($data, JSON_UNESCAPED_UNICODE), $type);
    }
}

if (!function_exists('replace_menu_title')) {

    /**
     * 格式化菜单名称进行输出
     * @param $var 变量名
     * @param int $number 循环次数
     * @return string
     */
    function replace_menu_title($var, $number = 1) {
        $prefix = '';
        for ($i = 1; $i < $number; $i++) {
            $prefix .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        }
        return $prefix . $var;
    }
}