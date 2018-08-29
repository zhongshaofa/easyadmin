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

namespace app\blog\model;


use app\common\service\ModelService;

/**
 * 文章标签模型
 * Class ArticleTag
 * @package app\blog\model
 */
class ArticleTag extends ModelService {

    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'blog_article_tag';

    /**
     * 关联标签模型
     * @return \think\model\relation\HasOne
     */
    public function tagInfo() {
        return $this->hasOne("Tag", "id", "tag_id")->joinType('left')->field('tag_title, remark');
    }

    /**
     * 获取文章所有标签
     * @param $id 文章编号
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getArticleTagList($id) {
        $article_tag_list = $this->where('article_id', $id)->select()
            ->each(function ($item, $key) {
                $item->tagInfo;
            });
        return $article_tag_list;
    }
}