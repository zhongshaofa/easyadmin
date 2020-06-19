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

}