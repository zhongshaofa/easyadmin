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
use app\admin\model\SystemNode;
use app\admin\service\TriggerService;
use app\common\constants\MenuConstant;
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

    use \app\admin\traits\Curd;

    protected $sort = [
        'sort' => 'desc',
        'id'   => 'asc',
    ];

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->model = new SystemMenu();
    }

    /**
     * @NodeAnotation(title="列表")
     */
    public function index()
    {
        if ($this->request->isAjax()) {
            if (input('selectFields')) {
                return $this->selectList();
            }
            $count = $this->model->count();
            $list = $this->model->order($this->sort)->select();
            $data = [
                'code'  => 0,
                'msg'   => '',
                'count' => $count,
                'data'  => $list,
            ];
            return json($data);
        }
        return $this->fetch();
    }

    /**
     * @NodeAnotation(title="添加")
     */
    public function add($id = null)
    {
        $homeId = $this->model
            ->where([
                'pid' => MenuConstant::HOME_PID,
            ])
            ->value('id');
        if ($id == $homeId) {
            $this->error('首页不能添加子菜单');
        }
        if ($this->request->isAjax()) {
            $post = $this->request->post();
            $rule = [
                'pid|上级菜单'   => 'require',
                'title|菜单名称' => 'require',
                'icon|菜单图标'  => 'require',
            ];
            $this->validate($post, $rule);
            try {
                $save = $this->model->save($post);
            } catch (\Exception $e) {
                $this->error('保存失败');
            }
            if ($save) {
                TriggerService::updateMenu();
                $this->success('保存成功');
            } else {
                $this->error('保存失败');
            }
        }
        $pidMenuList = $this->model->getPidMenuList();
        $this->assign('id', $id);
        $this->assign('pidMenuList', $pidMenuList);
        return $this->fetch();
    }

    /**
     * @NodeAnotation(title="编辑")
     */
    public function edit($id)
    {
        $row = $this->model->find($id);
        empty($row) && $this->error('数据不存在');
        if ($this->request->isAjax()) {
            $post = $this->request->post();
            $rule = [
                'pid|上级菜单'   => 'require',
                'title|菜单名称' => 'require',
                'icon|菜单图标'  => 'require',
            ];
            $this->validate($post, $rule);
            try {
                $save = $row->save($post);
            } catch (\Exception $e) {
                $this->error('保存失败');
            }
            if ($save) {
                TriggerService::updateMenu();
                $this->success('保存成功');
            } else {
                $this->error('保存失败');
            }
        }
        $pidMenuList = $this->model->getPidMenuList();
        $this->assign([
            'id'          => $id,
            'pidMenuList' => $pidMenuList,
            'row'         => $row,
        ]);
        return $this->fetch();
    }

    /**
     * @NodeAnotation(title="删除")
     */
    public function delete($id)
    {
        $row = $this->model->whereIn('id', $id)->select();
        empty($row) && $this->error('数据不存在');
        try {
            $save = $row->delete();
        } catch (\Exception $e) {
            $this->error('删除失败');
        }
        if ($save) {
            TriggerService::updateMenu();
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }

    /**
     * @NodeAnotation(title="属性修改")
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
        if (!$row) {
            $this->error('数据不存在');
        }
        if (!in_array($post['field'], $this->allowModifyFields)) {
            $this->error('该字段不允许修改：' . $post['field']);
        }
        $homeId = $this->model
            ->where([
                'pid' => MenuConstant::HOME_PID,
            ])
            ->value('id');
        if ($post['id'] == $homeId && $post['field'] == 'status') {
            $this->error('首页状态不允许关闭');
        }
        try {
            $row->save([
                $post['field'] => $post['value'],
            ]);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
        TriggerService::updateMenu();
        $this->success('保存成功');
    }

    /**
     * @NodeAnotation(title="添加菜单提示")
     */
    public function getMenuTips()
    {
        $node = input('get.keywords');
        $list = SystemNode::whereLike('node', "%{$node}%")
            ->field('node,title')
            ->limit(10)
            ->select();
        return json([
            'code'    => 0,
            'content' => $list,
            'type'    => 'success',
        ]);
    }

}