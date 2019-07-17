<?php


namespace app\admin\controller;

use app\common\controller\AdBaseController;
use app\common\service\NodeService;
use think\facade\Session;

class Index extends AdBaseController
{

    public function index(){
        return view();
    }

    public function welcome(){
        return view();
    }
}