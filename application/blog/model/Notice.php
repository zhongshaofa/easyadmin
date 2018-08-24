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
 * 博客公告模型
 * Class Notice
 * @package app\blog\model
 */
class Notice extends ModelService {

    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'blog_notice';

    /**
     * 获取博客公告列表
     */
    public function getNoticeList() {
        $where_notice_list = [['status', '=', 0]];
        $notice_list = $this->where($where_notice_list)->field('id, title, content, href, target')->order('sort', 'asc')->select();
        return $notice_list;
    }
}