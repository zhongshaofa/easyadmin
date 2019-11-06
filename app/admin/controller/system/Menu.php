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
use app\common\constants\SystemConstant;
use EasyAdmin\annotation\ControllerAnnotation;
use EasyAdmin\annotation\NodeAnotation;
use app\common\controller\AdminController;
use think\App;

/**
 * Class Menu
 * @package app\admin\controller\system
 * @ControllerAnnotation(title="菜单管理",auth=true)
 */
class Menu extends AdminController
{

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->model = new SystemMenu();
    }

    /**
     * @NodeAnotation(title="菜单列表",auth=true)
     */
    public function index()
    {
        if ($this->request->isAjax()) {
            $list = $this->model->select();
            $data = [
                'code'  => 0,
                'msg'   => '',
                'count' => 19,
                'data'  => $list,
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

    /**
     * 修改字段属性值
     */
    public function modify()
    {
        $post = $this->request->post();
        $rule = [
            'id|ID'    => 'require',
            'field|字段' => 'require',
            'value|值'  => 'require',
        ];
        $this->validate($post, $rule);
        $row = $this->model->find($post['id']);
        empty($row) && $this->error('数据不存在');
        !in_array($post['field'], SystemConstant::ALLOW_MODIFY_FIELD) && $this->error('该字段不允许修改：' . $post['field']);
        try {
            $row->save([
                $post['field'] => $post['value'],
            ]);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
        $this->success('保存成功');
    }

}