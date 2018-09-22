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

namespace app\blog\controller;


use app\common\controller\BlogController;

/**
 * 会员管理
 * Class Member
 * @package app\blog\controller
 */
class Member extends BlogController {

    /**
     * 模型对象
     */
    protected $model = null;

    /**
     * 开启登录控制
     * @var bool
     */
    protected $is_login = true;

    /**
     * 初始化
     * Member constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->model = model('Member');
    }

    /**
     * 会员中心
     * @return mixed
     */
    public function index() {
        $this->redirect(url('@blog/member/article'));
        $this->init_top();
        $basic_data = [
            'title'   => '个人中心',
            'nav_top' => 'index',
        ];
        return $this->fetch('', $basic_data);
    }

    /**
     * 文章管理
     */
    public function article() {
        $this->init_top();
        $basic_data = [
            'title'        => '文章管理',
            'nav_top'      => 'article',
            'article_list' => model('Article')->getMemberArticleList($this->member['id']),
        ];
        return $this->fetch('', $basic_data);
    }

    /**
     * 我的评论管理
     */
    public function comment() {
        $this->init_top();
        $basic_data = [
            'title'        => '评论管理',
            'nav_top'      => 'comment',
            'comment_list' => model('Comment')->getMemberComment($this->member['id']),
        ];
        return $this->fetch('', $basic_data);
    }

    /**
     * 别人评论我
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function comment_other() {
        $this->init_top();
        $basic_data = [
            'title'   => '评论管理',
            'nav_top' => 'comment',
        ];
        return $this->fetch('', $basic_data);
    }

    /**
     * 我的关注
     * @return mixed
     */
    public function follow() {
        $this->init_top();
        $basic_data = [
            'title'   => '我的关注',
            'nav_top' => 'follow',
        ];
        return $this->fetch('', $basic_data);
    }

    /**
     * 我的粉丝
     * @return mixed
     */
    public function fans() {
        $this->init_top();
        $basic_data = [
            'title'   => '我的粉丝',
            'nav_top' => 'follow',
        ];
        return $this->fetch('', $basic_data);
    }

    /**
     * 删除文章
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function article_del() {
        $article_id = $this->request->get('article_id', '');
        if (empty($article_id)) return __error('文章编号不能为空！');
        $where = ['id' => $article_id, 'member_id' => $this->member['id'], 'status' => 0, 'is_deleted' => 0];
        $article = model('Article')->where($where)->find();
        if (empty($article)) return __error('文章不存在，请刷新重试！');
        model('Article')->where($where)->update(['is_deleted' => 1]);
        return __success('文章删除成功！');
    }

    /**
     * 修改文章
     * @return mixed|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function article_edit() {
        if (!$this->request->isPost()) {
            $article_id = $this->request->get('article_id', '');
            if (empty($article_id)) return msg_error('文章编号不能为空！');
            $where = ['id' => $article_id, 'member_id' => $this->member['id'], 'status' => 0, 'is_deleted' => 0];
            $article = model('Article')->where($where)->find();
            if (empty($article)) return msg_error('文章不存在，请刷新重试！');
            $tag = model('ArticleTag')->where(['article_id' => $article_id])->distinct(true)->field('tag_id')->select();
            $tag_title = '';
            foreach ($tag as $vo) {
                $tag_title = $tag_title . ',' . model('Tag')->where(['id' => $vo['tag_id']])->value('tag_title');
            }
            $basic_data = [
                'title'          => '修改文章',
                'recommend_list' => model('Article')->getRecommendList(),
                'category_list'  => model('Category')->getCategoryList(),
                'sample_tags'    => model('Tag')->getSampleTags(),
                'article'        => $article,
                'tag_title'      => $tag_title,
            ];
            return $this->fetch('article_form', $basic_data);
        } else {
            $post = $this->request->post();
            $where = ['id' => $post['article_id'], 'member_id' => $this->member['id'], 'status' => 0, 'is_deleted' => 0];
            $article = model('Article')->where($where)->find();
            if (empty($article)) return msg_error('文章不存在，请刷新重试！');
            //验证数据
            $validate = $this->validate($post, 'app\blog\validate\Article.edit');
            if (true !== $validate) return __error($validate);

            //保存数据,返回结果
            return model('Article')->edit($post);
        }
    }

    /**
     * 删除评论
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function comment_del() {
        $id = $this->request->get('id', '');
        if (empty($id)) return __error('评论编号不能为空！');
        $where = ['id' => $id, 'member_id' => $this->member['id'], 'status' => 0, 'is_deleted' => 0];
        $comment = model('Comment')->where($where)->find();
        if (empty($comment)) return __error('评论不存在，请刷新重试！');
        model('Comment')->where($where)->update(['is_deleted' => 1]);
        return __success('评论删除成功！');
    }

    /**
     * 初始化顶部信息
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected function init_top() {
        if (empty($this->member)) return false;
        $member_follow = model('MemberFollow')->where(['member_id' => $this->member['id']])->find();
        if (empty($member_follow)) {
            model('MemberFollow')->save(['member_id' => $this->member['id']]);
            $member_follow = [
                'member_id'  => $this->member['id'],
                'follow_num' => 0,
                'fans_num'   => 0,
            ];
        }
        $where = [
            'member_id'  => $this->member['id'],
            'status'     => 0,
            'is_deleted' => 0,
            'is_open'    => 1,
        ];
        $this->assign([
            'member_follow' => $member_follow,
            'article_num'   => model('Article')->where($where)->count(),
            'click_num'     => model('Article')->where($where)->sum('clicks'),
            'praise_num'    => model('Article')->where($where)->sum('praise'),
        ]);
    }
}