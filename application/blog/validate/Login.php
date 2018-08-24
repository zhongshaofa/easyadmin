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

namespace app\blog\validate;


use think\Validate;

/**
 * 登录验证类
 * Class Login
 * @package app\blog\validate
 */
class Login extends Validate {

    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'username' => 'require|max:15',
        'password' => 'require|max:20',
        'nickname' => 'require|max:20',
        'email'    => 'require|email',
        'vercode'  => 'require|captcha',
    ];

    /**
     * 错误提示
     * @var array
     */
    protected $message = [
        'username.require' => '登录名必须',
        'username.max'     => '登录名最多不能超过15个字符',
        'password.require' => '密码必须',
        'password.max'     => '密码最多不能超过20个字符',
        'vercode.require'  => '验证码能为空',
        'vercode.captcha'  => '验证码不正确，请重新输入',
        'nickname.require' => '昵称必须',
        'nickname.max'     => '昵称最多不能超过20个字符',
        'email.require'    => '邮箱必须',
        'email.email'      => '邮箱格式不正确',
    ];

    /**
     * 应用场景
     * @var array
     */
    protected $scene = [
        'index' => ['username', 'password', 'vercode'],
    ];

    /**
     * 自定义验证场景
     * @return Node
     */
    public function sceneRegister() {
        return $this->only(['username', 'password', 'nickname', 'email', 'vercode'])
            ->append('username', 'checkUsername')
            ->append('email', 'checkEmail');
    }

    /**
     * 检测登录名是否存在
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
            ['status', '=', 0],
            ['is_deleted', '=', 0],
        ];
        $member = \app\blog\model\Member::where($where)->find();
        if (!empty($member)) return '已存在此用户，请更换再进行注册！';
        return true;
    }

    protected function checkEmail($value, $rule, $data = []) {
        $where = [
            ['email', '=', $value],
            ['status', '=', 0],
            ['is_deleted', '=', 0],
        ];
        $member = \app\blog\model\Member::where($where)->find();
        if (!empty($member)) return '已存在此邮箱，请更换再进行注册！';
        return true;
    }
}