<?php


namespace app\admin\controller\system;


use app\common\controller\AdBaseController;
use app\common\model\SystemMenu;
use think\App;

class Menu extends AdBaseController
{

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->model = new SystemMenu();
    }

    public function index()
    {
        if ($this->request->get('type') == 'ajax') {

            $data = $this->model->select();
            $count = $this->model->count();

            $data1 = [
                [
                    'id'    => 2,
                    'title' => '系统管理',
                    'pid'   => -1,
                ],
                [
                    'id'    => 3,
                    'title' => '系统管理2',
                    'pid'   => 1,
                ],
            ];

            $list = [
                'code'  => 0,
                'msg'   => '获取成功',
                'count' => $count,
                'data'  => $data,
            ];
            return json($list);
        }
        return view();
    }
}