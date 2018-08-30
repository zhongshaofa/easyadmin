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
 * 会员模型
 * Class BlogMember
 * @package app\admin\model
 */
class BlogMember extends ModelService {

    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'blog_member';
}