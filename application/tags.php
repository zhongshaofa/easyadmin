<?php
/// +----------------------------------------------------------------------
// | 99PHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018~2020 https://www.99php.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Mr.Chung <chung@99php.cn >
// +----------------------------------------------------------------------
use think\exception\HttpResponseException;

use think\facade\Cache;
use think\facade\Config;

// 应用行为扩展定义文件
return [
    // 应用初始化
    'app_init'     => [],
    // 应用开始
    'app_begin'    => function () {
        if (app('request')->module() != 'install') {
            //缓存系统配置信息
            Cache::tag('basic')->remember('SysInfo', function () {
                $SysInfo = new \app\admin\model\Config;
                return $SysInfo->getBasicConfig();
            });
            //缓存博客配置信息
            Cache::tag('blog_basic')->remember('BlogInfo', function () {
                $BlogInfo = new \app\blog\model\Config;
                return $BlogInfo->getBlogConfig();
            });
            //渲染到视图层
            app('view')->init(config('template.'))->assign([
                'SysInfo'   => Cache::get('SysInfo'),
                'BlogInfo'  => Cache::get('BlogInfo'),
                'is_mobile' => is_mobile(),
                'website'   => [
                    'index'    => Config::get('website.index'),
                    'download' => Config::get('website.download'),
                    'blog'     => Config::get('website.blog'),
                    'demo'     => Config::get('website.demo'),
                ],
            ]);
        }
    },
    // 模块初始化
    'module_init'  => [],
    // 操作开始执行
    'action_begin' => function () {
        //声明模板常量，保证在修改后台模块名的时候可以正常访问
        list($thisModule, $thisController, $thisAction) = [app('request')->module(), app('request')->controller(), app('request')->action()];
        $thisClass = parseNodeStr("{$thisModule}/{$thisController}");
        $thisRequest = parseNodeStr("{$thisModule}/{$thisController}/{$thisAction}");
        app('view')->init(config('template.'))->assign([
            'thisModule'     => $thisModule,
            'thisController' => $thisController,
            'thisClass'      => $thisClass,
            'thisRequest'    => $thisRequest,
        ]);
    },
    // 视图内容过滤
    'view_filter'  => [],
    // 日志写入
    'log_write'    => [],
    // 应用结束
    'app_end'      => [],
];
