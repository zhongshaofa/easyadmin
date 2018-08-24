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
 * 下载记录表
 * Class Record
 * @package app\download\model
 */
class Record extends ModelService {

    /**
     * 绑定的数据表
     * @var string
     */
    protected $table = 'download_record';

    /**
     * 获取下载总数量
     * @return float|string
     */
    public function getDownloadSum() {
        return $this->count();
    }
}