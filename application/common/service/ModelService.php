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

    /**
     * 修改字段值
     * @param $update
     * @return \think\response\Json
     */
    public static function editField($update) {
        $data = self::where('id', $update['id'])->update([$update['field'] => $update['value']]);
        if ($data == 1) {
            return __success('修改成功！');
        } else {
            return __error('数据没有修改！');
        }
    }

    /**
     * 新增
     * @param $post
     * @return \think\response\Json
     * @throws \think\exception\PDOException
     */
    public static function addData($post) {
        self::startTrans();
        try {
            self::insert($post);
            self::commit();
        } catch (\Exception $e) {
            self::rollback();
            return __error($e->getMessage());
        }
        return __success('添加成功');
    }

    /**
     * 修改
     * @param $post
     * @return \think\response\Json
     */
    public static function editData($post) {
        self::startTrans();
        try {
            self::where('id', $post['id'])->update($post);
            self::commit();
        } catch (\Exception $e) {
            self::rollback();
            return __error($e->getMessage());
        }
        return __success('修改成功');
    }

    /**
     * 软删除操作
     * @param      $id   列ID
     * @param bool $type 删除类型 （false:软删除，true:真实删除）
     * @return bool|ModelService
     * @throws \Exception
     */
    public function delData($id, $type = false) {
        is_array($id) ? $model = self::whereIn('id', $id) : $model = self::where('id', $id);
        if ($type) {
            $del = $model->delete();
        } else {
            $del = $model->update(['is_deleted' => 1]);
        }
        if ($del >= 1) return __success('删除成功');
        return __error('删除失败，请检查！');
    }
}