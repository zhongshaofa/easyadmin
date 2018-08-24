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

namespace app\blog\model;


use app\common\service\ModelService;

/**
 * 博客会员表数据
 * Class Member
 * @package app\blog\model
 */
class Member extends ModelService {

    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'blog_member';

    /**
     * 获取博主信息
     * @return array|null|\PDOStatement|string|\think\Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getBlogUserInfo() {
        return $this->field('nickname, job, email, location')->order('id', 'asc')->find();
    }

    /**
     * 登录验证
     * @param $username
     * @param $password
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function login($username, $password) {
        $where_login = [
            ['username', '=', $username],
            ['is_deleted', '=', 0],
            ['status', '=', 0],
        ];
        $login = $this->where($where_login)->find();
        if (empty($login)) return ['code' => 1, 'msg' => '账户不存在，请重新输入！'];
        if ($login['password'] != password($password)) return ['code' => 1, 'msg' => '密码不正确，请重新输入！'];
        unset($login['password']);
        return ['code' => 0, 'msg' => '登录成功，正在进入系统！', 'member' => $login];
    }

    /**
     * 会员注册
     * @param $insert
     * @return \think\response\Json
     * @throws \think\exception\PDOException
     */
    public function register($insert) {
        //使用事物保存数据
        $this->startTrans();
        $save = $this->save($insert);
        if (!$save) {
            $this->rollback();
            return __error('数据有误，请稍后再试！');
        }
        $this->commit();
        return __success('会员注册成功！');
    }
}