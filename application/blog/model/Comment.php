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
 * 文章评论模型
 * Class Commont
 * @package app\blog\model
 */
class Comment extends ModelService {

    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'blog_comment';

    /**
     * 关联文章表
     * @return \think\model\relation\HasOne
     */
    public function articleInfo() {
        return $this->hasOne("Article", "id", "article_id")->joinType('left');
    }

    /**
     * 关联会员表
     * @return \think\model\relation\HasOne
     */
    public function memberInfo() {
        return $this->hasOne("Member", "id", "member_id")->joinType('left')->field('nickname, username, head_img');
    }

    /**
     * 获取文章评论信息
     * @param $id 文章id
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getArticleComment($id) {
        $where_article_comment_list = [
            ['status', '=', 0],
            ['is_deleted', '=', 0],
            ['article_id', '=', $id],
        ];
        $article_comment_list = $this->field('id, article_id, member_id, content, create_at')->where($where_article_comment_list)->order('create_at', 'desc')->select()
            ->each(function ($item, $key) {
                $item->memberInfo;
            });
        return $article_comment_list;
    }

    /**
     * 添加评论
     * @param $insert
     * @return \think\response\Json
     * @throws \think\exception\PDOException
     */
    public function add($insert) {
        //使用事物保存数据
        $this->startTrans();
        $save = $this->save($insert);
        if (!$save) {
            $this->rollback();
            return __error('数据有误，请稍后再试！');
        }
        $this->commit();
        return __success('添加成功！');
    }
}