<?php

/// +----------------------------------------------------------------------
// | 99PHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018~2020 https://www.99php.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Mr.Chung <chung@99php.cn >
// +----------------------------------------------------------------------

namespace app\common\service;


/**
 * 访问权限控制
 * Class AuthService
 * @package app\common\service
 */
class AuthService {

    /**
     * 判断是否有权限访问该节点
     * @param $node 节点
     * @return bool （true：有权限，false：无权限）
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function checkNode($node = '') {
        //如果没有传参，默认获取当前位置    模块/控制器/方法 （小写）
        if (empty($node)) $node = self::getNode();

        //判断当前登录是否为超级管理员
        if (session('user.id') == 1) return true;

        //判断是否加入RABC控制
        $is_auth = model('SysNode')->where(['node' => $node, 'is_auth' => 1])->find();
        if (empty($is_auth)) return true;

        //获取当前用户角色组信息 ,拆表
//        $auth_id_list = json_decode(session('user.auth_id'), true);
        $user = new \app\admin\model\User;
        $auth_id_list = json_decode($user->where(['id' => session('user.id'), 'status' => 1, 'is_deleted' => 0])->value('auth_id'), true);
        //去除失效的角色组信息
        foreach ($auth_id_list as $k => $val) {
            if (empty(model('SysAuth')->where(['id' => $val, 'status' => 1])->find())) unset($auth_id_list[$k]);
        }

        //判断是否有权限访问
        foreach ($auth_id_list as $vo) {
            if ($vo == 0) return true; //超级管理员组权限
            $is_auth_node = model('SysAuthNode')->where(['auth' => $vo, 'node' => $is_auth['id']])->find();
            if (!empty($is_auth_node)) return true;
        }
        return false;
    }

    /**
     * 获取当前节点
     * @return string 节点信息
     */
    public static function getNode() {
        $node = app('request')->module() . '/' . app('request')->controller() . '/' . app('request')->action();
        return self::parseNodeStr($node);
    }

    /**
     * 驼峰转下划线规则
     * @param string $node
     * @return string
     */
    public static function parseNodeStr($node) {
        $tmp = [];
        foreach (explode('/', $node) as $name) {
            $tmp[] = strtolower(trim(preg_replace("/[A-Z]/", "_\\0", $name), "_"));
        }
        return str_replace('._', '.', trim(join('/', $tmp), '/'));
    }
}