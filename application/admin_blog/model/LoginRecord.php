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

namespace app\admin_blog\model;


use app\common\service\ModelService;

/**
 * 会员登录记录表
 * Class LoginRecord
 * @package app\admin_blog\model
 */
class LoginRecord extends ModelService {

    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'blog_login_record';

    /**
     * 关联会员表
     * @return \think\model\relation\HasOne
     */
    public function memberInfo() {
        return $this->hasOne("Member", "id", "member_id")->joinType('left')->field('nickname, username, head_img');
    }

    /**
     * 删除
     * @param $id
     * @return \think\response\Json
     * @throws \think\exception\PDOException
     */
    public static function del($id) {
        is_array($id) ? $del = self::whereIn('id', $id) : $del = self::where('id', $id);
        self::startTrans();
        try {
            $del = $del->delete();
            self::commit();
        } catch (\Exception $e) {
            self::rollback();
            return __error($e->getMessage());
        }
        return __success('删除成功');
    }

    /**
     * 获取会员登录记录列表
     * @param int   $page
     * @param int   $limit
     * @param array $search
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getList($page = 1, $limit = 10, $search = []) {
        list($where) = [[]];

        //搜索条件
        foreach ($search as $key => $value) {
            if (!empty($value)) {
                switch ($key) {
                    case 'username':
                        $member_id = model('member')->where([['username', 'LIKE', "%{$value}%"]])->column('id');
                        $where[] = ['member_id', 'IN', $member_id];
                        break;
                    case 'nickname':
                        $member_id = model('member')->where([['nickname', 'LIKE', "%{$value}%"]])->column('id');
                        $where[] = ['member_id', 'IN', $member_id];
                        break;
                    case 'create_at':
                        $value_list = explode(" - ", $value);
                        $where[] = [$key, 'BETWEEN', ["{$value_list[0]} 00:00:00", "{$value_list[1]} 23:59:59"]];
                        break;
                    default:
                        !empty($value) && $where[] = [$key, 'LIKE', '%' . $value . '%'];
                }
            }
        }

        $count = self::where($where)->count();
        $data = self::where($where)->page($page, $limit)->order(['create_at' => 'desc'])->select()
            ->each(function ($item, $key) {
                $memberInfo = $item->memberInfo;
                $item['username'] = $memberInfo['username'];
                $item['nickname'] = $memberInfo['nickname'];
                $item['head_img'] = $memberInfo['head_img'];
            });
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