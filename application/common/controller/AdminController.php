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

        //判断是否已登录
        if ($this->is_login == true && empty(session('user.id'))) {
            $data = ['type' => 'error', 'code' => 1, 'msg' => '抱歉，您还没有登录获取访问权限！', 'url' => url('@admin/login')];
            throw new HttpResponseException($this->request->isAjax() ? json($data) : exit(msg_error($data['msg'], $data['url'])));
        }

        //判断是否有权限进行访问
        if ($this->is_auth == true && AuthService::checkNode() == false) {
            $data = ['type' => 'error', 'code' => 1, 'msg' => '抱歉，您暂无该权限，请联系管理员！', 'url' => url('@admin')];
            throw new HttpResponseException($this->request->isAjax() ? json($data) : exit(msg_error($data['msg'], $data['url'])));
        }

        //判断是否有权限访问节点
    }
}