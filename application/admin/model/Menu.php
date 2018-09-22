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

namespace app\admin\model;

use app\common\service\ModelService;

class Menu extends ModelService {

    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'system_menu';

    /**
     * 新增菜单数据
     * @param $insert
     * @return \think\response\Json
     * @throws \think\exception\PDOException
     */
    public function add($insert) {
        //使用事物保存数据
        $this->startTrans();
        $save = $this->save($insert);
        if (!$save) {
            $this->rollback();
            return __error('数据有误，请稍后再试！');
        }
        $this->commit();
        return __success('菜单添加成功！');
    }

    /**
     * 修改菜单数据
     * @param $update
     * @return \think\response\Json
     */
    public function edit($update) {
        $data = $this->where('id', $update['id'])->update($update);
        if ($data == 1) {
            return __success('菜单更新成功！');
        } else {
            return __error('数据没有修改！');
        }
    }

    /**
     * 获取首页信息
     * @return array|null|\PDOStatement|string|\think\Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getHome() {
        $where_home = [
            ['id', '=', 1],
            ['status', '=', 1],
        ];
        $home = $this->field('id, title, icon, href')->where($where_home)->find();
        return $home;
    }

    /**
     * 获取菜单栏头部
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getNav() {
        $where_nav = [
            ['id', '<>', 1],
            ['pid', '=', 0],
            ['status', '=', 1],
        ];
        $order_nav = [
            'sort'      => 'asc',
            'create_at' => 'asc',
        ];

        //查询顶级菜单栏数据
        $nav = $this->field('id, title, icon')->where($where_nav)->order($order_nav)->select();

        //去除空菜单
        foreach ($nav as $k => $val) {
            $menu = $this->where(['pid' => $nav[$k]['id'], 'status' => 1])->select()->toArray();
            if (empty($menu)) unset($nav[$k]);
        }

        //判断图标类型
        foreach ($nav as $key => $val) (strpos($nav[$key]['icon'], 'icon-') !== false) ? $nav[$key]['icon_type'] = true : $nav[$key]['icon_type'] = false;

        return $nav;
    }

    /**
     * 获取菜单栏数据
     * @param array $select 搜索条件
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function menuList($select = [], $where = []) {
        if (empty($select)) {
            $menu_list = $this->getMenu();
            empty($menu_list) ? $msg = '暂无数据！' : $msg = '查询成功！';
            return [
                'code'  => 0,
                'msg'   => $msg,
                'count' => count($menu_list),
                'data'  => $menu_list,
            ];
        } else {

            //搜索条件
            foreach ($select as $key => $value) {
                if ($key == 'status' && $value != '') {
                    $where[] = [$key, '=', $value];
                } elseif ($key == 'create_at' && $value != '') {
                    $value_list = explode(" - ", $value);
                    $where[] = [$key, 'BETWEEN', ["{$value_list[0]} 00:00:00", "{$value_list[1]} 23:59:59"]];
                } else {
                    !empty($value) && $where[] = [$key, 'LIKE', '%' . $value . '%'];
                }
            }

            $menu_list = $this->where($where)->order(['pid' => 'asc', 'sort' => 'asc', 'create_at' => 'desc'])->select();
            empty($menu_list) ? $msg = '暂无数据！' : $msg = '查询成功！';

            //修改菜单栏数据格式
            $this->__buildMenu($menu_list);
            return [
                'code'  => 0,
                'msg'   => $msg,
                'count' => count($menu_list),
                'data'  => $menu_list,
            ];
        }
    }

    /**
     * 修改搜索菜单栏数据格式
     * @param     $list
     * @param int $i
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function __buildMenu(&$list) {
        foreach ($list as &$vo) {
            $i = 1;
            if ($vo['pid'] != 0) {
                $i++;
                $nav = $this->where('id', $vo['pid'])->find();
                !empty($nav) && ($nav['pid'] != 0 && $i++);
            }
            $vo['title'] = replace_menu_title($vo['title'], $i);
            ($vo['id'] == 1 || $i >= 3) ? $vo['is_add'] = false : $vo['is_add'] = true;
        }
    }

    /**
     * 使用回调获取菜单栏数据
     * @param int   $pid  上级id
     * @param array $menu 菜单数据
     * @param int   $i    序号
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getMenu($pid = 0, &$menu = [], $i = 0) {
        $i++;
        $field = 'id, pid, title, icon, href, target, sort, status, create_at, create_by';
        $where_nav = [
            ['pid', '=', $pid],
        ];
        $order = [
            'sort'      => 'asc',
            'create_at' => 'desc',
        ];
        $nav = $this->field($field)->where($where_nav)->order($order)->select();
        foreach ($nav as $vo) {
            ($vo['id'] == 1 || $i >= 3) ? $vo['is_add'] = false : $vo['is_add'] = true;
            $vo['title'] = replace_menu_title($vo['title'], $i);
            $menu[] = $vo;
            $this->getMenu($vo['id'], $menu, $i);
        }
        return $menu;
    }

    /**
     * 创建菜单时获取上级的菜单
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getUpMenu() {
        $field = 'id, pid, title';
        $where_nav = [
            ['id', '<>', 1],
            ['pid', '=', 0],
        ];
        $order = [
            'sort'      => 'asc',
            'create_at' => 'desc',
        ];

        //最顶级
        $first_list = $this->where($where_nav)->field($field)->order($order)->select();

        //组合菜单数据
        $menu_list[] = [
            'id'    => 0,
            'pid'   => 0,
            'title' => '顶级菜单',
        ];
        foreach ($first_list as &$vo) {
            $vo['title'] = replace_menu_title($vo['title'], 1);
            $menu_list[] = $vo;
            $where_second = [['pid', '=', $vo['id']]];
            $second_list = $this->where($where_second)->field($field)->order($order)->select();
            foreach ($second_list as &$vl) {
                $vl['title'] = replace_menu_title($vl['title'], 2);
                $menu_list[] = $vl;
            }
        }
        return $menu_list;
    }

    /**
     * 获取系统导航菜单
     * @param array $menu_list
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getMenuApi($menu_list = []) {
        $field = 'id, pid, title, icon, href, spread, target';
        $order = ['sort' => 'asc', 'create_at' => 'desc'];

        $nav = $this->getNav()->toArray();
        foreach ($nav as $vo) {
            $i = 0;
            $where_first_menu = [['pid', '=', $vo['id']], ['status', '=', 1]];
            $first_menu = $this->field($field)->where($where_first_menu)->order($order)->select()->toArray();
            foreach ($first_menu as $vo_1) {
                if (auth($vo_1['href'])) {
                    $vo_1['spread'] = (bool)$vo_1['spread'];
                    $menu_list['99php_' . $vo['id']][$i] = $vo_1;
                    $where_second_menu = [['pid', '=', $vo_1['id']], ['status', '=', 1]];
                    $second_menu = $this->field($field)->where($where_second_menu)->order($order)->select()->toArray();
                    foreach ($second_menu as $vo_2) {
                        if (auth($vo_2['href'])) {
                            $vo_2['spread'] = (bool)$vo_2['spread'];
                            $menu_list['99php_' . $vo['id']][$i]['children'][] = $vo_2;
                        }
                    }
                    //去除空菜单
                    if (!isset($menu_list['99php_' . $vo['id']][$i]['children'])) {
                        if ($menu_list['99php_' . $vo['id']][$i]['href'] == '#' || $menu_list['99php_' . $vo['id']][$i]['href'] == '') {
                            unset($menu_list['99php_' . $vo['id']][$i]);
                        } else {
                            $i++;
                        }
                    } else {
                        $i++;
                    }
                }
            }
        }
        return $menu_list;
    }

    /**
     * 更新字段值
     * @param $update
     * @return \think\response\Json
     */
    public function edit_field($update) {
        $data = $this->where('id', $update['id'])->update([$update['field'] => $update['value']]);
        if ($data == 1) {
            return __success('修改成功！');
        } else {
            return __error('数据没有修改！');
        }
    }
}