<?php /*a:2:{s:55:"/var/www/html/EasyAdmin/app/admin/view/login/index.html";i:1573145621;s:56:"/var/www/html/EasyAdmin/app/admin/view/Public/basic.html";i:1573324382;}*/ ?>
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
    
<link rel="stylesheet" href="/static/admin/css/login.css?v=<?php echo time(); ?>" media="all">

</head>
<body>

<div class="layui-container">
    <div class="admin-login-background">
        <div class="layui-form login-form">
            <form class="layui-form" action="">
                <div class="layui-form-item logo-title">
                    <h1>EasyAdmin后台登录</h1>
                </div>

                <div class="layui-form-item">
                    <label class="layui-icon layui-icon-username"></label>
                    <input type="text" name="username" lay-verify="required" lay-reqtext="请输入登录账号" placeholder="请输入登录账号" autocomplete="off" class="layui-input">
                </div>

                <div class="layui-form-item">
                    <label class="layui-icon layui-icon-password"></label>
                    <input type="password" name="password" lay-verify="required" lay-reqtext="请输入登录密码" placeholder="请输入登录密码" autocomplete="off" class="layui-input">
                </div>

                <?php if($captcha == 1): ?>
                <div class="layui-form-item">
                    <label class="layui-icon layui-icon-vercode"></label>
                    <input type="text" name="captcha" lay-verify="required" placeholder="图形验证码" autocomplete="off" class="layui-input verification captcha">
                    <div class="captcha-img">
                        <img id="refreshCaptcha" src="<?php echo url('login/captcha'); ?>" alt="captcha" onclick="this.src='<?php echo url('login/captcha'); ?>?seed='+Math.random()">
                    </div>
                </div>
                <?php endif; ?>

                <div class="layui-form-item">
                    <input type="checkbox" name="rememberMe" value="true" lay-skin="primary" title="记住密码">
                </div>
                <div class="layui-form-item">
                    <button class="layui-btn layui-btn-fluid" lay-submit="" lay-filter="login">登 入</button>
                </div>
            </form>
        </div>
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