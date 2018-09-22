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

/**
 * 系统配置模板
 */
use app\common\service\ModelService;


/**
 * 系统配置信息
 * Class Config
 * @package app\admin\model
 */
class Config extends ModelService {

    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'system_config';

    /**
     * 获取系统基础配置信息
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getBasicConfig() {
        $basic = $this->where('group', 'basic')->column('name,value');
        return $basic;
    }

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
    public function configList($page = 1, $limit = 500, $search = [], $where = []) {

        //搜索条件
        foreach ($search as $key => $value) {
            !empty($value) && $where[] = [$key, 'LIKE', '%' . $value . '%'];
        }

        $field = 'id, group , name, value, remark, sort, create_at';
        $count = $this->where($where)->count();
        $data = $this->where($where)->field($field)->order(['sort asc'])->select();
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

    /**
     * 修改字段值
     * @param $update
     * @return \think\response\Json
     */
    public function edit_field($update) {
        $data = $this->where('id', $update['id'])->update([$update['field'] => $update['value']]);
        if ($data == 1) {
            return __success('修改成功！');
        } else {
            return __error('数据没有修改！');
        }
    }
}