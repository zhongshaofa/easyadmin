<?php

namespace app\admin\controller;


use app\common\controller\AdminController;
use think\App;

class Index extends AdminController
{

    public function index()
    {
        return $this->fetch();
    }

    public function welcome()
    {
        return $this->fetch();
    }

}
