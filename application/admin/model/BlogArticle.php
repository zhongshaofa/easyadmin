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

namespace app\admin\model;


use app\common\service\ModelService;

/**
 * 博客文章管理
 * Class BlogArticle
 * @package app\admin\model
 */
class BlogArticle extends ModelService {

    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'blog_article';

    public function getList($page = 1, $limit = 10, $select = [], $where = []) {

        //搜索条件
        foreach ($select as $key => $value) {
            if ($key == 'status' && $value != '') {
                $where[] = [$key, '=', $value];
            } elseif ($key == 'create_at' && $value != '') {
                $value_list = explode(" - ", $value);
                $where[] = [$key, 'BETWEEN', ["{$value_list[0]} 00:00:00", "{$value_list[1]} 23:59:59"]];
            } else {
                !empty($value) && $where[] = [$key, 'LIKE', '%' . $value . '%'];
            }
        }

        $count = $this->where($where)->count();
        $data = $this->where($where)->page($page, $limit)->order(['create_at' => 'desc'])->select()->each(function ($item, $key) {
            $item['nickname'] = model('BlogMember')->where(['id' => $item['member_id']])->value('nickname');
        });
        empty($data) ? $msg = '暂无数据！' : $msg = '查询成功！';
        $info = [
            'limit'        => $limit,
            'page_current' => $page,
            'page_sum'     => ceil($count / $limit),
        ];
        $list = [
            'code'  => 0,
            'msg'   => $msg,
            'count' => $count,
            'info'  => $info,
            'data'  => $data,
        ];
        return $list;
    }
}