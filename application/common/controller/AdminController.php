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

use think\Controller;
use think\Db;
use think\exception\HttpResponseException;
use app\common\service\AuthService;

/**
 * 后台基础控制器
 * Class AdminController
 * @package controller
 */
class AdminController extends Controller {

    /**
     * 开启登录控制
     * @var bool
     */
    protected $is_login = true;

    /**
     * 开启权限控制
     * @var bool
     */
    protected $is_auth = '';

    /**
     * 网站栏目
     * @var string
     */
    protected $nav = '';

    /**
     * 登录用户信息
     * @var string
     */
    protected $user = '';

    /**
     * 后台配置信息
     * @var array
     */
    protected $SysInfo = [];

    /**
     * 网站标题
     * @var string
     */
    protected $title = '';

    /**
     * 初始化数据
     * Index constructor.
     */
    public function __construct() {
        parent::__construct();
        list($this->nav, $this->title, $this->is_login, $this->is_auth,) = ['', '', true, true];
        $this->SysInfo = cache('SysInfo');

        //检测登录情况
        if ($this->is_login == true) {
            $this->__checkLogin();
        }

        //判断是否有权限进行访问
        if ($this->is_auth == true) {
            $this->__checkAuth();
        }
    }

    /**
     * 检测登录
     */
    public function __checkLogin() {
        $user = session('user');
        //判断是否登录
        if (empty($user)) {
            $data = ['type' => 'error', 'code' => 1, 'msg' => '抱歉，您还没有登录获取访问权限！', 'url' => url('@admin/login')];
        }
        //判断登录是否过期
        (isset($this->SysInfo['LoginDuration']) && !empty($this->SysInfo['LoginDuration'])) ? $LoginDuration = $this->SysInfo['LoginDuration'] : $LoginDuration = '';
        if (!empty($LoginDuration) && !empty($user)) {
            if (time() - $user['login_at'] >= $LoginDuration) {
                \app\admin\service\LogService::loginLog($user['id'], 0, 1, "【登录过期】正在退出后台系统！");
                $data = ['type' => 'error', 'code' => 1, 'msg' => '登录已过期，请重新登录！', 'url' => url('@admin/login')];
            }
        }
        //返回错误信息
        if (!empty($data)) {
            session('user', null);
            throw new HttpResponseException($this->request->isAjax() ? json($data) : exit(msg_error($data['msg'], $data['url'])));
        }
        $this->user = $user;
    }

    /**
     * 检测登录情况
     */
    public function __checkAuth() {
        if (AuthService::checkNode() == false) {
            $data = ['type' => 'error', 'code' => 1, 'msg' => '抱歉，您暂无该权限，请联系管理员！', 'url' => url('@admin')];
            throw new HttpResponseException($this->request->isAjax() ? json($data) : exit(msg_error($data['msg'], $data['url'])));
        }
    }
}