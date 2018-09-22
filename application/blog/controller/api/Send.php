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

namespace app\blog\controller\api;


use app\common\controller\BlogController;
use app\common\service\MailService;
use app\common\service\SmsService;
use think\Db;

/**
 * 发送验证码
 * Class Code
 * @package app\blog\controller\api
 */
class Send extends BlogController {

    /**
     * 开启登录控制
     * @var bool
     */
    protected $is_login = true;

    /**
     * 初始化
     * Member constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * 验证码接口
     * 用法 => [
     *  短信：{type: 'phone',phone: '15521045862'}
     *  邮箱：{type: 'email',email: 'chung@99php.cn'}
     * ]
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function code() {
        if ($this->request->isPost()) {
            $post = $this->request->post();
            if (empty($post['type'])) {
                return __error('验证类型不能为空！');
            }
            list($code, $code_time) = [code(), get_config('code', 'CodeTime')];
            switch ($post['type']) {
                case 'email':
                    $validate = $this->validate($post, 'app\blog\validate\ApiSend.code_email');
                    if (true !== $validate) {
                        return __error($validate);
                    }
                    $check_send = $this->check_send_time($post['email'], $code_time);
                    if (true !== $check_send) {
                        return __error($check_send . '秒后才能再次发送！');
                    }
                    $template = Db::name('EmailTemplate')->where(['type' => 1])->find();
                    if (empty($template)) {
                        return __error('邮箱模板不存在！');
                    }
                    $message = str_replace('${code}', $code, $template['value']);
                    $send = MailService::send($post['email'], $template['name'], $message);
                    if ($send['code'] == 0) {
                        cache($post['email'] . '_code', ['code' => $code, 'time' => time()]);
                        Db::name('BlogMsgRecord')->insert(['type' => 0, 'send_type' => 1, 'send' => $post['email'], 'message' => $message]);
                        return __success('邮箱发送成功！');
                    } else {
                        return __error('邮箱发送失败！');
                    }
                    break;
                case 'phone':
                    $validate = $this->validate($post, 'app\blog\validate\ApiSend.code_phone');
                    if (true !== $validate) {
                        return __error($validate);
                    }
                    $check_send = $this->check_send_time($post['phone'], $code_time);
                    if (true !== $check_send) {
                        return __error($check_send . '秒后才能再次发送！');
                    }
                    $send = SmsService::sendSms($post['phone'], ['code' => $code]);
                    $send = (array)$send;
                    if ($send['Code'] == 'OK') {
                        cache($post['phone'] . '_code', ['code' => $code, 'time' => time()]);
                        $template = Db::name('SmsTemplate')->where(['type' => 1])->find();
                        if (!empty($template)) {
                            $message = str_replace('${code}', $code, $template['value']);
                            Db::name('BlogMsgRecord')->insert(['type' => 0, 'send_type' => 0, 'send' => $post['phone'], 'message' => $message]);
                        }
                        return __success('手机短信发送成功！');
                    } else {
                        return __error('手机短信发送失败！');
                    }
                    break;
                default:
                    return __error('验证类型有误！');
            }
        }
    }

    /**
     * 检测验证码发送时间
     * @param $value
     * @param $code_time
     * @return bool|int
     */
    protected function check_send_time($value, $code_time) {
        $send = cache($value . '_code');
        if (!empty($send)) {
            if ((time() - $send['time']) < $code_time) {
                return $code_time - (time() - $send['time']);
            }
        }
        return true;
    }
}