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

namespace app\blog\controller;

use app\common\controller\BlogController;
use app\common\service\AuthService;

/**
 * QQ快捷登录验证类
 * Class Oauth
 * @package app\blog\controller
 */
class Oauth extends BlogController {

    /**
     * @var 登录认证对象
     */
    protected $oauth;

    /**
     * 模型对象
     */
    protected $model = null;

    /**
     * 初始化
     * Oauth constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->model = model('Member');
        $this->oauth = new \qq_connect\Oauth();
    }

    /**
     * 快捷登录
     */
    public function index() {
        $this->oauth->qq_login();
    }

    /**
     * 快捷登录回调
     */
    public function callback() {
        //请求accesstoken
        $accesstoken = $this->oauth->qq_callback();
        //获取open_id
        $openid = $this->oauth->get_openid();
        //判断是否存在该用户数据
        $member = $this->model->where(['openid' => $openid, 'status' => 0, 'is_deleted' => 0])->find();
        if (empty($member)) {
            //根据accesstoken和open_id获取用户的基本信息
            $qc = new \qq_connect\QC($accesstoken, $openid);
            $userinfo = $qc->get_user_info();
            if (!empty($userinfo)) {
                $save = [
                    'openid'   => $openid,
                    'nickname' => $userinfo['nickname'],
                    'head_img' => $userinfo['figureurl_qq_2'],
                    'province' => $userinfo['province'],
                    'city'     => $userinfo['city'],
                    'year'     => $userinfo['year'],
                ];
                $this->model->save($save);
                $member = $this->model->where(['openid' => $openid, 'status' => 0, 'is_deleted' => 0])->find();
            } else {
                return msg_error('登录失败，请稍后再试！', url('@blog/login'));
            }
        }
        session_destroy();
        unset($member['password']);

        //记录登录时间
        $member['login_at'] = time();

        //记录登录日志
        model('LoginRecord')->save([
            'type'      => 2,
            'member_id' => $member['id'],
            'ip'        => get_ip(),
            'remark'    => '正在进入博客系统！',
        ]);

        //储存session数据
        session('member', $member);
        return msg_success('登录成功，正在跳转！', url('@blog'));
    }
}