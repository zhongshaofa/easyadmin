<?php


namespace addons\email\controller;


use app\common\controller\AdminController;

class Record extends AdminController
{

    public function index()
    {
        $dispatch = $this->app->route->check()->getDispatch();

        dump($dispatch);

        dump(session('admin'));
    }

    public function list(){
        echo 'email:list';
    }

    public function route(){
        echo 'email:route';
    }

}