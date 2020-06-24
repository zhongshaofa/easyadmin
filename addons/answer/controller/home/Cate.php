<?php


namespace addons\answer\controller\home;


use addons\answer\controller\AnswerHomeController;
use addons\answer\service\HomeService;
use think\App;

class Cate extends AnswerHomeController
{

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->assign('cateList', (new HomeService())->getCateList());
    }

    public function index($id)
    {
        dump($id);
    }

    public function all(){
        echo 'cate:all';
    }

}