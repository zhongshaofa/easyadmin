<?php /*a:2:{s:60:"/var/www/html/EasyAdmin/app/admin/view/system/auth/edit.html";i:1573369829;s:57:"/var/www/html/EasyAdmin/app/admin/view/Public/iframe.html";i:1573372826;}*/ ?>
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
    
    <script>
        window.ADMIN = "<?php echo htmlentities((isset($admin_module_name) && ($admin_module_name !== '')?$admin_module_name:'admin')); ?>";
        window.CONTROLLER_JS_PATH = "<?php echo htmlentities((isset($thisControllerJsPath) && ($thisControllerJsPath !== '')?$thisControllerJsPath:'')); ?>";
        window.ACTION = "<?php echo htmlentities((isset($thisAction) && ($thisAction !== '')?$thisAction:'')); ?>";
        window.AUTOLOAD_JS = "<?php echo htmlentities((isset($autoloadJs) && ($autoloadJs !== '')?$autoloadJs:'false')); ?>";
    </script>
    <script src="/static/plugs/layui-v2.5.5/layui.all.js?v=<?php echo time(); ?>" charset="utf-8"></script>
    <script src="/static/plugs/require-2.3.6/require.js?v=<?php echo time(); ?>" charset="utf-8"></script>
    <script src="/static/config-admin.js?v=<?php echo time(); ?>" charset="utf-8"></script>
</head>
<body>

<div class="layuimini-container">
    <div class="layuimini-main">

        <form id="app-form" class="layui-form layuimini-form">

            <div class="layui-form-item">
                <label class="layui-form-label required">权限名称</label>
                <div class="layui-input-block">
                    <input type="text" name="title" class="layui-input" lay-verify="required" lay-reqtext="请输入权限名称" placeholder="请输入权限名称" value="<?php echo htmlentities((isset($row['title']) && ($row['title'] !== '')?$row['title']:'')); ?>">
                    <tip>填写权限名称。</tip>
                </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">备注信息</label>
                <div class="layui-input-block">
                    <textarea name="remark" class="layui-textarea" placeholder="请输入备注信息"><?php echo htmlentities((isset($row['username']) && ($row['username'] !== '')?$row['username']:'')); ?></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button type="submit" class="layui-btn layui-btn-sm" lay-submit lay-filter="saveForm">确认</button>
                    <button type="reset" class="layui-btn layui-btn-primary layui-btn-sm">重置</button>
                </div>
            </div>
        </form>

    </div>
</div>


</body>
</html>