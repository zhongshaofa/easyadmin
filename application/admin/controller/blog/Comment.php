<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/11
 * Time: 21:05
 */

namespace app\admin\controller\blog;


use app\common\controller\AdminController;

/**
 * 文章评论控制器
 * Class Comment
 * @package app\admin\controller\blog
 */
class Comment extends AdminController {

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
        $this->model = new \app\admin\model\blog\Comment;
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
            'title' => '文章评论',
            'data'  => '',
        ];
        return $this->fetch('', $basic_data);
    }

    /**
     * 删除
     * @return \think\response\Json
     */
    public function del() {
        $get = $this->request->get();

        //验证数据
        if (!is_array($get['id'])) {
            $validate = $this->validate($get, 'app\admin\validate\blog\Comment.del');
            if (true !== $validate) return __error($validate);
        }

        //执行删除操作
        return $this->model->delData($get['id'], true);
    }
}