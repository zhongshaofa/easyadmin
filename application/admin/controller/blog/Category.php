<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/27
 * Time: 1:34
 */

namespace app\admin\controller\blog;


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
        $this->model = new \app\admin\model\blog\Category;
    }

    /**
     * 文章分类
     * @return mixed|\think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index() {
        if (!$this->request->isPost()) {
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
        } else {
            $post = $this->request->post();

            //验证数据
            $validate = $this->validate($post, 'app\admin\validate\blog\Category.edit_field');
            if (true !== $validate) return __error($validate);

            //保存数据,返回结果
            return $this->model->editField($post);
        }
    }

    /**
     * 添加
     * @return mixed
     */
    public function add() {
        if (!$this->request->isPost()) {
            $basic_data = [
                'title' => '添加分类',
            ];
            return $this->fetch('form', $basic_data);
        } else {
            $post = $this->request->post();

            //验证数据
            $validate = $this->validate($post, 'app\admin\validate\blog\Category.add');
            if (true !== $validate) return __error($validate);

            //保存数据,返回结果
            return $this->model->addData($post);
        }
    }

    /**
     * 修改
     * @return mixed|string|\think\response\Json
     */
    public function edit() {
        if (!$this->request->isPost()) {

            //查找所需修改用户
            $category = $this->model->where('id', $this->request->get('id'))->find();
            if (empty($category)) return msg_error('暂无数据，请重新刷新页面！');

            //基础数据
            $basic_data = [
                'title'    => '修改会员信息',
                'category' => $category,
            ];
            return $this->fetch('form', $basic_data);
        } else {
            $post = $this->request->post();

            //验证数据
            $validate = $this->validate($post, 'app\admin\validate\blog\Category.edit');
            if (true !== $validate) return __error($validate);

            //保存数据,返回结果
            return $this->model->editData($post);
        }
    }

    /**
     * 删除
     * @return \think\response\Json
     */
    public function del() {
        $get = $this->request->get();

        //验证数据
        if (!is_array($get['id'])) {
            $validate = $this->validate($get, 'app\admin\validate\blog\Category.del');
            if (true !== $validate) return __error($validate);
        }

        //执行删除操作
        return $this->model->delData($get['id'], true);
    }

    /**
     * 更改状态
     * @return \think\response\Json
     */
    public function status() {
        $get = $this->request->get();

        //验证数据
        $validate = $this->validate($get, 'app\admin\validate\blog\Category.status');
        if (true !== $validate) return __error($validate);

        //判断状态
        $status = $this->model->where('id', $get['id'])->value('status');
        $status == 1 ? list($msg, $status) = ['启用成功', $status = 0] : list($msg, $status) = ['禁用成功', $status = 1];

        //执行更新操作操作
        $update = $this->model->where('id', $get['id'])->update(['status' => $status]);

        if ($update >= 1) return __success($msg);
        return __error('数据有误，请刷新重试！');
    }

}
