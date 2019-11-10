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


use app\admin\model\SystemNode;
use app\common\controller\AdminController;
use EasyAdmin\annotation\ControllerAnnotation;
use EasyAdmin\annotation\NodeAnotation;
use EasyAdmin\auth\Node as NodeService;
use think\App;
use think\facade\Db;

/**
 * @ControllerAnnotation(title="系统节点管理")
 * Class Node
 * @package app\admin\controller\system
 */
class Node extends AdminController
{

    use \app\admin\traits\Curd;

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->model = new SystemNode();
    }


    /**
     * @NodeAnotation(title="列表")
     */
    public function index()
    {
        if ($this->request->isAjax()) {
            $count = $this->model
                ->count();
            $list = $this->model
                ->getNodeTreeList();
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
     * @NodeAnotation(title="系统节点更新")
     * @param int $force
     * @throws \Doctrine\Common\Annotations\AnnotationException
     * @throws \ReflectionException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function refreshNode($force = 0)
    {
        $nodeList = (new NodeService())->getNodelist();
        empty($nodeList) && $this->error('暂无需要更新的系统节点');
        $model = new SystemNode();
        if ($force == 1) {
            $model->whereIn('node', array_column($nodeList, 'node'))->delete();
        } else {
            $existNodeList = $model->field('node,title,type,is_auth')->select();
            foreach ($nodeList as $key => $vo) {
                foreach ($existNodeList as $v) {
                    if ($vo['node'] == $v->node) {
                        unset($nodeList[$key]);
                        break;
                    }
                }
            }
        }
        $model->insertAll($nodeList);
        $this->success('系统节点更新成功');
    }
}