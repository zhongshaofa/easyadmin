<?php


namespace app\admin\controller\system;


use app\common\controller\AdminController;
use app\admin\model\SystemCrontab;
use app\admin\model\SystemCrontabFlow;
use app\admin\traits\Curd;
use EasyAdmin\annotation\ControllerAnnotation;
use EasyAdmin\annotation\NodeAnotation;
use think\App;
use utils\service\CrontabService;
use utils\MyToolkit;

/**
 * @ControllerAnnotation(title="定时任务管理")
 * Class Crontab
 * @package app\admin\system\controller
 */
class Crontab extends AdminController
{
    use Curd;

    protected $relationSearch = true;

    protected $sort = [
        'sort' => 'desc',
        'id' => 'desc'
    ];

    protected $allowModifyFields = [
        'status',
        'sort',
        'remark',
        'is_delete',
        'is_auth',
        'title',
        'frequency',
        'shell'
    ];

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->model = new SystemCrontab();
    }

    /**
     * @NodeAnotation(title="添加")
     */
    public function add()
    {
        if ($this->request->isAjax()) {
            $post = $this->request->post();
            $rule = [];
            $this->validate($post, $rule);
            try {
                $save = $this->model->save($post);
                if ($post['status'] == 1) {
                    $this->crontab($this->model->id, CrontabService::OPERATION_CREATE);
                }
            } catch (\Exception $e) {
                $this->error('保存失败:' . $e->getMessage());
            }
            $save ? $this->success('保存成功') : $this->error('保存失败');
        }

        return $this->fetch('', ['type' => SystemCrontab::typeText()]);
    }

    /**
     * @NodeAnotation(title="属性修改")
     */
    public function modify()
    {
        $post = $this->request->post();
        $rule = [
            'id|ID' => 'require',
            'field|字段' => 'require',
            'value|值' => 'require',
        ];
        $this->validate($post, $rule);
        $row = $this->model->find($post['id']);
        if (!$row) {
            $this->error('数据不存在');
        }
        if (!in_array($post['field'], $this->allowModifyFields)) {
            $this->error('该字段不允许修改：' . $post['field']);
        }
        try {
            if ($post['field'] === 'status') {
                $type = $post['value'] == 1 ? CrontabService::OPERATION_CREATE : CrontabService::OPERATION_DELETE;
                $this->crontab($post['id'], $type);
            }

            $row->save([
                $post['field'] => $post['value'],
            ]);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
        $this->success('保存成功');
    }

    /**
     * @NodeAnotation(title="日志")
     */
    public function flow($id)
    {
        if ($this->request->isAjax()) {
            list($page, $limit, $where) = $this->buildTableParames();
            $model = new SystemCrontabFlow();
            $count = $model
                ->where('sid', $id)
                ->where($where)
                ->count();
            $list = $model
                ->where('sid', $id)
                ->where($where)
                ->page($page, $limit)
                ->order(['id' => 'desc'])
                ->select();
            $data = [
                'code' => 0,
                'msg' => 'OK',
                'count' => $count,
                'data' => $list,
            ];

            return json($data);
        }

        return $this->fetch('', ['id' => $id]);
    }

    /**
     * @NodeAnotation(title="重启")
     */
    public function reload($id)
    {
        try {
            $this->crontab($id, CrontabService::OPERATION_RELOAD);
            $row = $this->model->find($id);
            $row->save(['status' => 1]);
        } catch (\Exception $e) {
            $this->error('重启失败:' . $e->getMessage());
        }
        $this->success('重启成功');
    }

    /**
     * 请求请示任务程序
     * @param $id
     * @param $type
     * @return bool|string
     * @throws \Exception
     */
    protected function crontab($id, $type)
    {
        return MyToolkit::curlRequest(CrontabService::getSocketName() . '?id=' . $id . '&type=' . $type);
    }
}
