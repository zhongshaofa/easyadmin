<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/23
 * Time: 3:40
 */

namespace app\admin\validate\blog;


use think\Validate;

class Member extends Validate {

    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'id'        => 'require|number|checkId',
        'nickname'  => 'require|max:20',
        'username'  => 'require|min:5|max:15',
        'password'  => 'require|min:6|max:20',
        'password1' => 'require|min:6|max:20',
        'phone'     => 'require|number|mobile',
        'email'     => 'email|max:20',
        'remark'    => 'max:250',
    ];

    /**
     * 错误提示
     * @var array
     */
    protected $message = [
        'id.require'       => '编号必须',
        'username.require' => '名称必须',
        'username.min'     => '名称不能少于5个字符',
        'username.max'     => '名称最多不能超过15个字符',
        'password.require' => '密码必须',
        'password.min'     => '密码不能少于6个字符',
        'password.max'     => '密码最多不能超过20个字符',
        'email.email'      => '邮箱格式错误',
        'phone.mobile'     => '手机号格式错误',
        'remark.max'       => '备注最多不能超过250个字符',
    ];

    /**
     * 验证场景
     * @var array
     */
    protected $scene = [

        //删除
        'del'    => ['id'],

        //更改状态
        'status' => ['id'],
    ];

    /**
     * 新增验证场景
     * @return Member
     */
    public function sceneAdd() {
        return $this->only(['nickname', 'username', 'password', 'password1', 'phone', 'email', 'remark'])
            ->append('password', 'checkPassword')
            ->append('username', 'checkUsername')
            ->append('phone', 'checkPhone')
            ->append('email', 'checkEmail');
    }

    /**
     * 编辑验证场景
     * @return Member
     */
    public function sceneEdit() {
        return $this->only(['id', 'nickname', 'username', 'phone', 'email', 'remark'])
            ->append('username', 'checkUsername')
            ->append('phone', 'checkPhone')
            ->append('email', 'checkEmail');
    }

    /**
     * 重置密码验证场景
     * @return Member
     */
    public function sceneResetPassword() {
        return $this->only(['id', 'password', 'password1'])
            ->append('password', 'checkPassword');
    }

    /**
     * 检测密码是否合法
     * @param       $value
     * @param       $rule
     * @param array $data
     * @return bool
     */
    protected function checkPassword($value, $rule, $data = []) {
        if ($value != $data['password1']) {
            return '两次密码输入不一致，请重新输入！';
        }
        return true;
    }

    /**
     * 判断会员id是否存在
     * @param       $value
     * @param       $rule
     * @param array $data
     * @return bool|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected function checkId($value, $rule, $data = []) {
        $where = [
            ['id', '=', $value],
            ['is_deleted', '=', 0],
        ];
        $member = \app\admin\model\blog\Member::where($where)->find();
        if (empty($member)) return '会员信息不存在！';
        return true;
    }

    /**
     * 检测用户名是否存在
     * @param       $value
     * @param       $rule
     * @param array $data
     * @return bool|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected function checkUsername($value, $rule, $data = []) {
        $where = [
            ['username', '=', $value],
            ['is_deleted', '=', 0],
        ];

        //编辑，需要排除自身条件
        isset($data['id']) && $where[] = ['id', 'NotIn', [$data['id']]];

        $member = \app\admin\model\blog\Member::where($where)->find();
        if (!empty($member)) return '已存在该账号，请更换账户名重试！';
        return true;
    }

    /**
     * 检测手机号是否存在
     * @param       $value
     * @param       $rule
     * @param array $data
     * @return bool|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected function checkPhone($value, $rule, $data = []) {
        $where = [
            ['phone', '=', $value],
            ['is_deleted', '=', 0],
        ];

        //编辑，需要排除自身条件
        isset($data['id']) && $where[] = ['id', 'NotIn', [$data['id']]];

        $member = \app\admin\model\blog\Member::where($where)->find();
        if (!empty($member)) return '已存在该手机号，请更换重试！';
        return true;
    }

    /**
     * 检测邮箱是否存在
     * @param       $value
     * @param       $rule
     * @param array $data
     * @return bool|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected function checkEmail($value, $rule, $data = []) {
        $where = [
            ['email', '=', $value],
            ['is_deleted', '=', 0],
        ];

        //编辑，需要排除自身条件
        isset($data['id']) && $where[] = ['id', 'NotIn', [$data['id']]];

        $member = \app\admin\model\blog\Member::where($where)->find();
        if (!empty($member)) return '已存在该邮箱，请更换重试！';
        return true;
    }

}
