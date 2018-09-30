<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/30
 * Time: 1:16
 */

namespace app\admin\service;

use think\Db;

/**
 * 日志服务
 * Class LogService
 * @package app\admin\service
 */
class LogService {

    /**
     * 登录日志
     * @param        $user_id 系统用户编号
     * @param        $type    登录类型 （0：退出，1：登录）
     * @param bool   $status  状态（0：失败，1：成功）
     * @param string $remark
     */
    public static function loginLog($user_id, $type = 1, $status = 1, $remark = '') {
        $location_info = get_location();
        $insert = [
            'type'     => $type,
            'user_id' => $user_id,
            'ip'       => get_ip(),
            'country'  => $location_info['country'],
            'region'   => $location_info['region'],
            'city'     => $location_info['city'],
            'isp'      => $location_info['isp'],
            'location' => $location_info['country'] . $location_info['region'] . $location_info['city'] . $location_info['isp'],
            'remark'   => $remark,
            'status'   => $status,
        ];
        Db::name('SystemLoginRecord')->insert($insert);
    }

}