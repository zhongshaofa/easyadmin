<?php /*a:5:{s:66:"H:\phpStudy\WWW\99Admin\application\blog\view\artitle\details.html";i:1533984402;s:63:"H:\phpStudy\WWW\99Admin\application\blog\view\public\basic.html";i:1533973659;s:64:"H:\phpStudy\WWW\99Admin\application\blog\view\public\header.html";i:1533957240;s:61:"H:\phpStudy\WWW\99Admin\application\blog\view\public\nav.html";i:1533957065;s:64:"H:\phpStudy\WWW\99Admin\application\blog\view\public\footer.html";i:1533786419;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo htmlentities((isset($title) && ($title !== '')?$title:'久久PHP社区')); ?></title>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="keywords" content="久久PHP社区">
    <meta name="description" content="久久PHP博客网站。">
    <LINK rel="Bookmark" href="favicon.ico" >
    <LINK rel="Shortcut Icon" href="favicon.ico" />
    <link rel="stylesheet" type="text/css" href="/static/plugs/blog/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/static/plugs/blog/Hui-iconfont/1.0.8/iconfont.min.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/blog/common.css" />
    <link rel="stylesheet" type="text/css" href="/static/plugs/blog/pifu/pifu.css" />
    <style>
        .header-menu:hover{
            font-weight: bold;
            color: #000000;
        }
    </style>
    
<link rel="stylesheet" type="text/css" href="/static/plugs/blog/wangEditor/css/wangEditor.min.css">


    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } function showSide(){$('.navbar-nav').toggle();}</script>
</head>
<body>


<header class="navbar-wrapper">
    <div class="navbar navbar-fixed-top">
        <div class="container cl">
            <a class="navbar-logo hidden-xs" href="<?php echo url('@blog'); ?>">
                <img class="logo" src="/static/image/blog/logo.png" alt="久久PHP社区" />
            </a>
            <!--<a class="logo navbar-logo-m visible-xs" href="<?php echo url('@blog'); ?>">久久PHP社区</a>-->
            <!--<a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:void(0);" onclick="showSide();">&#xe667;</a>-->
            <nav class="nav navbar-nav nav-collapse w_menu" role="navigation">
                <ul class="cl">
                    <li class="active"> <a class="header-menu" href="<?php echo url('@blog'); ?>">首页</a> </li>
                    <li> <a class="header-menu" href="about.html">关于我</a> </li>
                    <li> <a class="header-menu" href="mood.html">碎言碎语</a> </li>
                    <li> <a class="header-menu" href="article.html">学无止尽</a></li>
                    <li> <a class="header-menu" href="board.html">留言板</a> </li>
                </ul>
            </nav>
            <nav class="navbar-nav navbar-userbar hidden-xs hidden-sm " style="top: 0;">
                <ul class="cl">
                    <li class="userInfo dropDown dropDown_hover">
                        <!--<a href="javascript:;" ><img class="avatar radius" src="img/40.jpg" alt="丶似浅 "></a>-->
                        <!--<ul class="dropDown-menu menu radius box-shadow">-->
                            <!--<li><a href="/app/loginOut">退出</a></li>-->
                        <!--</ul>-->
                        <a href="/app/qq" onclick="layer.msg('正在通过QQ登入', {icon:16, shade: 0.1, time:0})" ><img class="avatar size-S" src="/static/image/blog/qq.jpg" title="登入">登入</a>
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
                        <p class="last">上一篇：<a href="<?php echo url('@blog/artitle/details'); ?>?id=<?php echo htmlentities((isset($last_artitle['id']) && ($last_artitle['id'] !== '')?$last_artitle['id']:'')); ?>"><?php echo htmlentities((isset($last_artitle['title']) && ($last_artitle['title'] !== '')?$last_artitle['title']:'')); ?></a></p>
                        <p class="next">下一篇：<a href="<?php echo url('@blog/artitle/details'); ?>?id=<?php echo htmlentities((isset($next_artitle['id']) && ($next_artitle['id'] !== '')?$next_artitle['id']:'')); ?>"><?php echo htmlentities((isset($next_artitle['title']) && ($next_artitle['title'] !== '')?$next_artitle['title']:'')); ?></a></p>
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
                                                <a class="comment-author" href="#"><?php echo htmlentities((isset($vo['memberInfo']['nickname']) && ($vo['memberInfo']['nickname'] !== '')?$vo['memberInfo']['nickname']:'')); ?></a>
                                                <time class="f-r"><?php echo htmlentities((isset($vo['memberInfo']['create_at']) && ($vo['memberInfo']['create_at'] !== '')?$vo['memberInfo']['create_at']:'')); ?></time>
                                            </div>
                                        </header>
                                        <div class="comment-body"><p> <?php echo htmlentities((isset($vo['content']) && ($vo['content'] !== '')?$vo['content']:'')); ?></p></div>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>

                        </div>
                        <div class="line"></div>
                        <!--用于评论-->
                        <div class="mt-20" id="ct">
                            <div id="err" class="Huialert Huialert-danger hidden radius">成功状态提示</div>
                            <textarea id="textarea1" name="comment" style="height:200px;" placeholder="看完不留一发？"> </textarea>
                            <div class="text-r mt-10">
                                <button onclick="getPlainTxt()" class="btn btn-primary radius"> 发表评论</button>
                            </div>
                        </div>
                        <!--用于回复-->
                        <div class="comment hidden mt-20">
                            <div id="err2" class="Huialert Huialert-danger hidden radius">成功状态提示</div>
                            <textarea class="textarea" style="height:100px;"> </textarea>
                            <button onclick="hf(this);" type="button" class="btn btn-primary radius mt-10">回复</button>
                            <a class="cancelReply f-r mt-10">取消回复</a>
                        </div>

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
                            <a href="<?php echo url('@blog/artitle/details'); ?>?id=<?php echo htmlentities((isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:'')); ?>"><?php echo htmlentities((isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:'')); ?></a>
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
                    <img data-original="/static/temp/blog/gg.jpg" class="img-responsive lazyload" alt="响应式图片">
                </div>
            </div>

        </div>
    </div>

</section>


<footer class="footer mt-20">
    <div class="container-fluid" id="foot">
        <p>Copyright &copy; 2016-2017 www.wfyvv.com <br>
            <a href="#" target="_blank">皖ICP备17002922号</a> 更多模板：<a href="http://www.mycodes.net/" target="_blank">源码之家</a><br>
        </p>
    </div>
</footer>

<script type="text/javascript" src="/static/plugs/jquery/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="/static/plugs/blog/layer/3.0/layer.js"></script>
<script type="text/javascript" src="/static/plugs/blog/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/plugs/blog/pifu/pifu.js"></script>
<script type="text/javascript" src="/static/js/blog/common.js"></script>
<script> $(function(){ $(window).on("scroll",backToTopFun); backToTopFun(); }); </script>
<script type="text/javascript" src="/static/plugs/blog/jquery.SuperSlide/2.1.1/jquery.SuperSlide.min.js"></script>


<script type="text/javascript" src="/static/plugs/blog/wangEditor/js/wangEditor.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("img.lazyload").lazyload({failurelimit : 3});
        wangEditor.config.printLog = false;
        var editor1 = new wangEditor('textarea1');
        editor1.config.menus = ['insertcode', 'quote', 'bold', '|', 'img', 'emotion', '|', 'undo', 'fullscreen'];
        editor1.config.emotions = { 'default': { title: '老王表情', data: '/static/plugs/blog/wangEditor/emotions1.data'}, 'default2': { title: '老王心情', data: '/static/plugs/blog/wangEditor/emotions3.data'}, 'default3': { title: '顶一顶', data: '/static/plugs/blog/wangEditor/emotions2.data'}};
        editor1.config.uploadImgServer = '/upload';
        editor1.create();

        //show reply
        $(".hf").click(function () {
            pId = $(this).attr("name");
            $(this).parents(".commentList").find(".cancelReply").trigger("click");
            $(this).parent(".comment-body").append($(".comment").clone(true));
            $(this).parent(".comment-body").find(".comment").removeClass("hidden");
            $(this).hide();
        });
        //cancel reply
        $(".cancelReply").on('click',function () {
            $(this).parents(".comment-body").find(".hf").show();
            $(this).parents(".comment-body").find(".comment").remove();
        });
    });
</script>


</body>
</html>
