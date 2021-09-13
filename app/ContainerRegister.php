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

namespace app;


use CsrfVerify\CsrfVerify;
use CsrfVerify\drive\ThinkphpCache;
use CsrfVerify\interfaces\CsrfVerifyInterface;
use CsrfVerify\interfaces\SimpleCacheInterface;
use think\Service;

/**
 * 容器注入服务
 * Class ContainerRegister
 * @package app
 */
class ContainerRegister extends Service
{

    /**
     * 注册
     */
    public function register(): void
    {
        $this->app->bind(CsrfVerifyInterface::class, CsrfVerify::class);
        $this->app->bind(SimpleCacheInterface::class, ThinkphpCache::class);
    }
}