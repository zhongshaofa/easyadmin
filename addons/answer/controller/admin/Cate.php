<?php


namespace addons\answer\controller\admin;


use addons\answer\controller\AnswerAdminController;

class Cate extends AnswerAdminController
{

    public function index()
    {
        halt($this->app->addons);
        return $this->fetch();
    }

    public function rule(){
        echo '自定义路由';
    }

}