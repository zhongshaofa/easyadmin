<?php

// +----------------------------------------------------------------------
// | EasyAdmin
// +----------------------------------------------------------------------
// | PHP交流群: 763822524
// +----------------------------------------------------------------------
// | 开源协议  https://mit-license.org 
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zhongshaofa/EasyAdmin
// +----------------------------------------------------------------------

namespace app\admin\controller;


use app\common\controller\AdminController;


class Login extends AdminController
{
    protected $isLogin = false;

    public function initialize()
    {
        parent::initialize();
        $action = $this->request->action();
        if (!empty(session('admin')) && !in_array($action, ['out'])) {
            $this->redirect(__url('@admin', [], false));
        }
    }

    /**
     * 用户登录
     * @return string
     * @throws \Exception
     */
    public function index()
    {
        if ($this->request->isPost()) {
            $post = $this->request->post();
            $rule = [
                'username|用户名' => 'require',
                'password|密码'  => 'require',
            ];
            $this->validate($post, $rule);
            $this->success('请求成功');
        }
        return $this->fetch();
    }

    /**
     * 用户退出
     * @return mixed
     */
    public function out()
    {
        return $this->out();
    }
}