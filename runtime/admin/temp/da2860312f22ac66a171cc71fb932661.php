<?php /*a:2:{s:61:"/var/www/html/EasyAdmin/app/admin/view/system/menu/index.html";i:1573145829;s:57:"/var/www/html/EasyAdmin/app/admin/view/Public/iframe.html";i:1573324386;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo htmlentities((isset($title) && ($title !== '')?$title:'EasyAdmin后台管理')); ?></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/static/plugs/layui-v2.5.5/css/layui.css?v=<?php echo time(); ?>" media="all">
    <link rel="stylesheet" href="/static/plugs/font-awesome-4.7.0/css/font-awesome.min.css?v=<?php echo time(); ?>" media="all">
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js?v=<?php echo time(); ?>"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js?v=<?php echo time(); ?>"></script>
    <![endif]-->
    <link rel="stylesheet" href="/static/plugs/lay-module/layuimini/layuimini-public.css?v=<?php echo time(); ?>" media="all">
    
<link rel="stylesheet" href="/static/plugs/lay-module/treetable-lay/treetable.css?v=<?php echo time(); ?>" media="all">
<style>
    .layui-btn:not(.layui-btn-lg ):not(.layui-btn-sm):not(.layui-btn-xs) {
        height: 34px;
        line-height: 34px;
        padding: 0 8px;
    }
</style>

</head>
<body>

<div class="layuimini-container">
    <div class="layuimini-main">
        <table id="currentTable" class="layui-table" lay-filter="currentTable"></table>
    </div>
</div>
<script type="text/html" id="toolbar">
    <button class="layui-btn layui-btn-sm layui-btn-normal " data-table-refresh=""><i class="layui-icon layui-icon-refresh"></i></button>
    <button class="layui-btn layui-btn-sm" data-open="system.menu/add" data-title="添加"><i class="layui-icon layui-icon-add-circle-fine"></i>添加</button>
    <button class="layui-btn layui-btn-sm layui-btn-danger" lay-event="deleteAll"><i class="layui-icon layui-icon-delete"></i>删除</button>
</script>

<script>
    window.ADMIN = "<?php echo htmlentities((isset($admin_module_name) && ($admin_module_name !== '')?$admin_module_name:'admin')); ?>";
    window.CONTROLLER_JS_PATH = "<?php echo htmlentities((isset($thisControllerJsPath) && ($thisControllerJsPath !== '')?$thisControllerJsPath:'')); ?>";
    window.ACTION = "<?php echo htmlentities((isset($thisAction) && ($thisAction !== '')?$thisAction:'')); ?>";
    window.AUTOLOAD_JS = "<?php echo htmlentities((isset($autoloadJs) && ($autoloadJs !== '')?$autoloadJs:'false')); ?>";
</script>
<script src="/static/plugs/layui-v2.5.5/layui.all.js?v=<?php echo time(); ?>" charset="utf-8"></script>
<script src="/static/plugs/require-2.3.6/require.js?v=<?php echo time(); ?>" charset="utf-8"></script>
<script src="/static/config-admin.js?v=<?php echo time(); ?>" charset="utf-8"></script>

</body>
</html>