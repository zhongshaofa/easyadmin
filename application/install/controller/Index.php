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

namespace app\install\controller;

use think\Controller;
use think\Db;
use think\facade\Env;

/**
 * 程序安装页面
 * Class Index
 * @package app\install\controller
 */
class Index extends Controller
{

    /**
     * 安装引导页面
     * @param int $step
     * @return mixed|void
     */
    public function index($step = 0)
    {

        switch ($step) {
            case 2:
                session('install_error', false);
                return self::step2();
                break;
            case 3:
                if (session('install_error')) {
                    return $this->error('环境检测未通过，不能进行下一步操作！');
                }
                return self::step3();
                break;
            case 4:
                if (session('install_error')) {
                    return $this->error('环境检测未通过，不能进行下一步操作！');
                }
                return self::step4();
                break;
            case 5:
                if (session('install_error')) {
                    return $this->error('初始失败！');
                }
                return self::step5();
                break;

            default:
                session('install_error', false);
                return $this->fetch('install@/index/index');
                break;
        }
    }

    /**
     * 第二步：环境检测
     * @return mixed
     */
    private function step2()
    {
        $data = [];
        $data['env'] = self::checkNnv();
        $data['dir'] = self::checkDir();
        $data['func'] = self::checkFunc();
        $this->assign('data', $data);
        return $this->fetch('install@index/step2');
    }

    /**
     * 第三步：初始化配置
     * @return mixed
     */
    private function step3()
    {
        $install_dir = $_SERVER["SCRIPT_NAME"];
        $install_dir = install_substring($install_dir, strripos($install_dir, "/") + 1);
        $this->assign('install_dir', $install_dir);
        return $this->fetch('install@index/step3');
    }

    /**
     * 第四步：执行安装
     * @return mixed
     */
    private function step4()
    {
        if ($this->request->isPost()) {
            if (!is_writable(Env::get('config_path') . 'database.php')) {
                return $this->error('[app/database.php]无读写权限！');
            }
            $data = input('post.');
            $data['type'] = 'mysql';
            $rule = [
                'hostname|服务器地址' => 'require',
                'hostport|数据库端口' => 'require|number',
                'database|数据库名称' => 'require',
                'username|数据库账号' => 'require',
                'cover|覆盖数据库'    => 'require|in:0,1',
            ];
            $validate = $this->validate($data, $rule);
            if (true !== $validate) {
                return $this->error($validate);
            }
            $cover = $data['cover'];
            unset($data['cover']);
            $config = include Env::get('config_path') . 'database.php';
            foreach ($data as $k => $v) {
                if (array_key_exists($k, $config) === false) {
                    return $this->error('参数' . $k . '不存在！');
                }
            }
            // 不存在的数据库会导致连接失败
            $database = $data['database'];
            unset($data['database']);
            // 创建数据库连接
            $db_connect = Db::connect($data);
            // 检测数据库连接
            try {
                $db_connect->execute('select version()');
            } catch (\Exception $e) {
                return $this->error('数据库连接失败，请检查数据库配置！');
            }

            // 生成数据库配置文件
            $data['database'] = $database;
            self::mkDatabase($data);


            // 不覆盖检测是否已存在数据库
            if (!$cover) {
                $check = $db_connect->execute('SELECT * FROM information_schema.schemata WHERE schema_name="' . $database . '"');
                if ($check) {
                    return $this->error('该数据库已存在，可直接安装。如需覆盖，请选择覆盖数据库！', '');
                }
            }
            // 创建数据库
            if (!$db_connect->execute("CREATE DATABASE IF NOT EXISTS `{$database}` DEFAULT CHARACTER SET utf8")) {
                return $this->error($db_connect->getError());
            }
            session('db_connect', true);
            return $this->success('数据库连接成功', '');
        } else {
            return $this->error('非法访问');
        }
    }

