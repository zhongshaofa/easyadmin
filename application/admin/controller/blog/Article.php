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

class Article extends AdminController {

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
        $this->model = new \app\admin\model\blog\Article();
    }

    /**
     * 文章列表
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
            'title' => '文章列表',
            'data'  => '',
        ];
        return $this->fetch('', $basic_data);
    }

    /**
     * 新增文章
     * @return mixed
     */
    public function add() {
        if (!$this->request->isPost()) {
            $basic_data = [
                'title'         => '发布文章',
                'category_list' => \app\admin\model\blog\Category::getCategoryList(),
                'sample_tags'   => \app\admin\model\blog\Tag::getSampleTags(),
            ];
            return $this->fetch('form', $basic_data);
        }
    }

    /**
     * 编辑文章
     * @return mixed|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function edit() {
        if (!$this->request->isPost()) {
            list($get, $tag_title) = [$this->request->get(), ''];
            if (empty($get['id'])) return msg_error('文章编号不能为空！');
            $where = ['id' => $get['id'], 'status' => 0, 'is_deleted' => 0];
            $article = $this->model->where($where)->find();
            if (empty($article)) return msg_error('文章不存在，请刷新重试！');
            $tag = \app\admin_blog\model\ArticleTag::where(['article_id' => $get['id']])->distinct(true)->field('tag_id')->select();
            foreach ($tag as $vo) {
                $tag_title = $tag_title . ',' . model('Tag')->where(['id' => $vo['tag_id']])->value('tag_title');
            }
            $basic_data = [
                'title'         => '修改文章',
                'category_list' => \app\admin\model\blog\Category::getCategoryList(),
                'sample_tags'   => \app\admin\model\blog\Tag::getSampleTags(),
                'article'       => $article,
                'tag_title'     => $tag_title,
            ];
            return $this->fetch('form', $basic_data);
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

    /**
     * 更改状态
     * @return \think\response\Json
     */
    public function status() {
        $get = $this->request->get();

        //验证数据
        $validate = $this->validate($get, 'app\admin_blog\validate\Member.status');
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