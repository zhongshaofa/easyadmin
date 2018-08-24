<?php /*a:4:{s:63:"H:\phpStudy\WWW\99Admin\application\blog\view\search\index.html";i:1534409070;s:63:"H:\phpStudy\WWW\99Admin\application\blog\view\public\basic.html";i:1534384095;s:64:"H:\phpStudy\WWW\99Admin\application\blog\view\public\header.html";i:1534408613;s:64:"H:\phpStudy\WWW\99Admin\application\blog\view\public\footer.html";i:1534125330;}*/ ?>
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

    
<link rel="shortcut icon" href="/favicon.ico" mce_href="/favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" href="/static/plugs/layui/css/layui.css" media="all"/>
<link rel="stylesheet" type="text/css" href="/static/css/blog/search.css"/>
<!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
<!--[if lt IE 9]>
<script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
<script src="https://cdn.staticfile.o<img src=" http://img.php.cn/upload/article/000/000/003/5b596217c2850304.jpg">rg/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->


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


<div class='php-search-header'>
    <div class="layui-main">
        <div class="layui-input-block">
            <i class="layui-icon icon icon-search">&#xe615;</i>
            <form action="<?php echo url('@blog/search'); ?>" method="get" target="_blank">
                <input type="text" id="word" name="word" value="<?php echo htmlentities((app('request')->get('word') ?: '')); ?>" placeholder="请输入标题" class="layui-input left">
                <button class="layui-btn right" id="search_word">搜索</button>
            </form>
        </div>
        <ul class='hot-search layui-clear'>
            <li>热门搜索：</li>
            <li><a href='?word=PHP'>PHP</a></li>
            <li><a href='?word=MySQL'> MySQL</a></li>
            <li><a href='?word=jquery'> jquery</a></li>
            <li><a href='?word=HTML'> HTML</a></li>
            <li><a href='?word=CSS'> CSS</a></li>
        </ul>
    </div>
</div>


<div class="layui-main" style="min-height: 500px;">
    <div class="layui-row php-search">
        <div class='nav-sel'>
            <ul>
                <li class='on'>全站</li>
                <?php foreach($category_list as $vo): ?>
                <li><a href='#'><?php echo htmlentities($vo['title']); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class='search-related'>
            共找到 <?php echo htmlentities((isset($search_count) && ($search_count !== '')?$search_count:0)); ?> 个相关内容
        </div>


        <!--搜索结果开始-->
        <?php foreach($search_list as $vo): ?>
        <div class='course-item'>
            <a href="<?php echo url('@blog/article/details'); ?>?id=<?php echo htmlentities((isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:'')); ?>" target="_blank" title="<?php echo htmlentities((isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:'')); ?>" class='course-img'><img src="<?php echo htmlentities((isset($vo['cover_img']) && ($vo['cover_img'] !== '')?$vo['cover_img']:'')); ?>"></a>
            <div class='course-detail'>
                <a href="<?php echo url('@blog/article/details'); ?>?id=<?php echo htmlentities((isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:'')); ?>" target="_blank" class='title'><span class="course-color"><?php echo htmlentities((isset($vo['categoryInfo']['title']) && ($vo['categoryInfo']['title'] !== '')?$vo['categoryInfo']['title']:'')); ?></span><?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?></a>
                <p class='course-classify'>
                    <span><i class="layui-icon" title="创作人">&#xe612;</i>  <?php echo htmlentities((isset($vo['memberInfo']['nickname']) && ($vo['memberInfo']['nickname'] !== '')?$vo['memberInfo']['nickname']:'')); ?></span>
                    <span><i class="layui-icon" title="创建时间">&#xe637;</i>  <?php echo htmlentities((isset($vo['create_at']) && ($vo['create_at'] !== '')?$vo['create_at']:'')); ?></span>
                    <span class="info-list"><i class="layui-icon" title="点击量">&#xe756;</i>  <?php echo htmlentities((isset($vo['clicks']) && ($vo['clicks'] !== '')?$vo['clicks']:'')); ?></span>
                    <span><i class="layui-icon" title="评论">&#xe611;</i>  <?php echo htmlentities((isset($vo['comment_total']) && ($vo['comment_total'] !== '')?$vo['comment_total']:'')); ?></span>
                </p>
                <div class='course-'><?php echo htmlentities((isset($vo['describe']) && ($vo['describe'] !== '')?$vo['describe']:'')); ?></div>
            </div>
        </div>
        <?php endforeach; ?>

        <div class='more'>
            <?php echo $search_list; ?>
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


<script src="//apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="/static/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/global.min.js?4.1.3">
    <
    script >
    (function () {
        var bp = document.createElement('script');
        var curProtocol = window.location.protocol.split(':')[0];
        if (curProtocol === 'https') {
            bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
        }
        else {
            bp.src = 'http://push.zhanzhang.baidu.com/push.js';
        }
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(bp, s);
    })();
</script>
<script>var _hmt = _hmt || [];
(function () {
    var hm = document.createElement("script");
    hm.src = "//hm.baidu.com/hm.js?8cc45d54c337ca616c34b1cf747da91c";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(hm, s);
})();
</script>
<script>
    layui.use(['form', 'element'], function () {
        var element = layui.element;
        var form = layui.form;
        //建造实例
    });
</script>


</body>
</html>
