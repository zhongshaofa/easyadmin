<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/23
 * Time: 2:21
 */

namespace app\admin_blog\model;


use app\common\service\ModelService;

/**
 * 会员模型
 * Class Member
 * @package app\admin_blog\model
 */
class Member extends ModelService {

    /**
     * 绑定的数据表
     * @var string
     */
    protected $table = 'blog_member';

    /**
     * 获取会员信息列表
     * @param int   $page
     * @param int   $limit
     * @param array $search
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getMemberList($page = 1, $limit = 10, $search = []) {
        $where = [['is_deleted', '=', 0]];

        //搜索条件
        foreach ($search as $key => $value) {
            if ($key == 'status' && $value != '') {
                $where[] = [$key, '=', $value];
            } elseif ($key == 'create_at' && $value != '') {
                $value_list = explode(" - ", $value);
                $where[] = [$key, 'BETWEEN', ["{$value_list[0]} 00:00:00", "{$value_list[1]} 23:59:59"]];
            } else {
                !empty($value) && $where[] = [$key, 'LIKE', '%' . $value . '%'];
            }
        }

        $field = 'id, openid, nickname, username, head_img, phone, email, sex, sign, province, city, location, remark, source, status, create_at';
        $count = self::where($where)->count();
        $data = self::where($where)->field($field)->page($page, $limit)->select();
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