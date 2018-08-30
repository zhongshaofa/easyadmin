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
 * 文章管理控制器
 * Class Article
 * @package app\admin\controller
 */
class BlogArticle extends AdminController {

    /**
     * 模型对象
     */
    protected $model = null;

    /**
     * 初始化
     * node constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->model = model('BlogArticle');
    }

    /**
     * 博客文章列表
     * @return mixed|\think\response\Json
     */
    public function index() {
        if (!$this->request->isPost()) {

            //ajax访问获取数据
            if ($this->request->get('type') == 'ajax') {
                $page = $this->request->get('page', 1);
                $limit = $this->request->get('limit', 10);
                $select = (array)$this->request->get('select', []);
                return json($this->model->getList($page, $limit, $select));
            }

            //基础数据
            $basic_data = [
                'title'  => '博客文章列表',
                'status' => [['id' => 1, 'title' => '启用'], ['id' => 0, 'title' => '禁用']],
            ];

            return $this->fetch('', $basic_data);
        } else {
            $post = $this->request->post();

            //验证数据
            $validate = $this->validate($post, 'app\admin\validate\Auth.edit_field');
            if (true !== $validate) return __error($validate);

            //保存数据,返回结果
            return $this->model->edit_field($post);
        }
    }
}