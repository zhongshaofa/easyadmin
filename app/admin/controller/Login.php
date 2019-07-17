<?php


namespace app\admin\controller;

use app\admin\logic\LoginLogic;
use app\common\controller\AdBaseController;
use think\App;
use think\facade\Session;

class Login extends AdBaseController
{

    protected $isLogin = false;

    public function __construct(App $app)
    {
        parent::__construct($app);
        $action = $this->request->action();
        if (!empty(session('admin')) && !in_array($action, ['out'])) {
            $this->redirect(url_build('@admin', [], false));
        }
        $this->logic = new LoginLogic();
    }

    /**
     * 登录
     * @return \think\response\View|void
     */
    public function index()
    {
        if ($this->request->isPost()) {
            $rule     = [
                'username|用户名' => 'require',
                'password|密码'  => 'require',
            ];
            $validate = $this->validate($rule);
            if ($validate !== true) {
                $this->error($validate);
            }
            $this->setSelectParam(['username', 'password']);
            $logicResult = $this->logic->checkLogin($this->selectParame);
            if ($logicResult['code'] == 0) {
                $this->error($logicResult['msg']);
            } else {
                $this->success($logicResult['msg'], url_build('@admin', [], false));
            }
        }
        return view();
    }

    /**
     *  退出
     */
    public function out()
    {
        Session::clear();
        $this->success('退出登录成功', url_build('/admin/login'));
    }
}