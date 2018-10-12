<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//开放平台地址
Route::domain('download.99php.cn', 'download');

//博客平台地址
Route::domain('blog.99php.cn', 'blog');

//刷新缓存地址
Route::get('cache/clean/:password', 'cache/clean/index');
