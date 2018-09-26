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
        $this->is_qiniu && $this->iniQiniu();
        $this->BlogInfo = Cache::get('BlogInfo');
        $module_controller = app('request')->module() . '/' . app('request')->controller();
        //QQ快捷登录模块无需执行，执行将报错
        if ($module_controller != 'blog/Oauth') {
            $this->member = session('member');
            if (!empty($this->member)) $this->checkLoginOver($this->member);
            $this->is_login && $this->checkLogin();
        }
    }

    /**
     * 判断会员是否已登录
     */
    public function checkLogin() {
        if (empty(session('member.id'))) {
            return $this->redirect('@blog');
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
                $this->LoginRecord(3);
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

    /**
     * 记录登录日志
     * @param int $type （0：主动退出登录，1：账户登录，2：QQ快捷登录,3：过期退出登录）
     */
    public function LoginRecord($type = 1) {
        switch ($type) {
            case 0:
                $type = 0;
                $remark = '【主动退出】正在退出博客系统！';
                break;
            case 1:
                $type = 1;
                $remark = '【账户登录】正在进入博客系统！';
                break;
            case 2:
                $type = 1;
                $remark = '【QQ快捷】正在进入博客系统！';
                break;
            case 3:
                $type = 0;
                $remark = '【登录过期】正在退出博客系统！';
                break;
            default:
                $type = '3';
                $remark = '【未知】';
        }
        $location_info = get_location();
        if (!empty(session('member.id'))) {
            Db::name('BlogLoginRecord')->insert([
                'type'      => $type,
                'member_id' => session('member.id'),
                'ip'        => get_ip(),
                'country'   => $location_info['country'],
                'region'    => $location_info['region'],
                'city'      => $location_info['city'],
                'isp'       => $location_info['isp'],
                'location'  => $location_info['country'] . $location_info['region'] . $location_info['city'] . $location_info['isp'],
                'remark'    => $remark,
            ]);
        }
    }
}