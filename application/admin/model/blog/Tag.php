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
 * 标签模型
 * Class Tag
 * @package app\admin_blog\model
 */
class Tag extends ModelService {

    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'blog_tag';

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
     * 预读取文章标签
     * @return array
     */
    public static function getSampleTags() {
        $tag_list = self::where(['status' => 0])->column('tag_title');
        return $tag_list;
    }

    /**
     * 获取列表数据
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
        $data = self::where($where)->page($page, $limit)->order(['create_at' => 'desc'])->select()->each(function ($item, $key) {
            $item['use_total'] = model('blog.ArticleTag')->where(['tag_id' => $item['id']])->count();
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