    /**
     * 第五步：数据库安装
     * @return mixed
     */
    private function step5()
    {
        if ($this->request->isPost()) {
            $post = $this->request->post();

            //判断数据库连接是否正确
            if (session('db_connect') == null || session('db_connect') != true) {
                return $this->error('请先点击 【测试数据连接】 再及进行安装！');
            }

            //验证数据
            $validate = $this->validate($post, ['admin_url|后台路径必须设置' => 'require', 'username|管理员账号' => 'require|alphaNum', 'password|管理员密码' => 'require|length:6,20']);
            if (true !== $validate) return $this->error($validate);

            P('=============初始化数据库=============');
            //初始化数据库
            $sql_file = Env::get('app_path') . '/install/sql/install.sql';
            if (!file_exists($sql_file)) return $this->error('app/install/sql/install.sql文件不存在');
            $sql = file_get_contents($sql_file);
            $sql_list = parse_sql($sql);

            P('=============获取sql语句=============');

            try {
                $admin_module_name = Db::name('system_config')->where(['group' => 'basic', 'name' => 'AdminModuleName'])->value('value');
            } catch (\Exception $e) {
                $admin_module_name = '';
            }
            if ($sql_list) {
                $sql_list = array_filter($sql_list);

                P('=============sql语句=============');
                P($sql_list);

                Db::startTrans();
                try {
                    foreach ($sql_list as $v) {

                        P('=============sql单条语句=============');
                        P($v);

                        Db::execute($v);
                    }
                    Db::commit();
                } catch (\Exception $e) {
                    Db::rollback();

                    P('=============sql导入失败=============');
                    P($e->getMessage());

                    return $this->error('导入SQL失败，请检查install.sql的语句是否正确。' . $e->getMessage());
                }
            }

            P('==============完成数据的导入=============');

            if (empty($admin_module_name)) {
                $admin_module_name = Db::name('system_config')->where(['group' => 'basic', 'name' => 'AdminModuleName'])->value('value');
            }
            //初始化后台登录账号
            $insert = [
                'username' => $post['username'],
                'password' => password($post['password']),
                'id'       => '1',
                'auth_id'  => '[]',
                'status'   => 1,
            ];

            P('=============初始化账号密码=============');

            Db::startTrans();
            try {
                Db::table('system_user')->insert($insert);
                Db::name('system_config')->where(['group' => 'basic', 'name' => 'AdminModuleName'])->update(['value' => $post['admin_url']]);
                Db::commit();
            } catch (\Exception $e) {
                Db::rollback();
                return $this->error($e->getMessage());
            }

            P('=============完成初始化账号密码=============');

            //打印安装信息
            $create_at = date('Y-m-d H:i:s');
            $install_info = <<<INFO
创建时间：{$create_at}
温馨提示：如需进行重新安装，请先删除此文件！
INFO;

            P('=============写入admin地址=============');

            $this->mkAdmin($post['admin_url'], $admin_module_name);

            P('=============完成写入admin地址=============');
            P('=============写入install地址=============');
            try {
                if(!file_exists(Env::get('config_path') . 'lock')){
                    mkdir(Env::get('config_path') . 'lock');
                }
                file_put_contents(Env::get('config_path') . 'lock/install.lock', $install_info);
            } catch (\Exception $e) {
                return $this->error($e->getMessage());
            }
            P('=============完成写入install地址=============');

            app('cache')->clear();
            session('db_connect', null);
            return $this->success('恭喜你，99Blog创建成功！');

        }
    }

    /**
     * 环境检测
     * @return array
     */
    private function checkNnv()
    {
        $items = [
            'os'  => ['操作系统', '不限制', 'Windows/Unix', PHP_OS, 'ok'],
            'php' => ['PHP版本', '7.0', '7.0及以上', PHP_VERSION, 'ok'],
            'gd'  => ['GD库', '2.0', '2.0及以上', '未知', 'ok'],

        ];
        if ($items['php'][3] < $items['php'][1]) {
            $items['php'][4] = 'no';
            session('install_error', true);
        }
        $tmp = function_exists('gd_info') ? gd_info() : [];
        if (empty($tmp['GD Version'])) {
            $items['gd'][3] = '未安装';
            $items['gd'][4] = 'no';
            session('install_error', true);
        } else {
            $items['gd'][3] = $tmp['GD Version'];
        }

        return $items;
    }

