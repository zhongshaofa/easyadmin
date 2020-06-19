<?php


namespace addons\email\controller;


use app\common\controller\AdminController;

class Record extends AdminController
{

    public function index()
    {
        $data = [
            'addon'=>$this->request->addons,
            'controller'=>$this->request->controller(),
            'action'=>$this->request->action(),
        ];
        halt($data);
        return $this->fetch();
    }

    public function list(){
        echo 'email:list';
    }

    public function route(){
        echo 'email:route';
    }

}