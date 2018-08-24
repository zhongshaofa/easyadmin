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

namespace app\download\model;


use app\common\service\ModelService;

/**
 * 下载配置表
 * Class Config
 * @package app\download\model
 */
class Config extends ModelService {

    /**
     * 绑定的数据表
     * @var string
     */
    protected $table = 'download_config';

    /**
     * 获取所有的配置信息
     * @return mixed|void
     */
    public function getConfig() {
        $confg = $this->column('name,value');
        return $confg;
    }
}