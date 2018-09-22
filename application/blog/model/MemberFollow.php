<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/2
 * Time: 21:06
 */

namespace app\blog\model;


use app\common\service\ModelService;

/**
 * 粉丝关注统计模型
 * Class MemberFollow
 * @package app\blog\model
 */
class MemberFollow extends ModelService {

    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'blog_member_follow';

}