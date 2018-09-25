<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/23
 * Time: 3:40
 */

namespace app\admin_blog\validate;


use think\Validate;

class Member extends Validate {

    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'id'           => 'require|number',
        'username'     => 'require|min:5|max:15|checkUsername',
        'password'     => 'require|min:6|max:20|checkPassword',
        'phone'        => 'require|number|mobile|checkPhone',
        'email'         => 'email|max:20|checkMail',
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
        'email.email'        => '邮箱格式错误',
        'phone.email'       => '手机号格式错误',
        'remark.max'        => '备注最多不能超过250个字符',
    ];

    /**
     * 应用场景
     * @var array
     */
    protected $scene = [
        //添加
        'add'           => ['username', 'password', 'password1', 'phone', 'mail', 'auth_id', 'qq', 'remark'],

        //修改
        'edit'          => ['username', 'phone', 'mail', 'auth_id', 'qq', 'remark'],

        //修改登录密码
        'edit_password' => ['id', 'old_password', 'password', 'password1'],

        //删除
        'del'           => ['id'],

        //更改状态
        'status'       => ['id'],
    ];
}