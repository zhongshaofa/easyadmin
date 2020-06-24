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
        $this->service = new HomeService();
        $this->assign('cateList', $this->service->getCateList());
        $this->assign('homeList', array_reverse($this->service->getHomeList()));
    }

    public function index()
    {
        $h = $this->request->get('h', 'new');
        $data = [
            'checkCate' => 'all',
            'h'         => $h,
        ];
        return $this->fetch('home/index/index', $data);
    }

    public function detail()
    {
        return $this->fetch('home/index/detail');
    }

}