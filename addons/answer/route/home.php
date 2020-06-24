<?php

use think\facade\Route;

// 获取自定义入口目录
$entranceAddress = get_addon_config('answer','entrance_address');

Route::group($entranceAddress, function () {
    // 首页
    Route::get('/', 'addons\\answer\\controller\\home\\Index@index');
    // 详情
    Route::get('/detail', 'addons\\answer\\controller\\home\\Index@detail');
    // 分类
    Route::get('/cate/:id', 'addons\\answer\\controller\\home\\Cate@index');
    // 分类所有
    Route::get('/cate/all', 'addons\\answer\\controller\\home\\Cate@all');
})->pattern(['id' => '\d+']);