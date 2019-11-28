<?php

ini_set('display_errors', 'On');
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use think\facade\Db;
use think\App;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/topthink/framework/src/helper.php';

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', __DIR__ . DS . '..' . DS);
define('INSTALL_PATH', ROOT_PATH . 'install' . DS);

// 检测系统环境


// POST请求
if (isAjax()) {
    $post = $_POST;

    // 参数验证
    $app = new App();
    $app->validate->setLang($app->lang);
    $app->lang->load(root_path() . 'vendor' . DS . 'topthink' . DS . 'framework' . DS . 'src' . DS . 'lang' . DS . 'zh-cn.php');
    $validate = $app->validate->rule([
        'hostname|数据库地址'    => 'require|activeUrl',
        'hostport|数据库端口'    => 'require|number',
        'database|数据库名称'    => 'require',
        'prefix|数据表前缀'      => 'require',
        'db_username|数据库账号' => 'require',
        'db_password|数据库密码' => 'require',
        'cover|覆盖数据库'       => 'require|number|in:0,1',
        'admin_url|后台的地址'   => 'require|length:5,20',
        'username|管理员账号'    => 'require|length:4,25',
        'password|管理员密码'    => 'require|length:6,30',
    ]);
    if (!$validate->check($post)) {
        $data = [
            'code' => 0,
            'msg'  => $validate->getError(),
        ];
        die(json_encode($data));
    }

    $cover = $post['cover'] == 1 ? true : false;
    $database = $post['database'];
    $hostname = $post['hostname'];
    $hostport = $post['hostport'];
    $dbUsername = $post['db_username'];
    $dbPassword = $post['db_password'];
    $prefix = $post['prefix'];
    $adminUrl = $post['admin_url'];
    $username = $post['username'];
    $password = $post['password'];

    // DB类初始化
    $config = [
        'type'     => 'mysql',
        'hostname' => $hostname,
        'username' => $dbUsername,
        'password' => $dbPassword,
        'hostport' => $hostport,
        'charset'  => 'utf8',
        'prefix'   => $prefix,
        'debug'    => true,
    ];
    $app->db->setConfig([
        'default'     => 'mysql',
        'connections' => [
            'mysql'   => $config,
            'install' => array_merge($config, ['database' => $database]),
        ],
    ]);

    // 检测数据库连接
    if (!checkConnect()) {
        $data = [
            'code' => 0,
            'msg'  => '数据库连接失败',
        ];
        die(json_encode($data));
    }
    // 检测数据库是否存在
    if (!$cover && checkDatabase($database)) {
        $data = [
            'code' => 0,
            'msg'  => '数据库已存在，请选择覆盖安装或者修改数据库名',
        ];
        die(json_encode($data));
    }
    // 创建数据库
    createDatabase($database);
    // 导入sql语句
    $install = importSql();
    if ($install !== true) {
        $data = [
            'code' => 0,
            'msg'  => '系统安装失败：' . $install,
        ];
        die(json_encode($data));
    }
    $data = [
        'code' => 1,
        'msg'  => '系统安装成功，正在跳转登录页面',
        'url'  => $adminUrl,
    ];
    die(json_encode($data));
}


function isAjax()
{
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        return true;
    } else {
        return false;
    }
}

function isPost()
{
    return ($_SERVER['REQUEST_METHOD'] == 'POST' && checkurlHash($GLOBALS['verify'])
        && (empty($_SERVER['HTTP_REFERER']) || preg_replace("~https?:\/\/([^\:\/]+).*~i", "\\1", $_SERVER['HTTP_REFERER']) == preg_replace("~([^\:]+).*~", "\\1", $_SERVER['HTTP_HOST']))) ? 1 : 0;
}

function checkConnect()
{
    try {
        Db::query("select version()");
    } catch (\Exception $e) {
        return false;
    }
    return true;
}

function checkDatabase($database)
{
    $check = Db::query("SELECT * FROM information_schema.schemata WHERE schema_name='{$database}'");
    if (empty($check)) {
        return false;
    } else {
        return true;
    }
}

function createDatabase($database)
{
    try {
        Db::execute("CREATE DATABASE IF NOT EXISTS `{$database}` DEFAULT CHARACTER SET utf8");
    } catch (\Exception $e) {
        return false;
    }
    return true;
}

function getSqlArray()
{
    $sql = file_get_contents(INSTALL_PATH . 'sql' . DS . 'install.sql');
    $sqlArray = parseSql($sql);
    return $sqlArray;
}

function parseSql($sql = '')
{
    list($pure_sql, $comment) = [[], false];
    $sql = explode("\n", trim(str_replace(["\r\n", "\r"], "\n", $sql)));
    foreach ($sql as $key => $line) {
        if ($line == '') {
            continue;
        }
        if (preg_match("/^(#|--)/", $line)) {
            continue;
        }
        if (preg_match("/^\/\*(.*?)\*\//", $line)) {
            continue;
        }
        if (substr($line, 0, 2) == '/*') {
            $comment = true;
            continue;
        }
        if (substr($line, -2) == '*/') {
            $comment = false;
            continue;
        }
        if ($comment) {
            continue;
        }
        array_push($pure_sql, $line);
    }
    $pure_sql = implode($pure_sql, "\n");
    $pure_sql = explode(";\n", $pure_sql);
    return $pure_sql;
}

