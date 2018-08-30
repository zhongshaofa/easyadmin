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

namespace app\blog\model;


use app\common\service\ModelService;

/**
 * 搜索统计表
 * Class Search
 * @package app\blog\model
 */
class Search extends ModelService {

    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'blog_search';

    /**
     * 统计搜索关键词
     * @param $word
     */
    public function saveSearch($word) {
        $search = $this->where(['word' => $word])->find();
        if (!empty($search)) {
            $this->where(['id' => $search['id']])
                ->update([
                    'total'     => $search['total'] + 1,
                    'update_at' => get_time(),
                ]);
        } else {
            $this->save(['word' => $word, 'total' => 1]);
        }
    }

    /**
     * 获取搜索关键词排行榜
     * @param int $limit
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getRank($limit = 5) {
        return $this->limit($limit)->order(['total' => 'desc'])->select();
    }
}