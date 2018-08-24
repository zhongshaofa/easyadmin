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
 * 轮播图模型
 * Class Slider
 * @package app\blog\model
 */
class Slider extends ModelService {

    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'blog_slider';

    /**
     * 获取轮播图列表
     */
    public function getSliderList() {
        $where_slider_list = [['status', '=', 0]];
        $slider_list = $this->where($where_slider_list)->field('id, title, image, href, target')->order('sort', 'asc')->select();
        return $slider_list;
    }
}