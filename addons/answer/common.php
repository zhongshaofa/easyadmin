<?php

if (!function_exists('home_url')) {

    /**
     * 构建前台URL
     * @param $url
     * @param bool $suffix
     * @return string
     * @throws \app\common\exception\AddonException
     */
    function home_url($url, $suffix = true)
    {
        $entranceAddress = get_addon_config('answer', 'entrance_address');
        $buildUrl = $suffix ? "/{$entranceAddress}/$url.html" : "/{$entranceAddress}/$url";
        return $buildUrl;
    }

}

if (!function_exists('home_build_url')) {

    /**
     * 构建参数URL
     * @param null $url
     * @param array $vars
     * @return string
     */
    function home_build_url($url = null, $vars = [])
    {
        empty($url) && $url = app()->request->url();
        $newVars = [];
        foreach ($vars as $key => $val) {
            $newVars[] = "{$key}={$val}";
        }
        $newVars = implode('&', $newVars);
        return strpos($url, '?') !== false ? "{$url}&{$newVars}" : "{$url}?{$newVars}";
    }

}