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

namespace app\blog\validate;


use think\Validate;

/**
 * 文章验证器
 * Class Artitle
 * @package app\blog\validate
 */
class Article extends Validate {

    /**
     * 验证规则
     * @var array
     */
    protected $rule = [
        'article_id'  => 'require|number|checkArticleId',
        'member_id'   => 'require|number|checkMemberId',
        'tag_list'    => 'require',
        'content'     => 'require',
        'title'       => 'require|max:50',
        'category_id' => 'require|number',
        'cover_img'   => 'require|max:250',
        'describe'    => 'max:250',
    ];

    /**
     * 错误提示
     * @var array
     */
    protected $message = [
        'article_id.require'  => '文章编号必须',
        'article_id.number'   => '文章编号应该为数字',
        'member_id.require'   => '请先登录后再进行操作',
        'member_id.number'    => '人员编号应该为数字',
        'content.require'     => '评论内容必须',
        'tag_list.require'    => '文章标签必须',
        'content.max'         => '评论内容最多不能超过20000个字符',
        'title.require'       => '文章标题必须',
        'title.max'           => '文章标题最多不能超过250个字符',
        'category_id.require' => '文章分类必须',
        'category_id.number'  => '文章分类必须为数字',
        'cover_img.require'   => '文章LOGO必须',
        'cover_img.max'       => '文章LOGO最多不能超过250个字符',
        'describe.max'        => '文章描述最多不能超过250个字符',
    ];

    /**
     * 应用场景
     * @var array
     */
    protected $scene = [
        'add_comment' => ['article_id', 'member_id', 'content'],
    ];

    /**
     * 新增文章
     * @return Article
     */
    public function sceneAdd() {
        return $this->only(['member_id', 'title', 'tag_list', 'category_id', 'cover_img', 'describe', 'content'])
            ->append('content', 'max:20000');
    }

    /**
     * 检测文章是否存在
     * @param       $value
     * @param       $rule
     * @param array $data
     * @return bool|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected function checkArticleId($value, $rule, $data = []) {
        $where = [
            ['id', '=', $value],
            ['status', '=', 0],
            ['is_deleted', '=', 0],
        ];
        $article = \app\blog\model\Article::where($where)->find();
        if (empty($article)) return '暂无此文章！';
        return true;
    }

    /**
     * 检测人员是否存在
     * @param       $value
     * @param       $rule
     * @param array $data
     * @return bool|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    protected function checkMemberId($value, $rule, $data = []) {
        $where = [
            ['id', '=', $value],
            ['status', '=', 0],
            ['is_deleted', '=', 0],
        ];
        $member = \app\blog\model\Member::where($where)->find();
        if (empty($member)) return '暂无此人员！';
        return true;
    }

    /**
     * 检测内容
     * @param       $value
     * @param       $rule
     * @param array $data
     * @return bool|string
     */
    public function checkContent($value, $rule, $data = []) {
        if (empty($value) || $value = '<p><br></p>') return '内容不能为空！';
        return true;
    }
}