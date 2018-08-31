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

namespace app\admin\model;

use app\common\service\ModelService;

class Node extends ModelService {

    /**
     * 绑定的数据表
     * @var string
     */
    protected $table = 'system_node';

    /**
     * 节点列表
     * @param int   $page   当前页
     * @param int   $limit  每页显示数量
     * @param array $select 搜索条件 （array）
     * @param array $where  组成的条件
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function nodeList($page = 1, $limit = 10, $select = [], $where = []) {

        //搜索条件
        foreach ($select as $key => $value) {
            if ($key == 'is_auth' && $value != '') {
                $where[] = [$key, '=', $value];
            } elseif ($key == 'create_at' && $value != '') {
                $value_list = explode(" - ", $value);
                $where[] = [$key, 'BETWEEN', ["{$value_list[0]} 00:00:00", "{$value_list[1]} 23:59:59"]];
            } else {
                !empty($value) && $where[] = [$key, 'LIKE', '%' . $value . '%'];
            }
        }

        $field = 'id, node, title , is_auth,  create_at';
        $count = $this->where($where)->count();
        $data = $this->where($where)->field($field)->page($page, $limit)->order(['node asc'])->select();
        empty($data) ? $msg = '暂无数据！' : $msg = '查询成功！';
        $info = [
            'limit'        => $limit,
            'page_current' => $page,
            'page_sum'     => ceil($count / $limit),
        ];
        $list = [
            'code'  => 0,
            'msg'   => $msg,
            'count' => $count,
            'info'  => $info,
            'data'  => $data,
        ];
        return $list;
    }

    /**
     * 保存节点
     * @param $insert
     * @return \think\response\Json
     */
    public function add($insert) {
        $save = $this->save($insert);
        if ($save == 1) {
            return __success('保存成功！');
        } else {
            return __error('保存失败！');
        }
    }

    /**
     * 更新节点
     * @param $update
     * @return \think\response\Json
     */
    public function edit($update) {
        $data = $this->where('id', $update['id'])->update($update);
        if ($data == 1) {
            return __success('更新成功！');
        } else {
            return __error('数据没有修改！');
        }
    }

    /**
     * 修改系统节点字段值
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

    /**
     * 根据模块名称获取节点
     * @param       $module
     * @param array $node_list
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function nodeModuleList($module, $node_list = []) {
        $module = $this->where(['type' => 1, 'node' => $module])->select()->toArray();
        foreach ($module as &$vo_m) {
            $i = 1;
            $vo_module = $vo_m;
            $vo_module['node'] = replace_menu_title($vo_module['node'], $i);
            $node_list[] = $vo_module;
            $controller = $this->where([['type', '=', 2], ['node', 'LIKE', $vo_m['node'] . '%']])->select()->toArray();
            foreach ($controller as &$vo_c) {
                $i = 2;
                $vo_controller = $vo_c;
                $vo_controller['node'] = replace_menu_title($vo_controller['node'], $i);
                $node_list[] = $vo_controller;
                $action = $this->where([['type', '=', 3], ['node', 'LIKE', $vo_c['node'] . '%']])->select()->toArray();
                foreach ($action as &$vo_a) {
                    $i = 3;
                    $vo_action = $vo_a;
                    $vo_action['node'] = replace_menu_title($vo_action['node'], $i);
                    $node_list[] = $vo_action;
                }
            }
        }
        return [
            'code'  => 0,
            'msg'   => '查询成功',
            'count' => count($node_list),
            'data'  => $node_list,
        ];
    }
}