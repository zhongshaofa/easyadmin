<?php /*a:5:{s:65:"H:\phpStudy\WWW\99Blog\application\blog\view\article\details.html";i:1534301097;s:62:"H:\phpStudy\WWW\99Blog\application\blog\view\public\basic.html";i:1535079242;s:63:"H:\phpStudy\WWW\99Blog\application\blog\view\public\header.html";i:1535079242;s:60:"H:\phpStudy\WWW\99Blog\application\blog\view\public\nav.html";i:1533957065;s:63:"H:\phpStudy\WWW\99Blog\application\blog\view\public\footer.html";i:1534125330;}*/ ?>
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
                        <a href="javascript:;"><img class="avatar radius" src="<?php if(!empty(app('session')->get('member.head_img'))): ?><?php echo htmlentities(app('session')->get('member.head_img')); else: ?>/static/image/blog/face3.jpg<?php endif; ?>" alt="个人头像"> <?php if(!empty(app('session')->get('member.nickname'))): ?><?php echo htmlentities(app('session')->get('member.nickname')); else: ?><?php echo htmlentities(app('session')->get('member.username')); endif; ?></a>
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
<section class="container pt-20">

    <div class="row w_main_row">


        <div class="col-lg-9 col-md-9 w_main_left">
            <div class="panel panel-default  mb-20">
                <div class="panel-body pt-10 pb-10">
                    <h2 class="c_titile"><?php echo htmlentities((isset($details['title']) && ($details['title'] !== '')?$details['title']:'')); ?></h2>
                    <p class="box_c"><span class="d_time">发布时间：<?php echo htmlentities((isset($details['create_at']) && ($details['create_at'] !== '')?$details['create_at']:'')); ?></span><span>作者：<a><?php echo htmlentities((isset($details['nickname']) && ($details['nickname'] !== '')?$details['nickname']:'')); ?></a></span><span>阅读量：<?php echo htmlentities((isset($details['clicks']) && ($details['clicks'] !== '')?$details['clicks']:'')); ?></span></p>
                    <ul class="infos">
                        <?php echo (isset($details['content']) && ($details['content'] !== '')?$details['content']:''); ?>
                    </ul>

                    <div class="keybq">
                        <p><span>标签</span>：
                            <?php foreach($tag_list as $vo): ?>
                            <a class="label label-default"><?php echo htmlentities((isset($vo['tagInfo']['tag_title']) && ($vo['tagInfo']['tag_title'] !== '')?$vo['tagInfo']['tag_title']:'')); ?></a>
                            <?php endforeach; ?>
                    </div>

                    <div class="nextinfo">
                        <p class="last">上一篇：<a href="<?php echo url('@blog/article/details'); ?>?id=<?php echo htmlentities((isset($last_article['id']) && ($last_article['id'] !== '')?$last_article['id']:'')); ?>"><?php echo htmlentities($last_article['title']); ?></a></p>
                        <p class="next">下一篇：<a href="<?php echo url('@blog/article/details'); ?>?id=<?php echo htmlentities((isset($next_article['id']) && ($next_article['id'] !== '')?$next_article['id']:'')); ?>"><?php echo htmlentities($next_article['title']); ?></a></p>
                    </div>

                </div>
            </div>

            <div class="panel panel-default  mb-20">
                <div class="tab-category">
                    <a href=""><strong>评论区</strong></a>
                </div>
                <div class="panel-body">
                    <div class="panel-body" style="margin: 0 3%;">
                        <div class="mb-20">
                            <ul class="commentList">
                                <?php foreach($article_comment_list as $vo): ?>
                                <li class="item cl"><a href="#"><i class="avatar size-L radius"><img alt="" src="<?php echo htmlentities((isset($vo['memberInfo']['head_img']) && ($vo['memberInfo']['head_img'] !== '')?$vo['memberInfo']['head_img']:'')); ?>"></i></a>
                                    <div class="comment-main">
                                        <header class="comment-header">
                                            <div class="comment-meta">
                                                <a class="comment-author" href="#"><?php if(!empty($vo['memberInfo']['nickname'])): ?><?php echo htmlentities((isset($vo['memberInfo']['nickname']) && ($vo['memberInfo']['nickname'] !== '')?$vo['memberInfo']['nickname']:'')); else: ?><?php echo htmlentities((isset($vo['memberInfo']['username']) && ($vo['memberInfo']['username'] !== '')?$vo['memberInfo']['username']:'')); endif; ?></a>
                                                <time class="f-r">评论时间： <?php echo htmlentities((isset($vo['create_at']) && ($vo['create_at'] !== '')?$vo['create_at']:'')); ?></time>
                                            </div>
                                        </header>
                                        <div class="comment-body"><p> <?php echo (isset($vo['content']) && ($vo['content'] !== '')?$vo['content']:''); ?></p></div>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>

                        </div>
                        <div class="line"></div>
                        <!--用于评论-->
                        <div class="mt-20" id="ct">
                            <div id="err" class="Huialert Huialert-danger hidden radius">成功状态提示</div>
                            <!--<textarea id="textarea1" name="comment" style="height:200px;" placeholder="看完不留一发？"> </textarea>-->
                            <div id="editor">
                            </div>
                            <div class="text-r mt-10">
                                <button id="addComment" class="btn btn-primary radius"> 发表评论</button>
                            </div>
                        </div>
                        <!---->
                        <!--&lt;!&ndash;用于回复&ndash;&gt;-->
                        <!--<div class="comment hidden mt-20">-->
                        <!--<div id="err2" class="Huialert Huialert-danger hidden radius">成功状态提示</div>-->
                        <!--<textarea class="textarea" style="height:100px;"> </textarea>-->
                        <!--<button onclick="hf(this);" type="button" class="btn btn-primary radius mt-10">回复</button>-->
                        <!--<a class="cancelReply f-r mt-10">取消回复</a>-->
                        <!--</div>-->

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3">
            <!--热门推荐-->
            <div class="bg-fff box-shadow radius mb-20">
                <div class="tab-category">
                    <a href=""><strong>推荐阅读</strong></a>
                </div>
                <div class="tab-category-item">
                    <ul class="index_recd">
                        <?php foreach($recommend_list as $vo): ?>
                        <li>
                            <a href="<?php echo url('@blog/article/details'); ?>?id=<?php echo htmlentities((isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:'')); ?>"><?php echo htmlentities((isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:'')); ?></a>
                            <p class="hits"><i class="Hui-iconfont" title="点击量">&#xe622;</i> <?php echo htmlentities((isset($vo['clicks']) && ($vo['clicks'] !== '')?$vo['clicks']:'')); ?>° </p>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <!--图片-->
            <div class="bg-fff box-shadow radius mb-20">
                <div class="tab-category">
                    <a href=""><strong>扫我关注</strong></a>
                </div>
                <div class="tab-category-item">
                    <img src="/static/image/blog/weixin.jpg" class="img-responsive lazyload" alt="响应式图片">
                </div>
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
    layui.use(['form', 'layer'], function () {
        var form = layui.form
        layer = parent.layer === undefined ? layui.layer : top.layer,
            $ = layui.jquery;

        $(function () {
            $(window).on("scroll", backToTopFun);
            backToTopFun();
        });

        /**
         * 退出登录
         */
        $("#loginOut").click(function () {
            //弹出loading
            var index = top.layer.msg('数据提交中，请稍候', {icon: 16, time: false, shade: 0.8});
            $.get("<?php echo url('@blog/login/out'); ?>",
                function (res) {
                    layer.closeAll('loading');
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

    });
</script>
<script type="text/javascript" src="/static/plugs/blog/jquery.SuperSlide/2.1.1/jquery.SuperSlide.min.js"></script>


<script type="text/javascript">
    var E = window.wangEditor
    var editor = new E('#editor')
    editor.customConfig.menus = [
        'head',
        'bold',
        'italic',
        'underline',
        'foreColor',
        'backColor',
        'image',
        'emoticon',
        'code',
        'undo',
        'redo'
    ]
    editor.customConfig.uploadImgServer = '/upload'
    editor.create()

    //新增评论
    $("#addComment").click(function () {
        if (editor.txt.text() == '') {
            layer.msg('评论信息不可为空！', {icon: 2});
            return false;
        }
        $.post("<?php echo url('@blog/article/add_comment'); ?>", {
            article_id: "<?php echo htmlentities((isset($details['id']) && ($details['id'] !== '')?$details['id']:'')); ?>",
            member_id: "<?php echo htmlentities(app('session')->get('member.id')); ?>",
            content: editor.txt.html(),
        }, function (res) {
            console.log(res);
            if (res.code == 0) {
                layer.msg(res.msg, {icon: 1}, function () {
                    parent.location.reload();
                });
            } else {
                layer.msg(res.msg, {icon: 2});
            }
            return false;
        })
    });

</script>


</body>
</html>
