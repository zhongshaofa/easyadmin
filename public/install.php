<?php

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
            <!--        <fieldset class="layui-elem-field layui-field-title">-->
            <!--            <legend>数据库配置</legend>-->
            <!--        </fieldset>-->
            <div class="layui-form-item">
                <label class="layui-form-label">数据库地址</label>
                <div class="layui-input-block">
                    <input class="layui-input" name="hostname" autocomplete="off" lay-verify="required" lay-reqtext="请输入数据库地址" placeholder="请输入数据库地址" value="127.0.0.1">
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
                    <input class="layui-input" name="username" autocomplete="off" lay-verify="required" lay-reqtext="请输入数据库账号" placeholder="请输入数据库账号" value="root">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">数据库密码</label>
                <div class="layui-input-block">
                    <input type="password" class="layui-input" name="password" autocomplete="off" lay-verify="required" lay-reqtext="请输入数据库密码" placeholder="请输入数据库密码">
                </div>
            </div>
        </div>
        <div class="bg">

            <!--        <fieldset class="layui-elem-field layui-field-title">-->
            <!--            <legend>后台路径设置</legend>-->
            <!--        </fieldset>-->

            <div class="layui-form-item">
                <label class="layui-form-label">后台的地址</label>
                <div class="layui-input-block">
                    <input class="layui-input" name="admin_url" autocomplete="off" lay-verify="required" lay-reqtext="请输入后台的地址" placeholder="请输入后台的地址" value="admintest">
                    <span class="tips">为了后台安全，不建议将后台路径设置为admin</span>
                </div>
            </div>

            <!--        <fieldset class="layui-elem-field layui-field-title">-->
            <!--            <legend>管理账号设置</legend>-->
            <!--        </fieldset>-->

            <div class="layui-form-item">
                <label class="layui-form-label">管理员账号</label>
                <div class="layui-input-block">
                    <input class="layui-input" name="username" autocomplete="off" lay-verify="required" lay-reqtext="请输入管理员账号" placeholder="请输入管理员账号" value="admin">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">管理员密码</label>
                <div class="layui-input-block">
                    <input type="password" class="layui-input" name="password" autocomplete="off" lay-verify="required" lay-reqtext="请输入管理员密码" placeholder="请输入管理员密码">
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
    layui.use(['form', 'layedit', 'laydate'], function () {
        var form = layui.form,
            layer = layui.layer;

        form.on('submit(install)', function (data) {
            layer.alert(JSON.stringify(data.field), {
                title: '最终的提交信息'
            });
            return false;
        });

    });
</script>

</body>
</html>
