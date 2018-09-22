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

/**
 * 权限组模型
 * Class Auth
 * @package app\admin\model
 */
class Auth extends ModelService {

    /**
     * 绑定的数据表
     * @var string
     */
    protected $table = 'system_auth';

    /**
     * 获取权限组
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getList() {
        $where_auth = [
            ['status', '=', 1],
        ];
        $order_auth = [
            'id' => 'asc',
        ];
        $auth = $this->where($where_auth)->field('id, title, status')->order($order_auth)->select();
        return $auth;
    }

    /**
     * 权限角色列表
     * @param int $page
     * @param int $limit
     * @param array $search
     * @param array $where
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function authList($page = 1, $limit = 10, $search = [], $where = []) {

        //搜索条件
        foreach ($search as $key => $value) {
            if ($key == 'status' && $value != '') {
                $where[] = [$key, '=', $value];
            } elseif ($key == 'create_at' && $value != '') {
                $value_list = explode(" - ", $value);
                $where[] = [$key, 'BETWEEN', ["{$value_list[0]} 00:00:00", "{$value_list[1]} 23:59:59"]];
            } else {
                !empty($value) && $where[] = [$key, 'LIKE', '%' . $value . '%'];
            }
        }

        $field = 'id, title , remark, status, sort, create_at';
        $count = $this->where($where)->count();
        $data = $this->where($where)->field($field)->page($page, $limit)->order(['sort asc'])->select();
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
}