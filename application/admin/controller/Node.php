<?php
// +----------------------------------------------------------------------
// | 99PHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018~2020 https://www.99php.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Mr.Chung <chung@99php.cn >
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\common\controller\AdminController;

/**
 * 节点管理
 * Class Node
 * @package app\admin\controller
 */
class Node extends AdminController {

    /**
     * node模型对象
     */
    protected $model = null;

    /**
     * 初始化
     * node constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->model = model('node');
    }

    /**
     * 节点列表
     */
    public function index() {
        if (!$this->request->isPost()) {
            //ajax访问获取数据
            if (!empty($this->request->get('module'))) {
                return json($this->model->nodeModuleList($this->request->get('module')));
            }

            $module_list = $this->model->where(['type' => 1])->order(['node'=>'asc'])->select()->toArray();
            foreach ($module_list as $k => $val) $k == 0 ? $module_list[$k]['is_selectd'] = true : $module_list[$k]['is_selectd'] = false;
            //基础数据
            $basic_data = [
                'title'       => '系统节点列表',
                'module_list' => $module_list,
            ];
            $this->assign($basic_data);

            return $this->fetch('');
        } else {
            $post = $this->request->post();

            //验证数据
            $validate = $this->validate($post, 'app\admin\validate\Node.edit_field');
            if (true !== $validate) return __error($validate);

            //保存数据,返回结果
            return $this->model->edit_field($post);
        }
    }

    /**
     * 更改节点状态
     * @return \think\response\Json
     */
    public function status() {
        $get = $this->request->get();

        //验证数据
        $validate = $this->validate($get, 'app\admin\validate\Node.status');
        if (true !== $validate) return __error($validate);

        //判断菜单状态
        $status = $this->model->where('id', $get['id'])->value('is_auth');
        $status == 1 ? list($msg, $status) = ['节点禁用成功', $status = 0] : list($msg, $status) = ['节点启用成功', $status = 1];

        //执行更新操作操作
        $update = $this->model->where('id', $get['id'])->update(['is_auth' => $status]);

        //清空菜单缓存
        clear_menu();

        if ($update >= 1) return __success($msg);
        return __error('数据有误，请刷新重试！');
    }
}