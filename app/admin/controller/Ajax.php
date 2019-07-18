<?php

namespace app\admin\controller;

use app\common\controller\AdBaseController;
use app\common\service\MenuService;
use app\common\service\NodeService;
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
        $initData = cache(session('admin.id') . '_initData');
        if (!empty($initData)) {
            $this->success('获取初始化数据成功', null, $initData);
        }
        $clearInfo = [
            'clearUrl' => url_build('admin/ajax/clear'),
        ];
        $homeInfo = [
            'title' => '首页',
            'icon'  => 'fa fa-home',
            'href'  => url_build('admin/index/welcome'),
        ];
        $logoInfo = [
            'title' => '99AdminV2',
            'image' => '/static/admin/images/logo.png',
            'href'  => '',
        ];
        $menuInfo = (new MenuService(session('admin.id')))->makeMenuTree();
        $initData = [
            'clearInfo' => $clearInfo,
            'logoInfo'  => $logoInfo,
            'homeInfo'  => $homeInfo,
            'menuInfo'  => $menuInfo,
        ];
        cache(session('admin.id') . '_initData', $initData);
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

    /**
     * 更新系统节点
     * @return \think\response\Json
     */
    public function updateNode()
    {
        $data = (new NodeService())->updateNode();
        return json($data);
    }
}