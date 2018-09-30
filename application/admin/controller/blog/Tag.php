<?php

// +----------------------------------------------------------------------
// | Think.Admin
// +----------------------------------------------------------------------
// | 版权所有 2014~2017 广州楚才信息科技有限公司 [ http://www.cuci.cc ]
// +----------------------------------------------------------------------
// | 官方网站: http://think.ctolog.com
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zoujingli/Think.Admin
// +----------------------------------------------------------------------

namespace app\admin\controller\blog;


use app\common\controller\AdminController;

class Tag extends AdminController {

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
        $this->model = new \app\admin\model\blog\Tag;
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
            'title' => '标签列表',
            'data'  => '',
        ];
        return $this->fetch('', $basic_data);
    }

    /**
     * 添加标签
     * @return mixed
     */
    public function add() {
        if (!$this->request->isPost()) {
            $basic_data = [
                'title' => '添加标签',
            ];
            return $this->fetch('form', $basic_data);
        } else {
            $post = $this->request->post();

            //验证数据
            $validate = $this->validate($post, 'app\admin_blog\validate\Tag.add');
            if (true !== $validate) return __error($validate);

            //保存数据,返回结果
            return $this->model->add($post);
        }
    }

    /**
     * 修改标签信息
     * @return mixed|string|\think\response\Json
     */
    public function edit() {
        if (!$this->request->isPost()) {

            //查找所需修改用户
            $tag = $this->model->where('id', $this->request->get('id'))->find();
            if (empty($member)) return msg_error('暂无数据，请重新刷新页面！');

            //基础数据
            $basic_data = [
                'title' => '修改标签信息',
                'data'  => $tag,
            ];
            return $this->fetch('form', $basic_data);
        } else {
            $post = $this->request->post();

            //验证数据
            $validate = $this->validate($post, 'app\admin_blog\validate\Member.edit');
            if (true !== $validate) return __error($validate);

            //保存数据,返回结果
            return $this->model->edit($post);
        }
    }

    /**
     * 删除
     * @return \think\response\Json
     */
    public function del() {
        $get = $this->request->get();
        if (empty($get['id'])) return __error('请选择需要删除的信息');
        //执行删除操作
        return $this->model->del($get['id']);
    }
}