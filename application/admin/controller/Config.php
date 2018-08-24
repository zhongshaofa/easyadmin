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
 * 系统配置
 * Class Config
 * @package app\admin\controller
 */
class Config extends AdminController {

    /**
     * config模型对象
     */
    protected $model = null;

    /**
     * 初始化
     * node constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->model = model('config');
    }

    /**
     * 系统配置信息列表
     */
    public function index() {
        if (!$this->request->isPost()) {

            //ajax访问获取数据
            if ($this->request->get('type') == 'ajax') {
                $page = $this->request->get('page', 1);
                $limit = $this->request->get('limit', 100);
                $select = (array)$this->request->get('select', []);
                return json($this->model->configList($page, $limit, $select));
            }

            //基础数据
            $basic_data = [
                'title' => '系统参数列表',
            ];
            $this->assign($basic_data);

            return $this->fetch('');
        } else {
            $post = $this->request->post();

            //验证数据
            $validate = $this->validate($post, 'app\admin\validate\Config.edit_field');
            if (true !== $validate) return __error($validate);

            //清除缓存
            clear_basic();

            //保存数据,返回结果
            return $this->model->edit_field($post);
        }
    }
}