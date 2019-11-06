<?php
// 应用公共文件

if (!function_exists('__url')) {

    /**
     * 构建URL地址
     * @param string $url
     * @param array $vars
     * @param bool $suffix
     * @param bool $domain
     * @return string
     */
    function __url(string $url = '', array $vars = [], $suffix = true, $domain = false)
    {
        return url($url, $vars, $suffix, $domain)->build();
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

}