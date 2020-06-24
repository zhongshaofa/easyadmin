<?php

// +----------------------------------------------------------------------
// | EasyAdmin
// +----------------------------------------------------------------------
// | PHP交流群: 763822524
// +----------------------------------------------------------------------
// | 开源协议  https://mit-license.org 
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zhongshaofa/EasyAdmin
// +----------------------------------------------------------------------

namespace addons\answer\controller\home;


use addons\answer\controller\AnswerHomeController;
use addons\answer\service\HomeService;
use think\App;

class Index extends AnswerHomeController
{

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->assign('cateList', (new HomeService())->getCateList());
    }

    public function index()
    {
        $data = [
            'checkCate' => 'all',
        ];
        return $this->fetch('home/index/index', $data);
    }

    public function detail()
    {
        return $this->fetch('home/index/detail');
    }

}