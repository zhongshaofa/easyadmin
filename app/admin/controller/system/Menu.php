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


use app\admin\model\SystemMenu;
use EasyAdmin\annotation\ControllerAnnotation;
use EasyAdmin\annotation\NodeAnotation;
use app\common\controller\AdminController;

/**
 * Class Menu
 * @package app\admin\controller\system
 * @ControllerAnnotation(title="菜单管理",auth=true)
 */
class Menu extends AdminController
{



    public function initialize()
    {
        parent::initialize();
    }

    /**
     * @NodeAnotation(title="菜单列表",auth=true)
     */
    public function index()
    {
        if ($this->request->isAjax()) {
            $this->model = new SystemMenu();
            $list = $this->model->select();
            $data = [
                'code'=>0,
                'msg'=>'',
                'count'=>19,
                'data'=>$list
            ];
            return json($data);
        }
        return $this->fetch();
    }

    /**
     * @NodeAnotation(title="添加菜单",auth=true)
     */
    public function add()
    {
        return $this->fetch();
    }

    /**
     * @NodeAnotation(title="编辑菜单",auth=true)
     */
    public function edit()
    {
        return $this->fetch();
    }

    /**
     * @NodeAnotation(title="删除菜单",auth=true)
     */
    public function del()
    {
        return $this->fetch();
    }

}