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

namespace app\admin\controller;


use app\common\controller\AdminController;
use think\facade\Cache;

class Index extends AdminController {

    /**
     * 首页
     * @return mixed
     */
    public function index() {

        Cache::remember('Home', function () {
            return model('menu')->getHome();
        });
        $basic_data = [
            'title' => '99Admin后台管理',
            'nav'   => model('menu')->getNav(),
            'home'  => Cache::get('Home'),
            'data'  => '',
        ];
        return $this->fetch('', $basic_data);
    }

    /**
     * 首页欢迎界面
     * @return mixed
     */
    public function welcome() {
        return $this->fetch();
    }
}