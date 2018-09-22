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

namespace app\admin\controller;


use app\common\service\CurlService;
use think\Db;
use think\Controller;
use think\facade\Env;
use think\facade\Cache;

class Test extends Controller {


    /**
     * 测试
     */
    public function index() {
        return $this->fetch();
    }

    public function test() {
        $redis = Cache::handler();
        while (true) {
            try {
                $value = $redis->LPOP('click');
                if (!$value) {
                    break;
                }
                echo $value . '<br>';
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
    }

    public function url() {
        redirect('install/index/index');
        exit;
    }

    public function curl() {
        $test = curl()->Get('http://www.99php.cn');
        dump($test);
    }


    public function add() {
        $insert = [
            'username' => 'admin',
            'password' => password('bsafe2016'),
            'id'       => '1',
            'auth_id'  => '[]',
            'status'   => 1,
        ];

        Db::startTrans();
        try {
            Db::table('system_user')->insert($insert);
            Db::commit();
        } catch (\Exception $e) {
            Db::rollback();
            $this->error($e->getMessage());
        }

    }

    /**
     * 生成数据库配置文件
     * @return array
     */
    private function mkDatabase($data = []) {
        $code = <<<INFO
<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
return [
    // 数据库类型
    'type'            => 'mysql',
    // 服务器地址
    'hostname'        => '{$data['hostname']}',
    // 数据库名
    'database'        => '{$data['database']}',
    // 用户名
    'username'        => '{$data['username']}',
    // 密码
    'password'        => '{$data['password']}',
    // 端口
    'hostport'        => '{$data['hostport']}',
    // 连接dsn
    'dsn'             => '',
    // 数据库连接参数
    'params'          => [],
    // 数据库编码默认采用utf8
    'charset'         => 'utf8',
    // 数据库表前缀
    'prefix'          => '{$data['prefix']}',
    // 数据库调试模式
    'debug'           => false,
    // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
    'deploy'          => 0,
    // 数据库读写是否分离 主从式有效
    'rw_separate'     => false,
    // 读写分离后 主服务器数量
    'master_num'      => 1,
    // 指定从服务器序号
    'slave_no'        => '',
    // 是否严格检查字段是否存在
    'fields_strict'   => false,
    // 数据集返回类型
    'resultset_type'  => 'array',
    // 自动写入时间戳字段
    'auto_timestamp'  => false,
    // 时间字段取出后的默认时间格式
    'datetime_format' => 'Y-m-d H:i:s',
    // 是否需要进行SQL性能分析
    'sql_explain'     => false,
    // Builder类
    'builder'         => '',
    // Query类
    'query'           => '\\think\\db\\Query',
];
INFO;
        file_put_contents(Env::get('config_path') . 'database1.php', $code);
        // 判断写入是否成功
        $config = include Env::get('config_path') . 'database1.php';
        if (empty($config['database']) || $config['database'] != $data['database']) {
            return $this->error('[application/database.php]数据库配置写入失败！');
            exit;
        }
    }
}