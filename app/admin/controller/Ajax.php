<?php

namespace app\admin\controller;

use app\common\controller\AdBaseController;
use app\common\service\MenuService;
use think\facade\Cache;

/**
 * 后台通用接口
 * Class Ajax
 * @package app\admin\controller
 */
class Ajax extends AdBaseController
{

    /**
     * 初始化后台前端框架接口
     * @return \think\response\Json
     */
    public function init()
    {
        $initData = cache('initData');
        if (!empty($initData)) {
            $this->success('获取初始化数据成功', null, $initData);
        }
        $clearInfo = [
            'clearUrl' => url_build('admin/ajax/clear'),
        ];
        $homeInfo  = [
            'title' => '首页',
            'icon'  => 'fa fa-home',
            'href'  => url_build('admin/index/welcome'),
        ];
        $logoInfo  = [
            'title' => '99AdminV2',
            'image' => '/static/admin/images/logo.png',
            'href'  => '',
        ];
        $menuInfo  = (new MenuService(1))->makeMenuTree();
        $initData  = [
            'clearInfo' => $clearInfo,
            'logoInfo'  => $logoInfo,
            'homeInfo'  => $homeInfo,
            'menuInfo'  => $menuInfo,
        ];
        cache('initData', $initData);
        $this->success('获取初始化数据成功', null, $initData);
    }

    /**
     *  清理缓存接口
     * @return \think\response\Json
     */
    public function clear()
    {
        Cache::clear();
        return json([
            'code' => 1,
            'msg'  => '清理缓存成功',
        ]);
    }
}