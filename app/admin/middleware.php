<?php
// 全局中间件定义文件
return [

    // Session初始化
    \think\middleware\SessionInit::class,

    // 系统操作日志
    \app\admin\middleware\SystemLog::class,

    // Csrf安全校验
    \app\admin\middleware\CsrfMiddleware::class,

    // 后台视图初始化
//    \app\admin\middleware\ViewInit::class,

    // 检测用户是否登录
//    \app\admin\middleware\CheckAdmin::class,


];
