<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

namespace think;

/**
 * 后台地址入口
 */
// 加载基础文件
require __DIR__ . '/../thinkphp/base.php';

//判断应用是否已安装
if (file_exists('../config/lock/install.lock') == false) {
    header("location:./install.php");
    exit;
}

// 执行应用并响应
Container::get('app')->bind('admin')->run()->send();