<?php


namespace addons\answer\controller\admin;


use addons\answer\controller\AnswerAdminController;

class Cate extends AnswerAdminController
{

    public function index()
    {
        dump('addons:admin:answer');
        return $this->fetch();
    }

    public function rule(){
        echo '自定义路由';
    }

}