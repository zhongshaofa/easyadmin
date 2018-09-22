<?php

// +----------------------------------------------------------------------
// | Think.Admin
// +----------------------------------------------------------------------
// | 版权所有 2014~2017 广州楚才信息科技有限公司 [ http://www.cuci.cc ]
// +----------------------------------------------------------------------
// | 官方网站: http://think.ctolog.com
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zoujingli/Think.Admin
// +----------------------------------------------------------------------

namespace app\blog\validate;


use think\Validate;

class ApiSend extends Validate {

    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'type'  => 'require',
        'email' => 'require|email',
        'phone' => 'require|number|length:11',
    ];

    /**
     * 错误提示
     * @var array
     */
    protected $message = [
        'type.require'  => '验证码类型必须',
        'email.require' => '邮箱必须',
        'email.email'   => '邮箱类型不对',
        'phone.require' => '手机号必须',
        'phone.number'  => '手机号必须为数字',
        'phone.length'  => '手机号不正确',
    ];

    /**
     * 应用场景
     * @var array
     */
    protected $scene = [
        'code_email' => ['type', 'email'],
        'code_phone' => ['type', 'phone'],
    ];
}