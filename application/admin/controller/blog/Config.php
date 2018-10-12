<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/11
 * Time: 23:00
 */

namespace app\admin\controller\blog;


use app\common\controller\AdminController;

/**
 * 博客配置控制器
 * Class Config
 * @package app\admin\controller\blog
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
        $this->model = new \app\admin\model\blog\Config;
    }

    /**
     * 系统配置信息列表
     */
    public function index() {
        if (!$this->request->isPost()) {

            //ajax访问获取数据
            if ($this->request->get('type') == 'ajax') {
                $page = $this->request->get('page', 1);
                $limit = $this->request->get('limit', 500);
                $search = (array)$this->request->get('search', []);
                return json($this->model->getList($page, $limit, $search));
            }

            //基础数据
            $basic_data = [
                'title' => '博客配置列表',
            ];
            $this->assign($basic_data);

            return $this->fetch('');
        } else {
            $post = $this->request->post();

            //验证数据
            $validate = $this->validate($post, 'app\admin\validate\Common.edit_field');
            if (true !== $validate) return __error($validate);

            //清除缓存
            clear_basic();

            //保存数据,返回结果
            return $this->model->editField($post);
        }
    }
}