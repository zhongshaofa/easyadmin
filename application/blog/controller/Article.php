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
use app\blog\service\ArticleService;


/**
 * 博客文章控制器
 * Class Artitle
 * @package app\blog\controller
 */
class Article extends BlogController {

    /**
     * 开启登录控制
     * @var bool
     */
    protected $is_login = false;

    /**
     * 模型对象
     */
    protected $model = null;

    /**
     * 初始化
     * User constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->model = model('Article');
        $this->is_qiniu = true;
    }

    /**
     * 技术教程
     * @return mixed
     */
    public function index($category_id = '') {
        if (empty($category_id)) {
            $current_category = model('Category')->getCategoryTop();
        } else {
            $current_category = model('Category')->where(['id' => $category_id, 'status' => 0])->find();
        }
        $basic_data = [
            'title'            => '技术教程',
            'navMenu'          => ['技术教程', $current_category['title']],
            'current_cotegory' => $current_category,
            'article_list'     => model('Article')->getArticleCategoryList($current_category['id']),
            'recommend_list'   => model('Article')->getRecommendList(),
            'category_list'    => model('Category')->getCategoryList(),
        ];
        return $this->fetch('', $basic_data);
    }

    /**
     * 发布文章
     * @return mixed
     */
    public function add() {
        if (!$this->request->isPost()) {
            if (empty(session('member'))) return msg_error('请先登录系统，再进行操作！', url('@blog/login'));
            $basic_data = [
                'title'          => '发布文章',
                'navMenu'        => ['技术教程', '发布文章'],
                'recommend_list' => model('Article')->getRecommendList(),
                'category_list'  => model('Category')->getCategoryList(),
                'sample_tags'    => model('Tag')->getSampleTags(),
            ];
            return $this->fetch('form', $basic_data);
        } else {
            $post = $this->request->post();

            //验证数据
            $validate = $this->validate($post, 'app\blog\validate\Article.add');
            if (true !== $validate) return __error($validate);

            //保存数据,返回结果
            return $this->model->add($post);
        }
    }

    /**
     * 文章详情
     */
    public function details() {
        if (!$this->request->isPost()) {
            $id = $this->request->param('id');
            //获取文章信息
            if (empty($id)) return msg_error('暂无文章信息，请稍后再试');
            $details = $this->model->where(['status' => 0, 'is_deleted' => 0, 'id' => $id])->find();
            if (empty($details)) return msg_error('暂无文章信息，请稍后再试');
            if ($details['member_id'] == 0) {
                $details['nickname'] = '管理员';
            } else {
                $details['nickname'] = $details->memberInfo->nickname;
            }

            //新增文章点击量
            $this->model->where(['id' => $id])->setInc('clicks', 1);

            $basic_data = [
                'title'                => $details['title'],
                'author'               => $details['nickname'],
                'keywords'             => $details['title'],
                'description'          => $details['describe'],
                'navMenu'              => ['文章', $details['title']],
                'details'              => $details,
                'last_article'         => $this->model->getLastArticle($id),
                'next_article'         => $this->model->getNextArticle($id),
                'tag_list'             => model('ArticleTag')->getArticleTagList($id),
                'article_comment_list' => model('Comment')->getArticleComment($id),
                'recommend_list'       => model('Article')->getRecommendList(),
                'relevant_list'        => ArticleService::getRelevantArticle($id),
            ];
            return $this->fetch('', $basic_data);
        }
    }

    /**
     * 新增文章评论
     */
    public function add_comment() {
        if ($this->request->isPost()) {
            $post = $this->request->post();
            $validate = $this->validate($post, 'app\blog\validate\Article.add_comment');
            if (true !== $validate) return __error($validate);
            return model('Comment')->add($post);
        }
    }
}