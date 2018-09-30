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

namespace app\admin\model\blog;


use app\common\service\ModelService;

/**
 * 文章分类模型
 * Class Category
 * @package app\admin_blog\model
 */
class Category extends ModelService {

    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'blog_category';

    public static function getCategoryList() {
        $order_category_list = [
            'sort'      => 'desc',
            'create_at' => 'asc',
        ];
        $category_list = self::field('id, title, create_at')
            ->where(['status' => 0])
            ->order($order_category_list)
            ->select();
        return $category_list;
    }

    /**
     * 获取文章分类列表
     * @param int   $page
     * @param int   $limit
     * @param array $search
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getList($page = 1, $limit = 10, $search = []) {
        $where = [];

        //搜索条件
        foreach ($search as $key => $value) {
            if (!empty($value)) {
                switch ($key) {
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
        $data = self::where($where)->page($page, $limit)->order(['create_at' => 'desc'])->select();
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