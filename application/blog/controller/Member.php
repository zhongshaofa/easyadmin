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

namespace app\blog\controller;


use app\common\controller\BlogController;

/**
 * 会员管理
 * Class Member
 * @package app\blog\controller
 */
class Member extends BlogController {

    /**
     * 模型对象
     */
    protected $model = null;

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
        $this->model = model('Member');
    }

    /**
     * 会员中心
     * @return mixed
     */
    public function index() {
        //基础数据
        $basic_data = [
            'title'   => '个人中心',
            'navMenu' => ['个人中心', '文章管理'],
        ];
        return $this->fetch('', $basic_data);
    }
}