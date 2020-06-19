<?php


namespace addons\answer\controller\admin;


use app\common\controller\AdminController;

class Cate extends AdminController
{

    public function index()
    {
        echo 'admin : answer : index';
        return $this->fetch();
    }

}