    /**
     * 目录权限检查
     * @return array
     */
    private function checkDir()
    {
        $items = [
            ['dir', '../application', '读写', '读写', 'ok'],
            ['dir', '../config', '读写', '读写', 'ok'],
            ['dir', '../runtime', '读写', '读写', 'ok'],
            ['dir', '../public', '读写', '读写', 'ok'],

        ];
        foreach ($items as &$v) {
            if ($v[0] == 'dir') {// 文件夹
                if (!is_writable($v[1])) {
                    if (is_dir($v[1])) {
                        $v[3] = '不可写';
                        $v[4] = 'no';
                    } else {
                        $v[3] = '不存在';
                        $v[4] = 'no';
                    }
                    session('install_error', true);
                }
            } else {// 文件
                if (!is_writable($v[1])) {
                    $v[3] = '不可写';
                    $v[4] = 'no';
                    session('install_error', true);
                }
            }
        }
        return $items;
    }

    /**
     * 函数及扩展检查
     * @return array
     */
    private function checkFunc()
    {
        $items = [
            ['pdo', '支持', 'yes', '类'],
            ['pdo_mysql', '支持', 'yes', '模块'],
            ['zip', '支持', 'yes', '模块'],
            ['fileinfo', '支持', 'yes', '模块'],
            ['curl', '支持', 'yes', '模块'],
            ['xml', '支持', 'yes', '函数'],
            ['file_get_contents', '支持', 'yes', '函数'],
            ['mb_strlen', '支持', 'yes', '函数'],
            ['gzopen', '支持', 'yes', '函数'],
        ];

        if (version_compare(PHP_VERSION, '5.6.0', 'ge') && version_compare(PHP_VERSION, '5.7.0', 'lt')) {
            $items[] = ['always_populate_raw_post_data', '支持', 'yes', '配置'];
        }

        foreach ($items as &$v) {
            if (('类' == $v[3] && !class_exists($v[0])) || ('模块' == $v[3] && !extension_loaded($v[0])) || ('函数' == $v[3] && !function_exists($v[0])) || ('配置' == $v[3] && ini_get('always_populate_raw_post_data') != -1)) {
                $v[1] = '不支持';
                $v[2] = 'no';
                session('install_error', true);
            }
        }

        return $items;
    }

    /**
     * 生成后台入口文件
     * @param $name
     * @return string
     */
    private function mkAdmin($name, $admin_module_name)
    {
        try {
            unlink(Env::get('root_path') . 'public/' . $admin_module_name . '.php');
        } catch (\Exception $e) {

        }

        $code = <<<INFO
<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

namespace think;

/**
 * 后台地址入口
 */
// 加载基础文件
require __DIR__ . '/../thinkphp/base.php';

//判断应用是否已安装
if (file_exists('../config/lock/install.lock') == false) {
    header("location:./install.php");
    exit;
}

// 执行应用并响应
Container::get('app')->bind('admin')->run()->send();
INFO;
        try {
            file_put_contents(Env::get('root_path') . 'public/' . $name . '.php', $code);
        } catch (Exception $e) {
            return msg_error($e->getMessage());
        }
    }

    /**
     * 生成数据库配置文件
     * @return array
     */
    private function mkDatabase(array $data)
    {
        $code = <<<INFO
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
    'prefix'          => '',
    // 数据库调试模式
    'debug'           => true,
    // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
    'deploy'          => 0,
    // 数据库读写是否分离 主从式有效
    'rw_separate'     => false,
    // 读写分离后 主服务器数量
    'master_num'      => 1,
    // 指定从服务器序号
    'slave_no'        => '',
    // 自动读取主库数据
    'read_master'     => false,
    // 是否严格检查字段是否存在
    'fields_strict'   => true,
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
    // 是否需要断线重连
    'break_reconnect' => false,
    // 断线标识字符串
    'break_match_str' => [],
];
INFO;
        try {
            file_put_contents(Env::get('config_path') . 'database.php', $code);
        } catch (Exception $e) {
            return msg_error($e);
        }
    }
}