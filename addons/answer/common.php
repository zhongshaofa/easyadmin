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