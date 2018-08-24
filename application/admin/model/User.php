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
 * 系统管理员模型
 * Class User
 * @package app\admin\model
 */
class User extends ModelService {

    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'system_user';

    /**
     * 关联角色表数据
     * @return \think\model\relation\HasOne
     */
    public function auth() {
        return $this->hasOne("Auth", "id", "auth_id")->joinType('left')->field('title');
    }

    /**
     * 启用或者禁用管理员账户
     * @param $id
     * @return User|bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function operate($id) {
        $where_operate = [
            ['id', '=', $id],
            ['is_deleted', '=', 0],
            ['status', 'In', [0, 1]],
        ];
        $operate = $this->where($where_operate)->find();
        if (!empty($operate)) {
            $operate['status'] == 0 ? $status = 1 : $status = 0;
            $status == 0 ? $msg = '账户停用成功！' : $msg = '账户启用成功';
            $update = $this->where($where_operate)->update(['status' => $status]);
            if ($update >= 1) return ['code' => 0, 'msg' => $msg];
            return ['code' => 1, 'msg' => '账户状态更改失败，请检查！'];
        }
        return false;
    }

    /**
     * 登录验证
     * @param $username 管理员账户
     * @param $password 管理员密码
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function login($username, $password) {
        $where_login = [
            ['username', '=', $username],
            ['is_deleted', 'In', [0, 1]],
            ['status', 'In', [0, 1]],
        ];
        $login = $this->where($where_login)->find();
        if (empty($login)) return ['code' => 1, 'msg' => '账户不存在，请重新输入！'];
        if ($login['password'] != password($password)) return ['code' => 1, 'msg' => '密码不正确，请重新输入！'];
        if ($login['is_deleted'] == 1) return ['code' => 1, 'msg' => '该账户已被删除，请联系超级管理员！'];
        if ($login['status'] == 0) return ['code' => 1, 'msg' => '该账户已被停用，请联系超级管理员！'];
        unset($login['password']);
        return ['code' => 0, 'msg' => '登录成功，正在进入后台系统！', 'user' => $login];
    }

    /**
     * 添加管理员
     * @param $insert 需要插入的数据
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
        return __success('管理员账户添加成功！');
    }

    /**
     * 修改管理员信息
     * @param $update 需要修改的数据
     * @return \think\response\Json
     */
    public function edit($update) {
        $update = $this->where('id', $update['id'])->update($update);
        if ($update >= 1) return __success('信息修改成功');
        return __error('数据没有修改！');
    }

    /**
     * 修改管理员密码
     * @param $update 需要修改的数据
     * @return \think\response\Json
     */
    public function editPassword($update) {
        $update = $this->where('id', $update['id'])->update(['password' => password($update['password'])]);
        if ($update >= 1) return __success('密码修改成功');
        return __error('密码修改失败，请检查！');
    }

    /**
     * 获取用户列表信息
     * @param int $page 当前页
     * @param int $limit 每页显示数量
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function userList($page = 1, $limit = 10, $select = []) {
        $where = [['is_deleted', '=', 0]];

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

        $field = 'id, auth_id, username, qq, mail, phone, remark, status, create_by, create_at';
        $count = $this->where($where)->count();
        $data = $this->where($where)->field($field)->page($page, $limit)->select()
            ->each(function ($item, $key) {
                $auth_title = model('auth')->where(['id' => $item['auth_id'], 'status' => 1])->value('title');
                $create_by_username = $this->where(['id' => $item['create_by'], 'status' => 1, 'is_deleted' => 0])->value('username');
                empty($auth_title) ? $item['auth_title'] = '暂无权限信息' : $item['auth_title'] = $auth_title;
                empty($create_by_username) ? $item['create_by_username'] = '暂未创建者信息' : $item['create_by_username'] = $create_by_username;
            });
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
}