<?php


namespace addons\email\controller;


use app\BaseController;

class Record extends BaseController
{

    public function index()
    {
        echo '邮件发送记录';
    }

    public function list(){
        echo 'email:list';
    }

    public function route(){
        echo 'email:route';
    }

}