function importSql()
{
    $sqlArray = getSqlArray();
    Db::startTrans();
    try {
        foreach ($sqlArray as $vo) {
            Db::connect('install')->execute($vo);
        }
        // 处理安装文件
        Db::commit();
    } catch (\Exception $e) {
        Db::rollback();
        return $e->getMessage();
    }
    return true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>安装EasyAdmin后台程序</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="static/plugs/layui-v2.5.5/css/layui.css?v={:time()}" media="all">
    <link rel="stylesheet" href="static/common/css/insatll.css?v={:time()}" media="all">
</head>
<body>
<h1><img src="static/common/images/logo-1.png"></h1>
<h2>安装EasyAdmin后台系统</h2>
<div class="content">
    <p class="desc">
        使用过程中遇到任何问题可参考
        <a href="http://easyadmin.99php.cn/docs" target="_blank">文档教程</a>
        <a href="https://jq.qq.com/?_wv=1027&k=5IHJawE">QQ交流群</a>
    </p>
    <form class="layui-form layui-form-pane" action="">
        <div class="bg">
            <div class="layui-form-item">
                <label class="layui-form-label">数据库地址</label>
                <div class="layui-input-block">
                    <input class="layui-input" name="hostname" autocomplete="off" lay-verify="required" lay-reqtext="请输入数据库地址" placeholder="请输入数据库地址" value="host.docker.internal">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">数据库端口</label>
                <div class="layui-input-block">
                    <input class="layui-input" name="hostport" autocomplete="off" lay-verify="required" lay-reqtext="请输入数据库端口" placeholder="请输入数据库端口" value="3306">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">数据库名称</label>
                <div class="layui-input-block">
                    <input class="layui-input" name="database" autocomplete="off" lay-verify="required" lay-reqtext="请输入数据库名称" placeholder="请输入数据库名称" value="easyadmin">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">数据表前缀</label>
                <div class="layui-input-block">
                    <input class="layui-input" name="prefix" autocomplete="off" lay-verify="required" lay-reqtext="请输入数据表前缀" placeholder="请输入数据表前缀" value="ea_">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">数据库账号</label>
                <div class="layui-input-block">
                    <input class="layui-input" name="db_username" autocomplete="off" lay-verify="required" lay-reqtext="请输入数据库账号" placeholder="请输入数据库账号" value="root">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">数据库密码</label>
                <div class="layui-input-block">
                    <input type="password" class="layui-input" name="db_password" autocomplete="off" lay-verify="required" lay-reqtext="请输入数据库密码" placeholder="请输入数据库密码" value="root">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">覆盖数据库</label>
                <div class="layui-input-block" style="text-align: left">
                    <input type="radio" name="cover" value="1" title="覆盖">
                    <input type="radio" name="cover" value="0" title="不覆盖" checked>
                </div>
            </div>
        </div>
        <div class="bg">
            <div class="layui-form-item">
                <label class="layui-form-label">后台的地址</label>
                <div class="layui-input-block">
                    <input class="layui-input" name="admin_url" autocomplete="off" lay-verify="required" lay-reqtext="请输入后台的地址" placeholder="请输入后台的地址" value="admintest">
                    <span class="tips">为了后台安全，不建议将后台路径设置为admin</span>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">管理员账号</label>
                <div class="layui-input-block">
                    <input class="layui-input" name="username" autocomplete="off" lay-verify="required" lay-reqtext="请输入管理员账号" placeholder="请输入管理员账号" value="admin">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">管理员密码</label>
                <div class="layui-input-block">
                    <input type="password" class="layui-input" name="password" autocomplete="off" lay-verify="required" lay-reqtext="请输入管理员密码" placeholder="请输入管理员密码" value="123456">
                </div>
            </div>
        </div>

        <div class="layui-form-item">
            <button class="layui-btn" lay-submit="" lay-filter="install">确定安装</button>
        </div>
    </form>
</div>
<script src="static/plugs/layui-v2.5.5/layui.js?v={:time()}" charset="utf-8"></script>
<script>
    layui.use(['form', 'layer'], function () {
        var $ = layui.jquery,
            form = layui.form,
            layer = layui.layer;
        form.on('submit(install)', function (data) {
            var _data = data.field;
            var loading = layer.msg('正在安装...', {
                icon: 16,
                shade: 0.2,
                time: false
            });
            $.ajax({
                url: window.location.href,
                type: 'post',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                dataType: "json",
                data: _data,
                timeout: 60000,
                success: function (data) {
                    layer.close(loading);
                    if (data.code == 1) {
                        layer.msg(data.msg, {icon: 1}, function () {
                            window.location.href = location.protocol + '//' + location.host + '/' + data.url;
                        });
                    } else {
                        layer.msg(data.msg, {icon: 2});
                    }
                },
                error: function (xhr, textstatus, thrown) {
                    layer.close(loading);
                    layer.msg('Status:' + xhr.status + '，' + xhr.statusText + '，请稍后再试！', {icon: 2});
                    return false;
                }
            });
            return false;
        });
    });
</script>
</body>
</html>
