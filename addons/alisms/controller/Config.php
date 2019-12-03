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

namespace addons\alisms\controller;


use addons\alisms\model\AlismsConfig;
use addons\alisms\model\AlismsTemplate;
use EasyAddons\Controller;
use think\App;
use think\facade\Db;

class Config extends Controller
{

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->model = new AlismsConfig();
    }

    /**
     * 配置信息
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index()
    {
        $smsConfig = $this->model
            ->where('group', 'alisms')
            ->order('id', 'asc')
            ->select();

        $templateList = AlismsTemplate::field('name,value,remark')
            ->select();

        $this->assign([
            'sms_config'    => $smsConfig,
            'template_list' => $templateList,
        ]);

        return $this->fetch();
    }

    /**
     * 保存短信配置
     */
    public function saveSms()
    {
        $post = $this->request->post();
        try {
            foreach ($post as $key => $val) {
                $this->model->where('name', $key)
                    ->update([
                        'value' => $val,
                    ]);
            }
        } catch (\Exception $e) {
            $this->error('保存失败');
        }
        $this->success('保存成功');
    }

    /**
     * 保存模板消息
     */
    public function saveTemplate()
    {
        $post = $this->request->post();
        Db::startTrans();
        try {
            AlismsTemplate::where('name IS NOT null')->delete();
            if (!empty($post)) {
                $insertAll = [];
                foreach ($post['name'] as $key => $name) {
                    $insertAll[$key] = [
                        'name'   => $post['name'][$key],
                        'value'  => $post['value'][$key],
                        'remark' => $post['remark'][$key],
                    ];
                }
                (new AlismsTemplate())->insertAll($insertAll);
            }
            Db::commit();
        } catch (\Exception $e) {
            Db::rollback();
            $this->error('保存失败：' . $e->getMessage());
        }
        $this->success('保存成功');
    }

}