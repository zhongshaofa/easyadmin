<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/11
 * Time: 21:06
 */

namespace app\admin\model\blog;


use app\common\service\ModelService;

/**
 * 文章评论模型
 * Class Comment
 * @package app\admin\model\blog
 */
class Comment extends ModelService {

    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'blog_comment';

    /**
     * 关联会员表
     * @return \think\model\relation\HasOne
     */
    public function memberInfo() {
        return $this->hasOne("Member", "id", "member_id")->joinType('left');
    }

    /**
     * 关联文章类型
     * @return \think\model\relation\HasOne
     */
    public function articleInfo() {
        return $this->hasOne("Article", "id", "article_id")->joinType('left');
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
        $data = self::where($where)->page($page, $limit)->order(['create_at' => 'desc'])->select()
            ->each(function ($item, $key) {
                $memberInfo = $item->memberInfo;
                $articleInfo = $item->articleInfo;
                if ($item['member_id'] == 0) {
                    $item['username'] = 'admin';
                    $item['nickname'] = '管理员';
                    $item['head_img'] = '/static/image/blog/face_default.jpg';
                } else {
                    $item['username'] = $memberInfo['username'];
                    $item['nickname'] = $memberInfo['nickname'];
                    $item['head_img'] = $memberInfo['head_img'];
                }
                $item['article_title'] = $articleInfo['title'];
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