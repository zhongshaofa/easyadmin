<?php /*a:5:{s:63:"H:\phpStudy\WWW\99Admin\application\blog\view\member\index.html";i:1534817900;s:63:"H:\phpStudy\WWW\99Admin\application\blog\view\public\basic.html";i:1534384095;s:64:"H:\phpStudy\WWW\99Admin\application\blog\view\public\header.html";i:1534408613;s:61:"H:\phpStudy\WWW\99Admin\application\blog\view\public\nav.html";i:1533957065;s:64:"H:\phpStudy\WWW\99Admin\application\blog\view\public\footer.html";i:1534125330;}*/ ?>
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

    
<link rel="stylesheet" type="text/css" href="/static/css/blog/member.css"/>


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


<!--导航条-->
<nav class="breadcrumb">
    <div class="container">
        <i class="Hui-iconfont">&#xe67f;</i><a href="<?php echo url('@blog'); ?>" class="c-primary">首页</a>
        <?php foreach($navMenu as $vo): ?>
        <span class="c-gray en">&gt;</span> <span class="c-gray"><?php echo htmlentities((isset($vo) && ($vo !== '')?$vo:'')); ?></span>
        <?php endforeach; ?>
    </div>
</nav>
<!-- 内容  开始-->
<div class="wrap">
    <div class="vip_cont c100 clearfix">
        <!--左边列表导航  开始-->
        <div class="fl vip_left vip_magLeft">
            <dl>
                <dt>信息管理</dt>
                <dd>
                    <p><a href="#" target="_blank">文章管理</a></p>
                    <p class="active"><a href="#" target="_blank">评论管理</a></p>
                </dd>
            </dl>
            <dl>
                <dt>我的账号</dt>
                <dd>
                    <p><a href="#" target="_blank">基本资料</a></p>
                    <p><a href="#" target="_blank">修改密码</a></p>
                </dd>
            </dl>
        </div>
        <!--左边列表导航  结束-->

        <!--右边列表内容  开始-->
        <div class="fr vip_right vip_magRight">
            <!--用户信息  开始 -->
            <div class="cus01">
                <div class="cusImg">
                    <img src="<?php echo htmlentities(app('session')->get('member.head_img')); ?>" title="更换头像" style="width:127px;height:127px;" />
                </div>
                <div class="cusName">
                    <p title="用户昵称">用户昵称：<?php if(!empty(app('session')->get('member.nickname'))): ?><?php echo htmlentities(app('session')->get('member.nickname')); else: ?>暂未设置昵称<?php endif; ?></p>
                    <span title="邮箱">邮箱：<?php echo htmlentities(app('session')->get('member.email')); ?></span>
                    <span class="bdTell">手机：<i></i><em><?php echo htmlentities(app('session')->get('member.phone')); ?></em></span>
                </div>
            </div>
            <ul class="cus02">
                <li>
                    <p><span>原创文章</span><a href="#" target="_blank">管理文章</a></p>
                    <span class="numbers"><font>5</font>篇</span>
                </li>
                <li>
                    <p><span>文章评论</span><a href="#" target="_blank">管理评论</a></p>
                    <span class="numbers"><font>6</font>条</span>
                </li>
                <li>
                    <p><span>个人资料</span><a href="#" target="_blank">去完善</a></p>
                    <script>
                        $(function(){
                            $('#myStat').circliful();
                        });
                    </script>
                    <span class="numbers mystat">
								<div id="myStat" data-dimension="60" data-text="85%" data-info="New Clients" data-width="10" data-fontsize="12" data-percent="85" data-fgcolor="#ff6561" data-bgcolor="#eee" data-fill="#FFF" class="circliful" style="width: 60px;"></div>
							</span>
                </li>
            </ul>
            <!--&lt;!&ndash; 用户信息  结束 &ndash;&gt;-->
            <!--<div class="cus03">-->
                <!--<div class="mess">-->
                    <!--<a href="#" target="_blank"><i></i>成为VIP会员或者加入鹰监测服务，可以优先排序，增加公司曝光等。>>点击了解详情</a>-->
                <!--</div>-->
            <!--</div>-->
        </div>
        <!--右边列表内容  结束-->
    </div>
</div>

<!-- 内容  结束-->



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
