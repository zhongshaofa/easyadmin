<?php /*a:2:{s:60:"/var/www/html/EasyAdmin/app/admin/view/system/admin/add.html";i:1573413586;s:57:"/var/www/html/EasyAdmin/app/admin/view/Public/iframe.html";i:1573372826;}*/ ?>
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
                <label class="layui-form-label required">用户头像</label>
                <div class="layui-input-block layuimini-upload">
                    <input name="head_img" class="layui-input layui-col-xs6" lay-verify="required" lay-reqtext="请上传用户头像" placeholder="请上传用户头像" value="">
                    <div class="layuimini-upload-btn">
                        <span><a class="layui-btn" data-upload="head_img" data-upload-number="one" data-upload-exts="png|jpg|ico|jpeg"><i class="fa fa-upload"></i> 上传文件</a></span>
                        <span><a class="layui-btn layui-btn-normal"><i class="fa fa-list"></i> 选择文件</a></span>
                    </div>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label required">登录账户</label>
                <div class="layui-input-block">
                    <input type="text" name="username" class="layui-input" lay-verify="required" lay-reqtext="请输入登录账户" placeholder="请输入登录账户" value="">
                    <tip>填写登录账户。</tip>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">用户手机</label>
                <div class="layui-input-block">
                    <input type="text" name="phone" class="layui-input" lay-reqtext="请输入用户手机" placeholder="请输入用户手机" value="">
                    <tip>填写用户手机。</tip>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">角色权限</label>
                <div class="layui-input-block">
                    <?php foreach($auth_list as $key=>$val): ?>
                    <input type="checkbox" name="auth_ids[<?php echo htmlentities($key); ?>]" lay-skin="primary" title="<?php echo htmlentities($val); ?>">
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">备注信息</label>
                <div class="layui-input-block">
                    <textarea name="remark" class="layui-textarea" placeholder="请输入备注信息"></textarea>
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