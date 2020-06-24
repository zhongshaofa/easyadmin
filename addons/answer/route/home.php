<?php

use think\facade\Route;

$entranceAddress = get_addon_config('answer','entrance_address');

Route::group($entranceAddress, function () {
    // 首页
    Route::get('/', 'addons\\answer\\controller\\home\\Index@index');
    // 详情
    Route::get('/detail', 'addons\\answer\\controller\\home\\Index@detail');
})
    ->pattern(['id' => '\d+']);