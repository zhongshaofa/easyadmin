<?php


namespace app\admin\controller;

use app\common\controller\AdBaseController;
use think\facade\Db;

class Index extends AdBaseController
{

    public function index(){
        return view();
    }

    public function welcome(){
        return view();
    }

    public function test(){
       $data = Db::name('system_admin')->find();
        debug($data);
    }
}