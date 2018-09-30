<?php
/// +----------------------------------------------------------------------
// | 99PHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018~2020 https://www.99php.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Mr.Chung <chung@99php.cn >
// +----------------------------------------------------------------------

namespace app\admin\controller;

use think\Controller;
use think\facade\Cache;

class Login extends Controller {

    /**
     * User模型对象
     */
    protected $model = null;

    /**
     * 初始化
     * Login constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->model = model('User');
        $action = $this->request->action();
        if (!empty(session('user.id')) && $action !== 'out' && $action !== 'change') return $this->redirect('@admin');
    }

    /**
     * 后台登录
     * @return mixed|\think\response\Json
     */
    public function index() {
        if ($this->request->isGet()) {

            //基础数据
            $basic_data = [
                'title' => '久久PHP社区后台登录',
                'data'  => '',
            ];
            $this->assign($basic_data);

            return $this->fetch('');
        } else {
            $post = $this->request->post();

            //判断是否开启验证码登录选择验证规则
            $SysInfo = Cache::get('SysInfo');
            $SysInfo['VercodeType'] != 1 ? $validate_type = 'app\admin\validate\Login.index_off' : $validate_type = 'app\admin\validate\Login.index_on';

            //验证参数
            $validate = $this->validate($post, $validate_type);
            if (true !== $validate) {
                return __error($validate);
            }

            //判断登录是否成功
            $login = $this->model->login($post['username'], $post['password']);
            if ($login['code'] == 1) {
                isset($login['user']['id']) ? $user_id = $login['user']['id'] : $user_id = '';
                \app\admin\service\LogService::loginLog($user_id, 1, 0, "【账号登录】{$login['msg']}");
                return __error($login['msg']);
            }

            //储存session数据
            $login['user']['login_at'] = time();
            session('user', $login['user']);
            \app\admin\service\LogService::loginLog($login['user']['id'], 1, 1, '【账号登录】登录成功，正在进入系统！');
            return __success($login['msg']);
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
                'title' => '久久PHP社区后台登录',
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

        //记录日志
        \app\admin\service\LogService::loginLog(session('user.id'), 0, 1, "【主动退出】正在退出后台系统！");

        //删除自身菜单缓存
        Cache::rm(session('user.id') . '_AdminMenu');

        //清空sesion数据
        session('user', null);

        return msg_success('退出登录成功', url('@admin/login'));
    }
}