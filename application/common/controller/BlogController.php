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
     * 构造函数
     * BlogController constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->is_login && $this->check_login();
    }

    /**
     * 判断会员是否已登录
     */
    public function check_login() {
        if (empty(session('member.id'))) {
            return $this->redirect('@blog/login');
        }
    }
}