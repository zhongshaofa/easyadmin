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


use app\admin\model\SystemConfig;
use app\common\controller\AdminController;
use EasyAdmin\annotation\ControllerAnnotation;
use EasyAdmin\annotation\NodeAnotation;
use think\App;

/**
 * Class Config
 * @package app\admin\controller\system
 * @ControllerAnnotation(title="系统配置管理")
 */
class Config extends AdminController
{

    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->model = new SystemConfig();
    }

    /**
     * @NodeAnotation(title="系统配置")
     */
    public function index()
    {
        if ($this->request->isAjax()) {
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
        return $this->fetch();
    }

}