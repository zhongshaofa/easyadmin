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

namespace app\blog\service;

use think\Db;

/**
 * 文章基础服务类
 * Class Article
 * @package app\blog\service
 */
class ArticleService {

    /**
     * 相关帖子算法
     * @param     $article_id 文章ID
     * @param int $limit      相关帖子条数（默认：9）
     * @return array|mixed|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getRelevantArticle($article_id, $limit = 9) {
        //初始化
        list($articleList, $whereTagIn, $whereArticleIn, $whereArticleCateNotIn, $whereArticleNotIn, $order) = [
            [], [], [], [], [],
            ['clicks' => 'desc', 'recommend' => 'desc', 'praise' => 'desc', 'sort' => 'desc', 'create_at' => 'desc'],
        ];

        /**
         * 1、根据文章标签查找计算相关帖子
         */
        $tagList = Db::name('BlogArticleTag')->where(['article_id' => $article_id])->distinct(true)->field('tag_id')->select();
        if (!empty($tagList)) {
            foreach ($tagList as $vo) $whereTagIn[] = $vo['tag_id'];

            $articleIdTagList = Db::name('BlogArticleTag')->whereIn('tag_id', $whereTagIn)->distinct(true)->field('article_id')->select();

            foreach ($articleIdTagList as $vo) $whereArticleIn[] = $vo['article_id'];

            $articleList = Db::name('BlogArticle')->field('id,title')->whereNotIn('id', $article_id)->whereIn('id', $whereArticleIn)
                ->where(['status' => 0, 'is_deleted' => 0])->order($order)->limit($limit)->select();
        }

        /**
         * 2、如果根据标签查找出的文章数量不够限制数据，将根据该文章分类下的所有文章的点击量、评论量、点赞量、更新时间的查找出对应的帖子进行补充
         */
        if (count($articleList) <= $limit) {
            foreach ($articleList as $vo) $whereArticleCateNotIn[] = $vo['id'];
            $whereArticleCateNotIn = $article_id;
            $category_id = Db::name('BlogArticle')->where(['id' => $article_id])->value('category_id');

            $articleOtherList = Db::name('BlogArticle')->field('id,title')->whereNotIn('id', $whereArticleCateNotIn)
                ->where(['status' => 0, 'is_deleted' => 0, 'category_id' => $category_id,])->order($order)->limit($limit)->select();

            foreach ($articleOtherList as $vo) {
                if (count($articleList) >= $limit) break;
                $articleList[] = $vo;
            }
        }

        /**
         * 3、如果根据标签查找出的文章数量不够限制数据，将根据全部分类文章的点击量、评论量、点赞量、更新时间的查找出对应的帖子进行补充
         */
        if (count($articleList) <= $limit) {
            foreach ($articleList as $vo) $whereArticleNotIn[] = $vo['id'];
            $whereArticleNotIn = $article_id;

            $articleOtherList = Db::name('BlogArticle')->field('id,title')->whereNotIn('id', $whereArticleNotIn)->where(['status' => 0, 'is_deleted' => 0])
                ->order($order)->limit($limit)->select();

            foreach ($articleOtherList as $vo) {
                if (count($articleList) >= $limit) break;
                $articleList[] = $vo;
            }
        }

        //返回结果
        return $articleList;
    }
}