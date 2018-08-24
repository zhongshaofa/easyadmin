<?php /*a:1:{s:63:"H:\phpStudy\WWW\99Admin\application\index\view\index\index.html";i:1534329952;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo htmlentities((isset($title) && ($title !== '')?$title:'久久PHP后台管理系统')); ?>}</title>
    <meta name="keywords" content="久久PHP管理系统,RABC权限控制系统,后台管理系统,ThinkPHP5.1,layui,layuicms"/>
    <meta name="description" content="久久PHP管理系统,RABC权限控制系统,后台管理系统,ThinkPHP5.1,layui,layuicms"/>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/static/plugs/layui/css/layui.css" media="all"/>
    <link rel="stylesheet" href="/static/css/index/global.css" media="all">
</head>
<body class="site-home" style="background-color: #eee;">
<div class="layui-header header header-index">
    <div class="layui-main">
        <a class="logo" href="/">99Admin</a>
        <div class="layui-form component">
        </div>
        <ul class="layui-nav">
            <li class="layui-nav-item layui-icon">
                <a href="<?php echo url('@blog'); ?>" target="_blank" class="layui-icon">&#xe670; <cite>久久PHP社区</cite></a>
            </li>
            <li class="layui-nav-item layui-icon">
                <a href="<?php echo url('@admin'); ?>" target="_blank" class="layui-icon">&#xe609; <cite>演示地址</cite></a>
            </li>
            <li class="layui-nav-item layui-hide-xs">
                <a href="<?php echo htmlentities((isset($data['QQUrl']) && ($data['QQUrl'] !== '')?$data['QQUrl']:'')); ?>" target="_blank" class="layui-icon">&#xe676; <cite>加QQ群</cite></a>
            </li>
        </ul>
    </div>
</div>

<!--[if lt IE 9]>
<script src="/static/js/index/html5.min.js"></script>
<script src="/static/js/index/respond.min.js"></script>
<![endif]-->
<div class="site-banner h600">
    <canvas id="canvas">浏览器不支持canvas</canvas>
    <div class="site-banner-bg"></div>
    <div class="site-banner-main">
        <div class="site-zfj">
            <!--<i class="layui-icon" style="color: #fff; color: rgba(255,255,255,.7);">&#xe609;</i>-->
        </div>
        <div class="layui-anim site-desc">
            <h2 class="site-desc h2 mobilesite-desc h2 mobile"><?php echo htmlentities((isset($data['WelcomeWord']) && ($data['WelcomeWord'] !== '')?$data['WelcomeWord']:'')); ?></h2>
            <cite><?php echo htmlentities((isset($data['Introduce']) && ($data['Introduce'] !== '')?$data['Introduce']:'')); ?></cite>
        </div>
        <div class="site-download download_btn">
            <a class="layui-inline site-down">
                <cite class="layui-icon">&#xe601;</cite>
                立即下载
            </a>
        </div>
        <div class="site-version">
            <span>当前版本：<cite class="site-showv"><?php echo htmlentities((isset($data['Version']) && ($data['Version'] !== '')?$data['Version']:'')); ?></cite></span>
            <span>下载量：<cite class="site-showv"><?php echo htmlentities((isset($download_sum) && ($download_sum !== '')?$download_sum:'统计错误')); ?></cite></span>
        </div>
        <div class="site-banner-other">
            <a href="<?php echo htmlentities((isset($data['GitHub']) && ($data['GitHub'] !== '')?$data['GitHub']:'')); ?>" target="_blank" rel="nofollow" class="site-star">
                <i class="layui-icon">&#xe658;</i>
                github
            </a>
            <a href="<?php echo htmlentities((isset($data['Gitee']) && ($data['Gitee'] !== '')?$data['Gitee']:'')); ?>" target="_blank" rel="nofollow" class="site-fork">
                <i class="layui-icon">&#xe658;</i>
                码云
            </a>
        </div>
    </div>
</div>
<div class="layui-main">
    <ul class="site-idea">
        <li>
            <fieldset class="layui-elem-field layui-field-title">
                <legend>项目描述</legend>
                <p><?php echo htmlentities((isset($data['Describe1']) && ($data['Describe1'] !== '')?$data['Describe1']:'')); ?></p>
            </fieldset>
        </li>
        <li>
            <fieldset class="layui-elem-field layui-field-title">
                <legend>星辰大海</legend>
                <p><?php echo htmlentities((isset($data['Describe2']) && ($data['Describe2'] !== '')?$data['Describe2']:'')); ?></p>
            </fieldset>
        </li>
    </ul>
</div>
<div class="layui-footer footer footer-index">
    <div class="layui-main">
        <p>
            <span><?php echo htmlentities((isset($SysInfo['FooterName']) && ($SysInfo['FooterName'] !== '')?$SysInfo['FooterName']:'')); ?></span><a href="<?php echo htmlentities((isset($SysInfo['BeianUrl']) && ($SysInfo['BeianUrl'] !== '')?$SysInfo['BeianUrl']:'')); ?>" target="_blank"><?php echo htmlentities((isset($SysInfo['Beian']) && ($SysInfo['Beian'] !== '')?$SysInfo['Beian']:'')); ?></a>
        </p>
        <p>
            声明：请在遵守法律的前提下使用本站软件，对用户在使用过程中的信息内容本站不负任何责任！
        </p>
    </div>
</div>
<div class="site-tree-mobile layui-hide">
    <i class="layui-icon">&#xe602;</i>
</div>
<div class="site-mobile-shade"></div>
<script type="text/javascript" src="/static/plugs/jquery/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="/static/plugs/layui/layui.js"></script>
<script src="/static/js/index/canvasparticle.js" charset="utf-8"></script>
<script src="/static/js/index/global.js" charset="utf-8"></script>
<span style="display:none;">
<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cspan id='cnzz_stat_icon_420039'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s23.cnzz.com/stat.php%3Fid%3D420039' type='text/javascript'%3E%3C/script%3E"));</script>
</span>
<script>
    layui.use(['form', 'layer'], function () {
        var form = layui.form
        layer = parent.layer === undefined ? layui.layer : top.layer,
            $ = layui.jquery;

        /**
         * 下载文件，记录数据
         */
        $(".download_btn").on("click", function () {
            layer.confirm('确定进行下载？', {title: '下载提示'}, function (index) {
                window.location.href = "<?php echo htmlentities((isset($data['DownloadUrl']) && ($data['DownloadUrl'] !== '')?$data['DownloadUrl']:'')); ?>";
                $.get("<?php echo url('@index/index/download'); ?>"
                    , function (data) {
                        console.log(data);
                    })
                layer.close(index);
            })
        })

    })
</script>
</body>
</html>