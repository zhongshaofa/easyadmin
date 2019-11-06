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

namespace app\admin\controller;

use app\common\controller\AdminController;
use app\common\service\MenuService;

class Ajax extends AdminController
{

    protected $isAuth = false;

    /**
     * 初始化后台接口地址
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function initAdmin()
    {
        $menuService = new MenuService();
        $data        = [
            'clearInfo' => [
                'clearUrl' => __url('ajax/clear'),
            ],
            'logoInfo'  => [
                'title' => 'EasyAdmin',
                'image' => null,
                'href'  => null,
            ],
            'homeInfo'  => $menuService->getHomeInfo(),
            'menuInfo'  => $menuService->getMenuTree(),
        ];
        return json($data);
    }

}