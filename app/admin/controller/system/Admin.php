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

namespace app\admin\controller\system;


use app\admin\model\SystemAdmin;
use app\common\controller\AdminController;
use EasyAdmin\annotation\ControllerAnnotation;
use think\App;

/**
 * Class Admin
 * @package app\admin\controller\system
 * @ControllerAnnotation(title="管理员管理")
 */
class Admin extends AdminController
{

    use \app\admin\traits\Curd;

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->model = new SystemAdmin();
    }

    public function index()
    {
        if ($this->request->isAjax()) {
            list($page, $limit, $where) = $this->buildRequest();
            $count = $this->model->count();
            $list = $this->model
                ->withoutField('password')
                ->page($page, $limit)
                ->select();
            $data = [
                'code'  => 0,
                'msg'   => '',
                'count' => $count,
                'data'  => $list,
            ];
            return json($data);
        }
        return $this->fetch('354353');
    }


}