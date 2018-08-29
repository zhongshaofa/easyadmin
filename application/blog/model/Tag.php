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
 * 文章标签
 * Class Tag
 * @package app\blog\model'
 */
class Tag extends ModelService {

    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'blog_tag';

    /**
     * 预读取文章标签
     * @return array
     */
    public function getSampleTags() {
        $tag_list = $this->where(['status' => 0])->column('tag_title');
        return $tag_list;
    }

    /**
     * 标签使用排行榜
     * @param int $limit
     */
    public function getTagRanking($limit = 10) {
        $tag_id_list = model('ArticleTag')->distinct(true)->field('tag_id')->order()->select();
    }

    /**
     * 获取标签列表数据
     * @param int $limit
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getTagList($limit = 10) {
        return $this->field('id,tag_title')->where(['status' => 0])->order(['create_at' => 'desc'])->select();
    }
}