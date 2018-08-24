<?php /*a:5:{s:64:"H:\phpStudy\WWW\99Admin\application\blog\view\article\index.html";i:1534330587;s:63:"H:\phpStudy\WWW\99Admin\application\blog\view\public\basic.html";i:1534384095;s:64:"H:\phpStudy\WWW\99Admin\application\blog\view\public\header.html";i:1534408613;s:61:"H:\phpStudy\WWW\99Admin\application\blog\view\public\nav.html";i:1533957065;s:64:"H:\phpStudy\WWW\99Admin\application\blog\view\public\footer.html";i:1534125330;}*/ ?>
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

    
<!--<link rel="stylesheet" type="text/css" href="/static/plugs/bootstrap-3.3.7/css/bootstrap.min.css" />-->


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
<section class="container">
    <!--left-->
    <div class="col-sm-9 col-md-9 mt-20">
        <!--article list-->
        <ul class="index_arc">

            <?php foreach($article_list as $vo): ?>
            <li class="index_arc_item">
                <a href="<?php echo url('@blog/article/details'); ?>?id=<?php echo htmlentities((isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:'')); ?>" class="pic">
                    <img class="lazyload" data-original="<?php echo htmlentities((isset($vo['cover_img']) && ($vo['cover_img'] !== '')?$vo['cover_img']:'')); ?>" alt="<?php echo htmlentities((isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:'')); ?>">
                </a>
                <h4 class="title">
                    <a href="<?php echo url('@blog/article/details'); ?>?id=<?php echo htmlentities((isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:'')); ?>"><?php echo htmlentities((isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:'')); ?></a>
                </h4>
                <div class="date_hits">
                    <span><?php echo htmlentities((isset($vo['memberInfo']['nickname']) && ($vo['memberInfo']['nickname'] !== '')?$vo['memberInfo']['nickname']:'')); ?></span>
                    <span><?php echo htmlentities((isset($vo['create_at']) && ($vo['create_at'] !== '')?$vo['create_at']:'')); ?></span>
                    <span><a href="<?php echo url('@blog/article'); ?>?category_id=<?php echo htmlentities((isset($vo['category_id']) && ($vo['category_id'] !== '')?$vo['category_id']:'')); ?>"><?php echo htmlentities((isset($vo['categoryInfo']['title']) && ($vo['categoryInfo']['title'] !== '')?$vo['categoryInfo']['title']:'')); ?></a></span>
                    <p class="hits"><i class="Hui-iconfont" title="点击量">&#xe6c1;</i> <?php echo htmlentities((isset($vo['clicks']) && ($vo['clicks'] !== '')?$vo['clicks']:'')); ?> °</p>
                    <p class="commonts"><i class="Hui-iconfont" title="评论"></i> <span class="cy_cmt_count"><?php echo htmlentities((isset($vo['comment_total']) && ($vo['comment_total'] !== '')?$vo['comment_total']:'')); ?></span></p>
                </div>
                <div class="desc"><?php echo htmlentities((isset($vo['describe']) && ($vo['describe'] !== '')?$vo['describe']:'')); ?></div>
            </li>
            <?php endforeach; ?>

        </ul>
        <div class="text-c mb-20" id="moreBlog">
            <?php echo $article_list; ?>
            <!--<a class="btn  radius btn-block " href="javascript:;" onclick="moreBlog('${blogType.id}','${tag.name}');">点击加载更多</a>-->
            <!--<a class="btn  radius btn-block hidden" href="javascript:;">加载中……</a>-->
        </div>
    </div>

    <!--right-->
    <div class="col-sm-3 col-md-3 mt-20">

        <!--导航-->
        <div class="panel panel-primary mb-20">
            <div class="tab-category">
                <a href=""><strong>教程分类</strong></a>
            </div>
            <div class="panel-body">
                <?php foreach($category_list as $vo): ?>
                <a href="<?php echo url('@blog/article'); ?>?category_id=<?php echo htmlentities((isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:'')); ?>" target="_blank">
                    <input class="btn <?php if($vo['id']==$current_cotegory['id']): ?>btn-primary<?php else: ?>btn-primary-outline<?php endif; ?> radius nav-btn" type="button" value="<?php echo htmlentities((isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:'')); ?>">
                </a>
                <?php endforeach; ?>
            </div>
        </div>

        <!--热门推荐-->
        <div class="bg-fff box-shadow radius mb-20">
            <div class="tab-category">
                <a href=""><strong>热门推荐</strong></a>
            </div>
            <div class="tab-category-item">
                <ul class="index_recd">
                    <?php foreach($recommend_list as $vo): ?>
                    <li>
                        <a href="<?php echo url('@blog/article/details'); ?>?id=<?php echo htmlentities((isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:'')); ?>" target="_blank"><?php echo htmlentities((isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:'')); ?></a>
                        <p class="hits"><i class="Hui-iconfont" title="点击量">&#xe622;</i> <?php echo htmlentities((isset($vo['clicks']) && ($vo['clicks'] !== '')?$vo['clicks']:'')); ?>° </p>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <!--标签-->
        <div class="bg-fff box-shadow radius mb-20">
            <div class="tab-category">
                <a href=""><strong>标签云</strong></a>
            </div>
            <div class="tab-category-item">
                <div class="tags"><a href="http://www.h-ui.net/">H-ui前端框架</a> <a href="http://www.h-ui.net/websafecolors.shtml">Web安全色</a> <a href="http://www.h-ui.net/Hui-4.4-Unslider.shtml">jQuery轮播插件</a> <a href="http://idc.likejianzhan.com/vhost/korea_hosting.php">韩国云虚拟主机</a> <a href="http://www.h-ui.net/bug.shtml">IEbug</a> <a href="http://www.h-ui.net/site.shtml">IT网址导航</a> <a href="http://www.h-ui.net/icon/index.shtml">网站常用小图标</a> <a href="http://www.h-ui.net/tools/jsformat.shtml">web工具箱</a> <a href="http://www.h-ui.net/bg/index.shtml">网站常用背景素材</a> <a href="http://www.h-ui.net/yuedu/chm.shtml">H-ui阅读</a> <a href="http://www.h-ui.net/easydialog-v2.0/index.html">弹出层插件</a> <a href="http://www.h-ui.net/SuperSlide2.1/demo.html">SuperSlide插件</a> <a href="http://www.h-ui.net/TouchSlide1.1/demo.html">TouchSlide</a></div>
            </div>
        </div>
    </div>

</section>


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


<script>
    $(function () {
//标签
        $(".tags a").each(function () {
            var x = 9;
            var y = 0;
            var rand = parseInt(Math.random() * (x - y + 1) + y);
            $(this).addClass("tags" + rand)
        });

        $("img.lazyload").lazyload({failurelimit: 3});
    });

</script>


</body>
</html>
