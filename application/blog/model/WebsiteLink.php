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

class WebsiteLink extends ModelService {

    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'blog_website_link';

    /**
     * 获取所有友联数据
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getAllList() {
        $order = ['sort' => 'desc', 'create_at' => 'asc'];
        $list = $this->field('id,website_name,website_logo,href')->where(['status' => 0])->order($order)->select();
        return $list;
    }

}