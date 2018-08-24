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

namespace app\admin\validate;

use think\Validate;


/**
 * 后台管理员验证类
 * Class User
 * @package app\admin\validate
 */
class User extends Validate {

    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'id'           => 'require|number|checkDelId',
        'username'     => 'require|min:5|max:15|checkUsername',
        'old_password' => 'require|min:6|max:20|checkOldPassword',
        'password'     => 'require|min:6|max:20|checkPassword',
        'password1'    => 'require|min:6|max:20|checkPassword',
        'phone'        => 'require|number|mobile|checkPhone',
        'mail'         => 'email|max:20|checkMail',
        'auth_id'      => 'require',
        'qq'           => 'number',
        'remark'       => 'max:250',
    ];

    /**
     * 错误提示
     * @var array
     */
    protected $message = [
        'id.require'        => '编号必须',
        'username.require'  => '名称必须',
        'username.min'      => '名称不能少于5个字符',
        'username.max'      => '名称最多不能超过15个字符',
        'password.require'  => '密码必须',
        'password.min'      => '密码不能少于6个字符',
        'password.max'      => '密码最多不能超过20个字符',
        'password1.require' => '第二次密码必须',
        'password1.max'     => '第二次密码最多不能超过20个字符',
        'auth_id.number'    => '角色编号必须是数字',
        'mail.email'        => '邮箱格式错误',
        'phone.email'       => '手机号格式错误',
        'qq.number'         => 'QQ必须为数字',
        'remark.max'        => '备注最多不能超过250个字符',
    ];

    /**
     * 应用场景
     * @var array
     */
    protected $scene = [
        //添加管理员
        'add'           => ['username', 'password', 'password1', 'phone', 'mail', 'auth_id', 'qq', 'remark'],

        //修改管理员
        'edit'          => ['username', 'phone', 'mail', 'auth_id', 'qq', 'remark'],

        //修改登录密码
        'edit_password' => ['id', 'old_password', 'password', 'password1'],

        //删除管理员
        'del'           => ['id'],

        //更改管理员状态
        'status'       => ['id'],
    ];

    /**
     * 修改信息验证场景
     * @return User
     */
    public function sceneEdit() {
        return $this->only(['phone', 'mail', 'auth_id'])
            ->remove('phone', 'checkPhone')
            ->remove('mail', 'checkMail');
    }

    /**
     * 检测删除时用户ID
     * @param $value
     * @param $rule
     * @param array $data
     * @return bool|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected function checkDelId($value, $rule, $data = []) {
        $user = \app\admin\model\user::where(['id' => $value])->find();
        if (empty($user)) return '暂无账户数据，请稍后再试！';
        if ($user['is_deleted'] == 1) return '该账户已被删除，无需再次删除！';
        return true;
    }

    /**
     * 检测启用或者禁用时的用户ID
     * @param $value
     * @param $rule
     * @param array $data
     * @return bool|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected function checkOperateId($value, $rule, $data = []) {
        $user = \app\admin\model\user::where(['id' => $value])->find();
        if (empty($user)) return '暂无账户数据，请稍后再试！';
        if ($user['is_deleted'] == 1) return '该账户已被删除，无需再次删除！';
        return true;
    }

    /**
     * 检查用户名是否已存在
     * @param $value
     * @param $rule
     * @param array $data
     * @return bool|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected function checkUsername($value, $rule, $data = []) {
        $where_user = [
            'username'   => $value,
            'status'     => 1,
            'is_deleted' => 0,
        ];
        $user = \app\admin\model\user::where($where_user)->find();
        return empty($user) ? true : '已有相同登录账号，请更换进行注册！';
    }

    /**
     * 判断两个输入的密码是否一致
     * @param $value
     * @param $rule
     * @param array $data
     * @return bool|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected function checkPassword($value, $rule, $data = []) {
        return $data['password'] == $data['password1'] ? true : '两次输入的密码不一致，请重新输入！';
    }

    protected function checkOldPassword($value, $rule, $data = []) {
        $where_user = [
            'id'         => $data['id'],
            'status'     => 1,
            'is_deleted' => 0,
        ];
        $user = \app\admin\model\user::where($where_user)->find();
        if (empty($user)) return '暂无改管理员信息，请刷新重试！';
        return $user['password'] == password($value) ? true : '旧密码不正确，请重新输入！';
    }

    /**
     * 判断是否存在相同的手机号
     * @param $value
     * @param $rule
     * @param array $data
     * @return bool|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected function checkPhone($value, $rule, $data = []) {
        $where_user = [
            'phone'      => $value,
            'status'     => 1,
            'is_deleted' => 0,
        ];
        $user = \app\admin\model\user::where($where_user)->find();
        return empty($user) ? true : '已有相同手机号码，请更换进行注册！';
    }

    /**
     * 判断是否存在相同的邮箱
     * @param $value
     * @param $rule
     * @param array $data
     * @return bool|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected function checkMail($value, $rule, $data = []) {
        $where_user = [
            'mail'       => $value,
            'status'     => 1,
            'is_deleted' => 0,
        ];
        $user = \app\admin\model\user::where($where_user)->find();
        return empty($user) ? true : '已有相同邮箱，请更换进行注册！';
    }

}