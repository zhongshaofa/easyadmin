<?php /*a:2:{s:62:"/var/www/html/EasyAdmin/app/admin/view/system/admin/index.html";i:1573294300;s:57:"/var/www/html/EasyAdmin/app/admin/view/Public/iframe.html";i:1573324386;}*/ ?>
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
    
</head>
<body>

<div class="layuimini-container">
    <div class="layuimini-main">
        <table id="currentTable" class="layui-table" lay-filter="currentTable"></table>
    </div>
</div>

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