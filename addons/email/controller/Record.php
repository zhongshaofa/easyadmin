<?php


namespace addons\email\controller;


use app\common\controller\AdminController;

class Record extends AdminController
{

    public function index()
    {
        dump(session('admin'));
        echo '邮件发送记录';
    }

    public function list(){
        echo 'email:list';
    }

    public function route(){
        echo 'email:route';
    }

}