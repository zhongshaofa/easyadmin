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

class Login extends BlogController {

    /**
     * 模型对象
     */
    protected $model = null;

    /**
     * 初始化
     * Login constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->model = model('Member');
        $action = $this->request->action();
        if (!empty(session('member.id')) && $action !== 'out' && $action !== 'change') return $this->redirect('@blog');
    }

    /**
     * 博客登录
     * @return mixed|\think\response\Json
     */
    public function index() {
        if (!$this->request->isPost()) {

            //基础数据
            $basic_data = [
                'title' => '登录||久久PHP社区',
            ];
            return $this->fetch('', $basic_data);
        } else {
            $post = $this->request->post();

            //验证参数
            $validate = $this->validate($post, 'app\blog\validate\Login.index');
            if (true !== $validate) return __error($validate);

            //判断登录是否成功
            $login = $this->model->login($post['username'], $post['password']);
            if ($login['code'] == 1) return __error($login['msg']);

            //记录登录时间
            $login['member']['login_at'] = time();

            //储存session数据
            session('member', $login['member']);
            return __success($login['msg']);
        }
    }

    /**
     * 用户注册
     */
    public function register() {
        if (!$this->request->isPost()) {
            //基础数据
            $basic_data = [
                'title' => '注册||久久PHP社区',
            ];
            return $this->fetch('', $basic_data);
        } else {
            $post = $this->request->post();

            //验证数据
            $validate = $this->validate($post, 'app\blog\validate\Login.register');
            if (true !== $validate) return __error($validate);

            //密码加密
            $post['password'] = password($post['password']);

            //保存数据,返回结果
            return $this->model->register($post);
        }
    }

    /**
     * 切换账户
     * @return mixed
     */
    public function change() {
        if ($this->request->isGet()) {

            //基础数据
            $basic_data = [
                'title' => '久久PHP社区登录',
                'data'  => '',
            ];
            $this->assign($basic_data);

            return $this->fetch('index');
        }
    }

    /**
     * 退出登录
     * @return \think\response\Json
     */
    public function out() {

        //清空sesion数据
        session(null);

        return __success('退出登录成功');
    }
}