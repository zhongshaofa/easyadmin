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

// 应用行为扩展定义文件
return [
    // 应用初始化
    'app_init'     => [],
    // 应用开始
    'app_begin'    => function () {

        $module = app('request')->module();

        //判断应用是否已安装
        if (file_exists(Env::get('config_path') . 'lock/install.lock') == false && $module != 'install') {
            throw new HttpResponseException(redirect(url('@install')));
        }
      
        if ($module != 'install') {
            //缓存系统配置信息
            Cache::tag('basic')->remember('SysInfo', function () {
                $SysInfo = new \app\admin\model\Config;
                return $SysInfo->getBasicConfig();
            });
            //渲染到视图层
            app('view')->init(config('template.'))->assign(['SysInfo' => Cache::get('SysInfo')]);
        }
    },
    // 模块初始化
    'module_init'  => [],
    // 操作开始执行
    'action_begin' => [],
    // 视图内容过滤
    'view_filter'  => [],
    // 日志写入
    'log_write'    => [],
    // 应用结束
    'app_end'      => [],
];
