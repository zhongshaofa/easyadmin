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

namespace app\admin\model;


use app\common\service\ModelService;

class Nav extends ModelService {

    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'system_nav';

    /**
     * 获取快捷导航
     * @param int $limit
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getQuickNav($limit = 6) {
        $list = self::where(['status' => 1])->order(['sort' => 'desc', 'create_at' => 'desc'])
            ->limit($limit)->select()->each(function ($item, $key) {
                $item['href'] = url($item['href']);
            });
        return $list;
    }

}