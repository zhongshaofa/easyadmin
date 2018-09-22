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
 * 登录日志表
 * Class LoginRecord
 * @package app\blog\model
 */
class LoginRecord extends ModelService {

    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'blog_login_record';

    /**
     * 获取个人登录记录
     * @param     $member_id
     * @param int $page
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getMemberList($member_id, $page = 15) {
        $list = $this->where(['member_id' => $member_id])->order('create_at', 'desc')->paginate($page, false, ['query' => ['member_id' => $member_id]]);
        return $list;
    }

    /**
     * 获取上次登录时间
     * @param $member_id
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getLastTime($member_id) {
        $record = $this->where(['member_id' => $member_id, 'type' => 1])->order(['create_at' => 'desc'])->limit(2)->select();
        if (isset($record[1])) return $record[1]['create_at'];
        return '';
    }
}