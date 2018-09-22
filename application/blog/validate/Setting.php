<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5
 * Time: 23:59
 */

namespace app\blog\validate;


use think\Validate;

class Setting extends Validate {

    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'type'  => 'require',
        'email' => 'require|email',
        'phone' => 'require|number|length:11',
        'code'  => 'require|number|length:6',
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
        'code.require'  => '验证码必须',
        'code.number'   => '验证码必须为数字',
        'code.length'   => '验证码为6位数',
    ];

    /**
     * 应用场景
     * @var array
     */
    protected $scene = [
        'code_email' => ['type', 'email'],
        'code_phone' => ['type', 'phone'],
    ];

    /**
     * 绑定邮箱验证场景
     * @return Setting
     */
    public function sceneFormEmail() {
        return $this->only(['email', 'code'])
            ->append('code', 'checkEmailCode');
    }

    /**
     * 验证验证码是否有效
     * @param       $value
     * @param       $rule
     * @param array $data
     */
    protected function checkEmailCode($value, $rule, $data = []) {
        $code_info = cache($data['email'] . '_code');
        if (empty($code_info)) {
            return '请先获取验证码！';
        }
        $CodeDieTime = get_config('code', 'CodeDieTime');
        if ((time() - $code_info['time']) > $CodeDieTime) {
            return '验证码已过期，请重新获取！';
        }
        if ($value != $code_info['code']) {
            return '验证码不正确，请重新输入！';
        }
        cache($data['email'] . '_code', null);
        return true;
    }
}