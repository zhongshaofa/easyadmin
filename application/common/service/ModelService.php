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

namespace app\common\service;


use think\Model;

/**
 * 模型基础数据服务
 * Class ModelService
 * @package service
 */
class ModelService extends Model {

    /**
     * 主键定义
     * @var string
     */
    protected $pk = 'id';

    /**
     * 软删除操作
     * @param      $id   列ID
     * @param bool $type 删除类型 （false:软删除，true:真实删除）
     * @return bool|ModelService
     * @throws \Exception
     */
//    public  function del($id, $type = false) {
//        is_array($id) ? $del = whereIn('id', $id) : $del = where('id', $id);
//        if ($type) {
//            $del = $del->delete();
//        } else {
//            $del = $del->update(['is_deleted' => 1]);
//        }
//        if ($del >= 1) return __success('删除成功');
//        return __error('删除失败，请检查！');
//    }

    /**
     * 格式化分页
     * @param array $query 分页参数 ['word' => $word]
     */
    public function formatQuery($query = []) {
        $format_query = [
            'query' => [],
        ];
        foreach ($query as $k => $val) {
            $format_query['query'] = [$k, $val];
        }
        return $format_query;
    }
}