<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/12
 * Time: 1:01
 */

namespace app\admin\model\blog;


use app\common\service\ModelService;

/**
 * 博客配置模型
 * Class Config
 * @package app\admin\model\blog
 */
class Config extends ModelService {

    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'blog_config';

    /**
     * 获取系统配置列表
     * @param int   $page
     * @param int   $limit
     * @param array $search
     * @param array $where
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getList($page = 1, $limit = 500, $search = []) {
        $where = [];

        //搜索条件
        foreach ($search as $key => $value) {
            !empty($value) && $where[] = [$key, 'LIKE', '%' . $value . '%'];
        }

        $field = 'id, group , name, value, remark, sort, create_at';
        $count = self::where($where)->count();
        $data = self::where($where)->field($field)->order(['sort asc'])->select();
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