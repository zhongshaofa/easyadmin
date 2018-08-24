<?php /*a:4:{s:62:"H:\phpStudy\WWW\99Admin\application\blog\view\login\index.html";i:1534994818;s:63:"H:\phpStudy\WWW\99Admin\application\blog\view\public\basic.html";i:1534384095;s:64:"H:\phpStudy\WWW\99Admin\application\blog\view\public\header.html";i:1534408613;s:64:"H:\phpStudy\WWW\99Admin\application\blog\view\public\footer.html";i:1534125330;}*/ ?>
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

    
<link rel="stylesheet" type="text/css" href="/static/css/blog/login.css"/>


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



<div class="reg_main">
    <div class="reg_top">会员登录</div>
    <div class="reg_box">
        <form>
            <div class="main_left">
                <div class="item_box">
                    <div class="type">登录账户:</div>
                    <div class="value"><input type="text" name="username" id="username" class="txt"/></div>
                </div>

                <div class="item_box">
                    <div class="type">登录密码:</div>
                    <div class="value"><input type="password" name="password" id="password" class="txt"/></div>
                </div>

                <div class="item_box">
                    <div class="type">验证码:</div>
                    <div class="value"><input type="text" name="vercode" id="vercode" class="code" size="4" value=""/> &nbsp;<a href="javascript:;"> <img src='<?php echo captcha_src(); ?>' onclick="this.src='<?php echo captcha_src(); ?>?seed='+Math.random()"/></a></div>
                </div>
                <div class="item_box">
                    <div class="type"></div>
                    <div class="value"><input type="submit" id="loginBt" class="bt" value="   &nbsp;&nbsp;立即登录 &nbsp; &nbsp; "/></div>
                </div>

                <div class="item_box">
                    <div class="type">快捷登录</div>
                    <div class="value"><a href="#" id="loginQQ"><img src="/static/image/blog/Connect_logo_7.png"></a></div>
                </div>

            </div>
        </form>
        <div class="main_right">
            <div class="tips">我们诚挚的邀请您加入<br/>久久PHP社区！</div>
            <div class="box">
                还没有账户：<a href="<?php echo url('@blog/login/register'); ?>">马上注册</a><br/><br/>
            </div>
        </div>
    </div>
</div>


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


<script type="text/javascript" charset="utf-8"
        src="http://connect.qq.com/qc_jssdk.js"
        data-appid="APPID"
        data-redirecturi="REDIRECTURI"
></script>
<script>
    /**
     * 会员登录
     */
    $("#loginBt").click(function () {
        $.post("<?php echo url('@blog/login'); ?>", {
            username: $("#username").val(),
            password: $("#password").val(),
            vercode: $("#vercode").val(),
        }, function (res) {
            console.log(res);
            if (res.code == 0) {
                layer.msg(res.msg, {icon: 1}, function () {
                    window.location.href = "<?php echo url('@blog'); ?>";
                });
            } else {
                layer.msg(res.msg, {icon: 2});
            }
        })
        return false;
    });

    /**
     * QQ快捷登录
     */
    $("#loginQQ").click(function () {
        console.log('QQ快捷登录');
        window.location.href="<?php echo url('@blog/oauth'); ?>";
        // var A = window.open("oauth/index.html", "TencentLogin", "width=450,height=320,menubar=0,scrollbars=1,resizable=1,status=1,titlebar=0,toolbar=0,location=1");
        return false;
    });
</script>


</body>
</html>
