<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
if (!function_exists('debug')) {

    /**
     * 输出debug日志
     * @param $data
     */
    function debug($data)
    {
        trace($data, 'debug');
    }
}

if (!function_exists('url_build')) {

    /**
     * 重写Url生成
     * @param string $url 路由地址
     * @param array $vars 变量
     * @param bool|string $suffix 生成的URL后缀
     * @param bool|string $domain 域名
     * @return UrlBuild
     */
    function url_build(string $url = '', array $vars = [], $suffix = true, $domain = false)
    {
        return url($url, $vars, $suffix, $domain)->__toString();
    }
}

if (!function_exists('password')) {

    /**
     * 密码加密算法
     * @param $value 需要加密的值
     * @param $type  加密类型，默认为md5 （md5, hash）
     * @return mixed
     */
    function password($value)
    {
        $value = sha1('blog_') . md5($value) . md5('_encrypt') . sha1($value);
        return sha1($value);
    }

}

if (!function_exists('convertUnderline')) {
    /**
     * 下划线转驼峰
     * @param $string
     * @return null|string|string[]
     */
    function convertUnderline($string)
    {
        $string = preg_replace_callback('/([-_]+([a-z]{1}))/i', function ($matches) {
            return strtoupper($matches[2]);
        }, $string);
        return $string;
    }
}

if (!function_exists('humpToLine')) {
    /**
     * 驼峰转下划线
     * @param $string
     * @return null|string|string[]
     */
    function humpToLine($string)
    {
        $newString = null;
        $stringArr = explode('.', $string);

        foreach ($stringArr as $vo) {
            $str = parse_name($vo);
            if (empty($newString)) {
                $newString = $str;
            } else {
                $newString .= '.' . $str;
            }
        }

        return $newString;

//        $str = preg_replace_callback('/([A-Z]{1})/', function ($matches) {
//            return '_' . strtolower($matches[0]);
//        }, $str);
        return $string;

    }
}