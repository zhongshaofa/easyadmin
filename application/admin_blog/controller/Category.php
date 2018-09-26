<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/27
 * Time: 1:34
 */

namespace app\admin_blog\controller;


use app\common\controller\AdminController;

class Category extends AdminController {

    /**
     * 默认模型对象
     */
    protected $model = null;

    /**
     * 初始化
     * User constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->model = new \app\admin_blog\model\Category;
    }

    /**
     * 文章分类
     * @return mixed|\think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index() {
        if ($this->request->get('type') == 'ajax') {
            $page = $this->request->get('page', 1);
            $limit = $this->request->get('limit', 10);
            $search = (array)$this->request->get('search', []);
            return json($this->model->getList($page, $limit, $search));
        }
        $basic_data = [
            'title' => '文章分类',
            'data'  => '',
        ];
        return $this->fetch('', $basic_data);
    }

}