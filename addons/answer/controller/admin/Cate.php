<?php


namespace addons\answer\controller\admin;


use addons\answer\controller\AnswerAdminController;
use addons\answer\model\AnswerCate;
use app\admin\traits\Curd;
use think\App;

class Cate extends AnswerAdminController
{

    use Curd;

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->model = new AnswerCate();
    }

}