<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Mr.Chung <chung@99php.com>
// +----------------------------------------------------------------------

namespace app\admin\logic;

use app\common\model\SystemAdmin;

class LoginLogic
{

    protected $model;

    public function __construct()
    {
        $this->model = new SystemAdmin();
    }

    public function checkLogin($param)
    {
        $param['password'] = password($param['password']);
        $admin = $this->model->where($param)->find();
        if (empty($admin)) {
            return ['code' => 0, 'msg' => '用户不存在或者账号密码错误'];
        } elseif ($admin->status == 0) {
            return ['code' => 0, 'msg' => '账户已被禁用'];
        } else {
            $admin->logintime = time();
            session('admin', $admin->toArray());
            return ['code' => 1, 'msg' => '登录成功'];
        }
    }

}