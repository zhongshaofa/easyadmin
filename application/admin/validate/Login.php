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
use think\captcha\Captcha;

/**
 * 后台登录验证类
 * Class Login
 * @package app\admin\validate
 */
class Login extends Validate {

    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'username' => 'require|max:15',
        'password' => 'require|max:20',
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
    ];

    /**
     * 应用场景
     * @var array
     */
    protected $scene = [
        //开启验证码登录
        'index_on'  => ['username', 'password', 'vercode'],

        //关闭验证码登录
        'index_off' => ['username', 'password'],
    ];
}