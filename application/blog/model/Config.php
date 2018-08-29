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
 * 博客配置模型
 * Class Config
 * @package app\blog\model
 */
class Config extends ModelService {

    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'blog_config';

    /**
     * 获取博客配置信息
     * @return array
     */
    public function getBlogConfig() {
        $config = $this->where('group', 'blog')->column('name,value');
        return $config;
    }
}