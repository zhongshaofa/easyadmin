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
        $this->service = new HomeService();
        $this->assign('cateList', $this->service->getCateList());
        $this->assign('homeList', array_reverse($this->service->getHomeList()));
    }

    public function index($id)
    {
        $h = $this->request->get('h', 'new');
        $data = [
            'checkCate' => 'all',
            'h'         => $h,
        ];
        return $this->fetch('home/index/index', $data);
    }

    public function all()
    {
        $h = $this->request->get('h', 'new');
        $data = [
            'checkCate' => 'all',
            'h'         => $h,
        ];
        return $this->fetch('home/index/index', $data);
    }

}