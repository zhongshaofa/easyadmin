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

namespace app\common\controller;


use app\common\service\AuthService;
use app\common\service\QiniuService;
use think\Controller;
use think\Db;
use think\facade\Cache;

/**
 * 前端博客基础控制器
 * Class BlogController
 * @package app\common\controller
 */
class BlogController extends Controller {

    /**
     * 网站标题
     * @var string
     */
    protected $title = '';

    /**
     * 是否开启登录检测
     * @var bool
     */
    protected $is_login = false;

    /**
     * 是否启用七牛云上传图片
     * @var bool
     */
    protected $is_qiniu = false;

    /**
     * 会员信息
     * @var array
     */
    protected $member = [];

    /**
     * 博客配置信息
     * @var array
     */
    protected $BlogInfo = [];

    /**
     * 构造函数
     * BlogController constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->is_login && $this->checkLogin();
        $this->is_qiniu && $this->iniQiniu();
        $this->BlogInfo = Cache::get('BlogInfo');
        $module_controller = app('request')->module() . '/' . app('request')->controller();
        //QQ快捷登录模块无需执行，执行将报错
        if ($module_controller != 'blog/Oauth') {
            $this->member = session('member');
            if (!empty($this->member)) $this->checkLoginOver($this->member);
        }
    }

    /**
     * 判断会员是否已登录
     */
    public function checkLogin() {
        if (empty(session('member.id'))) {
            return $this->redirect('@blog/login');
        }
    }

    /**
     * 检测登录是否过期
     * @param $member
     */
    public function checkLoginOver($member) {
        (isset($this->BlogInfo['LoginDuration']) && !empty($this->BlogInfo['LoginDuration'])) ? $LoginDuration = $this->BlogInfo['LoginDuration'] : $LoginDuration = '';
        if (!empty($LoginDuration) && isset($member['login_at'])) {
            if (time() - $member['login_at'] >= $LoginDuration) {
                //记录退出登录日志
                Db::name('BlogLoginRecord')->insert([
                    'type'      => 0,
                    'member_id' => $member['id'],
                    'ip'        => get_ip(),
                    'remark'    => '登录已过期，自动退出登录！',
                ]);
                //清空会员数据缓存
                $this->member = [];
                session(null);
            }
        }
    }

    /**
     * 初始化七牛云
     */
    public function iniQiniu() {
        $this->assign(['qiniu_token' => QiniuService::getToken()]);
    }
}