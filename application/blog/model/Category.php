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
 * 文章分类模型
 * Class Nav
 * @package app\blog\model
 */
class Category extends ModelService {

    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'blog_category';

    /**
     * 获取文章分类信息
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getCategoryList() {
        $order_category_list = [
            'sort'      => 'desc',
            'create_at' => 'asc',
        ];
        $category_list[] = ['id' => 0, 'title' => '全部分类', 'create_at' => ''];
        $list = $this->field('id, title, create_at')
            ->where(['status' => 0])
            ->order($order_category_list)
            ->select()->toArray();
        foreach ($list as $vo) {
            $category_list[] = $vo;
        }
        return $category_list;
    }

    /**
     * 获取顶级文章分类信息
     * @return mixed
     */
    public function getCategoryTop() {
        $order_category_top = [
            'sort'      => 'desc',
            'create_at' => 'asc',
        ];
        $category_top = $this->field('id, title, create_at')
            ->where(['status' => 0])
            ->order($order_category_top)
            ->find();
        return $category_top;
    }
}