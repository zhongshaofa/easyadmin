<?php

namespace app\admin\controller\test;

use app\common\controller\AdminController;
use EasyAdmin\annotation\ControllerAnnotation;
use EasyAdmin\annotation\NodeAnotation;
use think\App;

/**
 * @ControllerAnnotation(title="商品列表")
 */
class Goods extends AdminController
{

    use \app\admin\traits\Curd;

    public function __construct(App $app)
    {
        parent::__construct($app);

        $this->model = new \app\admin\model\TestGoods();
        
        $this->assign('getSexList', $this->model->getSexList());

        $this->assign('getCheckboxList', $this->model->getCheckboxList());

        $this->assign('getModeList', $this->model->getModeList());

        $this->assign('getStatusList', $this->model->getStatusList());

    }

    
}