<?php
// +----------------------------------------------------------------------
// | 99PHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018~2020 https://www.99php.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Mr.Chung <chung@99php.cn >
// +----------------------------------------------------------------------

namespace app\admin\controller\api;

use app\common\controller\AdminController;
use think\facade\Cache;

class Menu extends AdminController
{

    /**
     * 根据权限规则生成菜单栏数据
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getMenu()
    {
        if (!empty(Cache::tag('menu')->get(session('user.id') . '_AdminMenu'))) {
            return json(Cache::get(session('user.id') . '_AdminMenu'));
        } else {
            $menu_list = \app\admin\model\Menu::getMenuApi();
            Cache::tag('menu')->set(session('user.id') . '_AdminMenu', $menu_list, 86400);
            return json($menu_list);
        }
    }

    /**
     * 获取顶部菜单栏
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getNav()
    {
        if (!empty(Cache::tag('menu')->get(session('user.id') . '_AdminMenu'))) {
            $menu_list = Cache::get(session('user.id') . '_AdminMenu');
        } else {
            $menu_list = \app\admin\model\Menu::getMenuApi();
            Cache::tag('menu')->set(session('user.id') . '_AdminMenu', $menu_list, 86400);
        }
        $memu_id_list = [];
        foreach ($menu_list as $key => $val) {
            $menu_id = explode("99php_", $key);
            isset($menu_id[1]) && $memu_id_list[] = $menu_id[1];
        }
        $nav = model('menu')->whereIn('id', $memu_id_list)->field('id, title, icon')
            ->order([
                'sort'      => 'asc',
                'create_at' => 'asc',
            ])->select();
        foreach ($nav as $key => $val) {
            (strpos($nav[$key]['icon'], 'fa-') !== false) ? $nav[$key]['icon_type'] = true : $nav[$key]['icon_type'] = false;
        }
        return $nav;
    }
}