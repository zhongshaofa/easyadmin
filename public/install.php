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
</head>
<style>
    body{
        text-align: center;
    }
    h1{
        margin-top: 30px;
    }
    h1 img{
        width: 150px;
        height: 150px;
    }
    h2 {
        font-size: 28px;
        font-weight: normal;
        color: #3C5675;
        margin-bottom: 0
    }
    .content{
        margin-top: 20px;
    }
    .content p{
        margin: 20px;
    }
    .content form{
        margin:0 auto;
        width: 500px;
    }
    @media screen and (max-width:768px) {
        .content form{
            width: auto;
        }
    }
</style>
<body>
<h1><img src="static/common/images/logo-1.png"></h1>
<h2>安装EasyAdmin后台系统</h2>
<div class="content">
    <p>使用过程中遇到问题可参考使用文档或者加入QQ群<a href="https://doc.fastadmin.net?ref=install" target="_blank">使用文档</a><a href="https://jq.qq.com/?_wv=1027&amp;k=487PNBb">QQ交流群</a></p>
    <form class="layui-form layui-form-pane" action="">
        <fieldset class="layui-elem-field layui-field-title">
            <legend>数据库配置</legend>
        </fieldset>
        <div class="layui-form-item">
            <label class="layui-form-label">数据库地址</label>
            <div class="layui-input-block">
                <input class="layui-input" name="hostname" autocomplete="off" lay-verify="required" lay-reqtext="请输入数据库地址" placeholder="请输入数据库地址">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">数据库端口</label>
            <div class="layui-input-block">
                <input class="layui-input" name="hostport" autocomplete="off" lay-verify="required" lay-reqtext="请输入数据库端口" placeholder="请输入数据库端口">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">数据库名称</label>
            <div class="layui-input-block">
                <input class="layui-input" name="database" autocomplete="off" lay-verify="required" lay-reqtext="请输入数据库名称" placeholder="请输入数据库名称">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">数据库账号</label>
            <div class="layui-input-block">
                <input class="layui-input" name="username" autocomplete="off" lay-verify="required" lay-reqtext="请输入数据库账号" placeholder="请输入数据库账号">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">数据库密码</label>
            <div class="layui-input-block">
                <input class="layui-input" name="password" autocomplete="off" lay-verify="required" lay-reqtext="请输入数据库密码" placeholder="请输入数据库密码">
            </div>
        </div>

        <fieldset class="layui-elem-field layui-field-title">
            <legend>后台路径设置</legend>
        </fieldset>

        <div class="layui-form-item">
            <label class="layui-form-label">后台的地址</label>
            <div class="layui-input-block">
                <input class="layui-input" name="admin_url" autocomplete="off" lay-verify="required" lay-reqtext="请输入后台的地址" placeholder="请输入后台的地址">
            </div>
        </div>

        <fieldset class="layui-elem-field layui-field-title">
            <legend>管理账号设置</legend>
        </fieldset>

        <div class="layui-form-item">
            <label class="layui-form-label">管理员账号</label>
            <div class="layui-input-block">
                <input class="layui-input" name="username" autocomplete="off" lay-verify="required" lay-reqtext="请输入管理员账号" placeholder="请输入管理员账号">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">管理员密码</label>
            <div class="layui-input-block">
                <input class="layui-input" name="password" autocomplete="off" lay-verify="required" lay-reqtext="请输入管理员密码" placeholder="请输入管理员密码">
            </div>
        </div>

        <div class="layui-form-item">
            <button class="layui-btn" lay-submit="" lay-filter="demo2">确定安装</button>
        </div>
    </form>
</div>

<script src="static/plugs/layui-v2.5.5/layui.js?v={:time()}" charset="utf-8"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
    layui.use(['form', 'layedit', 'laydate'], function () {
        var form = layui.form
            , layer = layui.layer
            , layedit = layui.layedit
            , laydate = layui.laydate;

        //监听提交
        form.on('submit(demo2)', function (data) {
            layer.alert(JSON.stringify(data.field), {
                title: '最终的提交信息'
            });
            return false;
        });

    });
</script>

</body>
</html>
