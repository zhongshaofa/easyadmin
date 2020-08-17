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


use app\admin\model\SystemAuth;
use app\admin\model\SystemAuthNode;
use app\admin\service\TriggerService;
use app\common\controller\AdminController;
use EasyAdmin\annotation\ControllerAnnotation;
use EasyAdmin\annotation\NodeAnotation;
use think\App;

/**
 * @ControllerAnnotation(title="角色权限管理")
 * Class Auth
 * @package app\admin\controller\system
 */
class Auth extends AdminController
{

    use \app\admin\traits\Curd;

    protected $sort = [
        'sort' => 'desc',
        'id'   => 'desc',
    ];

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->model = new SystemAuth();
    }

    /**
     * @NodeAnotation(title="授权")
     */
    public function authorize($id)
    {
        $row = $this->model->find($id);
        empty($row) && $this->error('数据不存在');
        if ($this->request->isAjax()) {
            $list = $this->model->getAuthorizeNodeListByAdminId($id);
            $this->success('获取成功', $list);
        }
        $this->assign('row', $row);
        return $this->fetch();
    }

    /**
     * @NodeAnotation(title="授权保存")
     */
    public function saveAuthorize()
    {
        $id = $this->request->post('id');
        $node = $this->request->post('node', "[]");
        $node = json_decode($node, true);
        $row = $this->model->find($id);
        empty($row) && $this->error('数据不存在');
        try {
            $authNode = new SystemAuthNode();
            $authNode->where('auth_id', $id)->delete();
            if (!empty($node)) {
                $saveAll = [];
                foreach ($node as $vo) {
                    $saveAll[] = [
                        'auth_id' => $id,
                        'node_id' => $vo,
                    ];
                }
                $authNode->saveAll($saveAll);
            }
            TriggerService::updateMenu();
        } catch (\Exception $e) {
            $this->error('保存失败');
        }
        $this->success('保存成功');
    }

}