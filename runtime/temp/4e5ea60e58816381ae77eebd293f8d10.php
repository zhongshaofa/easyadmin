<?php /*a:4:{s:61:"H:\phpStudy\WWW\99Admin\application\blog\view\test\index.html";i:1534920033;s:63:"H:\phpStudy\WWW\99Admin\application\blog\view\public\basic.html";i:1534384095;s:64:"H:\phpStudy\WWW\99Admin\application\blog\view\public\header.html";i:1534408613;s:64:"H:\phpStudy\WWW\99Admin\application\blog\view\public\footer.html";i:1534125330;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo htmlentities((isset($title) && ($title !== '')?$title:'久久PHP社区')); ?></title>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <meta name="keywords" content="久久PHP社区">
    <meta name="description" content="久久PHP博客网站。">
    <LINK rel="Bookmark" href="favicon.ico">
    <LINK rel="Shortcut Icon" href="favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="/static/plugs/blog/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/static/plugs/blog/Hui-iconfont/1.0.8/iconfont.min.css"/>
    <link rel="stylesheet" type="text/css" href="/static/css/blog/common.css"/>
    <link rel="stylesheet" type="text/css" href="/static/css/blog/page.css"/>
    <link rel="stylesheet" type="text/css" href="/static/plugs/blog/pifu/pifu.css"/>
    <link rel="stylesheet" type="text/css" href="/static/css/blog/header.css"/>
    <link rel="stylesheet" type="text/css" href="/static/plugs/wangEditor-3.1.1/release/wangEditor.min.css"/>
    <link rel="stylesheet" href="/static/plugs/layui/css/layui.css" media="all"/>
    <!--<link rel="stylesheet" type="text/css" href="/static/css/blog/search.css"/>-->

    
<!--<link rel="stylesheet" href="/static/plugs/layui/css/layui.css" media="all" />-->
<script type="text/javascript">
    var childWindow;
    function toQzoneLogin()
    {
        childWindow = window.open("oauth/index","TencentLogin","width=450,height=320,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1");
    }

    function closeChildWindow()
    {
        childWindow.close();
    }
</script>
<!--<link rel="stylesheet" type="text/css" href="/static/css/blog/head.css"/>-->


    <script type="application/x-javascript"> addEventListener("load", function () {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }

    function showSide() {
        $('.navbar-nav').toggle();
    }</script>
</head>
<body>


<header class="navbar-wrapper">
    <div class="navbar navbar-fixed-top">
        <div class="container cl">
            <a class="navbar-logo hidden-xs" href="<?php echo url('@blog'); ?>">
                <img class="logo" src="/static/image/blog/logo.png" alt="久久PHP社区"/>
            </a>
            <a class="logo navbar-logo-m visible-xs" href="<?php echo url('@blog'); ?>">久久PHP社区</a>
            <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:void(0);" onclick="showSide();">&#xe667;</a>
            <nav class="nav navbar-nav nav-collapse w_menu" role="navigation">
                <ul class="cl">
                    <li class="active"><a class="header-menu" href="<?php echo url('@blog'); ?>">首页</a></li>
                    <li><a class="header-menu" href="<?php echo url('@blog/article'); ?>">技术教程</a></li>
                    <!--<li> <a class="header-menu" href="mood.html">碎言碎语</a> </li>-->
                    <!--<li> <a class="header-menu" href="test.html">学无止尽</a></li>-->
                    <!--<li> <a class="header-menu" href="board.html">留言板</a> </li>-->
                    <li>
                        <input id="homeAdd" type="submit" value="" class="home-add">
                    <li>
                        <div class="nav-rsear">
                            <form action="<?php echo url('@blog/search'); ?>" method="get" target="_blank">
                                <input name="word" id="word" type="text" value="<?php echo htmlentities((app('request')->get('word') ?: '')); ?>" placeholder="输入您要搜索的内容" class="sear-1">
                                <input id="selectKwd" type="submit" value="" class="sear-2">
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <nav class="navbar-nav navbar-userbar hidden-xs hidden-sm " style="top: 0;">
                <ul class="cl">
                    <!--<li class="userInfo dropDown dropDown_hover">-->
                    <!--<div class="nav-rsear">-->
                    <!--<form action="https://www.php1.cn/search.html" method="get" target="_blank">-->
                    <!--<input name="kwd" id="kwd" type="text" placeholder="输入您要搜索的内容" class="sear-1">-->
                    <!--<input name="" type="submit" value="" class="sear-2">-->
                    <!--</form>-->
                    <!--</div>-->
                    <!--</li>-->
                    <li class="userInfo dropDown dropDown_hover">
                        <?php if(!empty(app('session')->get('member'))): ?>
                        <a href="javascript:;"><img class="avatar radius" src="/static/image/blog/face3.jpg" alt="丶似浅 "> <?php if(!empty(app('session')->get('member.nickname'))): ?><?php echo htmlentities(app('session')->get('member.nickname')); else: ?><?php echo htmlentities(app('session')->get('member.username')); endif; ?></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="<?php echo url('@blog/member'); ?>">个人中心</a></li>
                            <li><a id="loginOut">退出登录</a></li>
                        </ul>
                        <?php else: ?>
                        <a href="<?php echo url('@blog/login'); ?>" onclick="layer.msg('正在登入', {icon:16, shade: 0.1, time:0})">
                            <button class="btn btn-primary radius">会员登录</button>
                        </a>
                        <?php endif; ?>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>



<h1><a href="http://wiki.opensns.qq.com/wiki/%E3%80%90QQ%E7%99%BB%E5%BD%95%E3%80%91Qzone_OAuth2.0%E7%AE%80%E4%BB%8B" target="_blank">官方wiki</a></h1>

<br><br>
<a href="#" onclick='toQzoneLogin()'><img src="/static/image/blog/Connect_logo_7.png"></a>
<br><br>
<a href="user/get_user_info.php"    target="_blank">获取用户信息</a>
<br><br>
<a href="share/add_share.html"      target="_blank">添加分享</a>
<br><br>
<a href="photo/list_album.php"      target="_blank">获取相册列表</a>
<br><br>
<a href="photo/add_album.html"      target="_blank">创建相册</a>
<br><br>
<a href="photo/upload_pic.php"     target="_blank">上传相片</a>
<br><br>
<a href="blog/add_blog.html"     target="_blank">发表日志</a>
<br><br>
<a href="topic/add_topic.html"     target="_blank">发表说说</a>
<br><br>
<a href="weibo/add_weibo.html"     target="_blank">发表微博</a>
<br><br>
<a href="check_fan/check_page_fans.php"     target="_blank">检查是否是认证空间的粉丝</a>
<br><br>
<a href="add_pic_t/add_pic_t.php"     target="_blank">发图片消息到微博</a>
<br><br>
<a href="get_info/get_info.php"     target="_blank">获取微博用户信息</a>
<br><br>
<a href="get_fanslist/get_fanslist.php"     target="_blank">获取用户的听众列表</a>
<br><br>
<a href="get_idollist/get_idollist.php"     target="_blank">获取用户的收听列表</a>
<br><br>
<a href="add_idol/add_idol.php"     target="_blank">收听腾讯微博上的用户</a>
<br><br>
<a href="get_tenpay_addr/get_tenpay_addr.php"     target="_blank">获取财付通用户的收货地址</a>



<footer class="footer mt-20">
    <div class="container-fluid" id="foot">
        <p><?php echo htmlentities((isset($SysInfo['BlogFooterName']) && ($SysInfo['BlogFooterName'] !== '')?$SysInfo['BlogFooterName']:'')); ?> <br>
            <a href="<?php echo htmlentities((isset($SysInfo['BeianUrl']) && ($SysInfo['BeianUrl'] !== '')?$SysInfo['BeianUrl']:'')); ?>" target="_blank"><?php echo htmlentities((isset($SysInfo['Beian']) && ($SysInfo['Beian'] !== '')?$SysInfo['Beian']:'')); ?></a><br>
        </p>
    </div>
</footer>


<script type="text/javascript" src="/static/plugs/jquery/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="/static/plugs/blog/layer/3.0/layer.js"></script>
<script type="text/javascript" src="/static/plugs/layui/layui.js"></script>
<script type="text/javascript" src="/static/plugs/blog/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/plugs/blog/pifu/pifu.js"></script>
<script type="text/javascript" src="/static/js/blog/common.js"></script>
<script type="text/javascript" src="/static/plugs/wangEditor-3.1.1/release/wangEditor.min.js"></script>
<script>
    $(function () {
        $(window).on("scroll", backToTopFun);
        backToTopFun();
    });

    /**
     * 退出登录
     */
    $("#loginOut").click(function () {
        $.get("<?php echo url('@blog/login/out'); ?>",
            function (res) {
                console.log(res);
                if (res.code == 0) {
                    layer.msg(res.msg, {icon: 1}, function () {
                        parent.location.reload();
                    });
                } else {
                    layer.msg(res.msg, {icon: 2});
                }
            })
        return false;
    });

    /**
     * 文章发表
     */
    $("#homeAdd").click(function () {
        if ("<?php echo htmlentities(app('session')->get('member.id')); ?>" == '') {
            layer.msg('请先登录系统再进行操作', {icon: 2}, function () {
                window.location.href = "<?php echo url('@blog/login'); ?>";
            });
        } else {
            window.location.href = "<?php echo url('@blog/article/add'); ?>";
        }
    });

    /**
     * 关键词搜索
     */
    $("#selectKwd").click(function () {
        layer.msg('功能暂未实现！', {icon: 2});
    });


</script>
<script type="text/javascript" src="/static/plugs/blog/jquery.SuperSlide/2.1.1/jquery.SuperSlide.min.js"></script>





</body>
</html>
