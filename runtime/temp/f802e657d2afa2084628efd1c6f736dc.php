<?php /*a:4:{s:61:"H:\phpStudy\WWW\99Blog\application\blog\view\index\index.html";i:1535520752;s:62:"H:\phpStudy\WWW\99Blog\application\blog\view\public\basic.html";i:1535079242;s:63:"H:\phpStudy\WWW\99Blog\application\blog\view\public\header.html";i:1535079242;s:63:"H:\phpStudy\WWW\99Blog\application\blog\view\public\footer.html";i:1534125330;}*/ ?>
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

    
<style>
    .layui-icon.layui-icon-praise:hover {
        /*color: #d33a39;*/
    }
</style>


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


<section class="container pt-20">
    <!--<div class="Huialert Huialert-info"><i class="Hui-iconfont">&#xe6a6;</i>成功状态提示</div>-->
    <!--left-->
    <div class="col-sm-9 col-md-9">
        <!--滚动图-->
        <div class="slider_main">
            <div class="slider">
                <div class="bd">
                    <ul>
                        <?php foreach($slider_list as $vo): ?>
                        <li><a href="<?php echo htmlentities($vo['href']); ?>" target="<?php echo htmlentities($vo['target']); ?>"><img src="<?php echo htmlentities($vo['image']); ?>"></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <ol class="hd cl dots">
                    <?php if(is_array($slider_list) || $slider_list instanceof \think\Collection || $slider_list instanceof \think\Paginator): $i = 0; $__LIST__ = $slider_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li><?php echo htmlentities($i); ?></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ol>
                <a class="slider-arrow prev" href="javascript:void(0)"></a>
                <a class="slider-arrow next" href="javascript:void(0)"></a>
            </div>
        </div>

        <div class="mt-20 bg-fff box-shadow radius mb-5">
            <div class="tab-category">
                <a href=""><strong class="current">最新发布</strong></a>
            </div>
        </div>
        <div class="art_content">
            <ul class="index_arc">

                <?php foreach($newest_article_list as $vo): ?>
                <li class="index_arc_item">
                    <a href="<?php echo url('@blog/article/details'); ?>?id=<?php echo htmlentities((isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:'')); ?>" class="pic" target="_blank">
                        <img class="lazyload" data-original="<?php echo htmlentities((isset($vo['cover_img']) && ($vo['cover_img'] !== '')?$vo['cover_img']:'')); ?>" alt="<?php echo htmlentities((isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:'')); ?>">
                    </a>
                    <h4 class="title">
                        <a href="<?php echo url('@blog/article/details'); ?>?id=<?php echo htmlentities((isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:'')); ?>" target="_blank"><?php echo htmlentities((isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:'')); ?></a>
                    </h4>
                    <div class="date_hits">
                        <span><?php echo htmlentities((isset($vo['memberInfo']['nickname']) && ($vo['memberInfo']['nickname'] !== '')?$vo['memberInfo']['nickname']:'')); ?></span>
                        <span><?php echo htmlentities((isset($vo['create_at']) && ($vo['create_at'] !== '')?$vo['create_at']:'')); ?></span>
                        <span><a href="<?php echo url('@blog/article'); ?>?category_id=<?php echo htmlentities((isset($vo['category_id']) && ($vo['category_id'] !== '')?$vo['category_id']:'')); ?>" target="_blank"><?php echo htmlentities((isset($vo['categoryInfo']['title']) && ($vo['categoryInfo']['title'] !== '')?$vo['categoryInfo']['title']:'')); ?></a></span>
                        <p class="hits"><i class="Hui-iconfont" title="点击量">&#xe6c1;</i> <?php echo htmlentities((isset($vo['clicks']) && ($vo['clicks'] !== '')?$vo['clicks']:'')); ?> °</p>
                        <p class="commonts"><i class="Hui-iconfont" title="评论"></i> <span class="cy_cmt_count"><?php echo htmlentities((isset($vo['comment_total']) && ($vo['comment_total'] !== '')?$vo['comment_total']:'')); ?></span></p>
                        <p class="praise"><i class="layui-icon layui-icon-praise" title="点赞"></i> <?php echo htmlentities((isset($vo['praise']) && ($vo['praise'] !== '')?$vo['praise']:'0')); ?> </p>
                    </div>
                    <div class="desc"><?php echo htmlentities((isset($vo['describe']) && ($vo['describe'] !== '')?$vo['describe']:'')); ?></div>
                </li>
                <?php endforeach; ?>

            </ul>
            <div class="text-c mb-20" id="moreBlog">
                <a class="btn  radius btn-block " href="<?php echo url('@blog/article'); ?>" target="_blank">点击加载更多</a>
                <!--<a class="btn  radius btn-block hidden" href="javascript:;">加载中……</a>-->
            </div>
        </div>
    </div>

    <!--right-->
    <div class="col-sm-3 col-md-3">

        <!--站点声明-->
        <div class="panel panel-default mb-20">
            <div class="panel-body">
                <i class="Hui-iconfont" style="float: left;">&#xe62f;&nbsp;</i>
                <div class="slideTxtBox">
                    <div class="bd">
                        <ul>
                            <?php foreach($notice_list as $vo): ?>
                            <li><a href="<?php echo htmlentities((isset($vo['href']) && ($vo['href'] !== '')?$vo['href']:'')); ?>" target="_blank"><?php echo htmlentities((isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:'')); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!--博主信息-->
        <div class="bg-fff box-shadow radius mb-20">
            <div class="tab-category">
                <a href=""><strong>站长信息</strong></a>
            </div>
            <div class="tab-category-item">
                <ul class="index_recd">
                    <li class="index_recd_item"><i class="Hui-iconfont">&#xe653;</i>姓名：<?php echo htmlentities((isset($blog_user_info['nickname']) && ($blog_user_info['nickname'] !== '')?$blog_user_info['nickname']:'')); ?></li>
                    <li class="index_recd_item"><i class="Hui-iconfont">&#xe70d;</i>职业：<?php echo htmlentities((isset($blog_user_info['job']) && ($blog_user_info['job'] !== '')?$blog_user_info['job']:'')); ?></li>
                    <li class="index_recd_item"><i class="Hui-iconfont">&#xe63b;</i>邮箱：<?php echo htmlentities((isset($blog_user_info['email']) && ($blog_user_info['email'] !== '')?$blog_user_info['email']:'')); ?></a></li>
                    <li class="index_recd_item"><i class="Hui-iconfont">&#xe671;</i>工作：<?php echo htmlentities((isset($blog_user_info['location']) && ($blog_user_info['location'] !== '')?$blog_user_info['location']:'')); ?></li>
                </ul>
            </div>
        </div>


        <!--热门推荐-->
        <div class="bg-fff box-shadow radius mb-20">
            <div class="tab-category">
                <a href=""><strong>推荐阅读</strong></a>
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

        <!--点击排行-->
        <div class="bg-fff box-shadow radius mb-20">
            <div class="tab-category">
                <a href=""><strong>点击排行</strong></a>
            </div>
            <div class="tab-category-item">
                <ul class="index_recd clickTop">

                    <?php foreach($click_ranking_list as $vo): ?>
                    <li>
                        <a href="<?php echo url('@blog/article/details'); ?>?id=<?php echo htmlentities((isset($vo['id']) && ($vo['id'] !== '')?$vo['id']:'')); ?>" target="_blank"><?php echo htmlentities((isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:'')); ?></a>
                        <p class="hits"><i class="Hui-iconfont" title="点击量">&#xe6c1;</i> <?php echo htmlentities((isset($vo['clicks']) && ($vo['clicks'] !== '')?$vo['clicks']:'')); ?>° </p>
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
                <div class="tags">
                    <?php foreach($tag_list as $vo): ?>
                    <a href="#"><?php echo htmlentities((isset($vo['tag_title']) && ($vo['tag_title'] !== '')?$vo['tag_title']:'')); ?></a>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
        <!--图片-->
        <div class="bg-fff box-shadow radius mb-20">
            <div class="tab-category">
                <a href=""><strong>扫我关注</strong></a>
            </div>
            <div class="tab-category-item">
                <img src="<?php echo (isset($BlogInfo['ScanFollow']) && ($BlogInfo['ScanFollow'] !== '')?$BlogInfo['ScanFollow']:'/static/temp/blog/gg.jpg'); ?>" class="img-responsive lazyload" alt="响应式图片">
            </div>
        </div>

        <!--最近访客-->
        <div class="bg-fff box-shadow radius mb-20">
            <div class="tab-category">
                <a href=""><strong>最近访客</strong></a>
            </div>
            <div class="panel-body">
                <ul class="recent">
                    <div class="item"><img src="/static/image/blog/40.jpg" alt=""></div>
                    <div class="item"><img src="/static/image/blog/40.jpg" alt=""></div>
                    <div class="item"><img src="/static/image/blog/40.jpg" alt=""></div>
                    <div class="item"><img src="/static/image/blog/40.jpg" alt=""></div>
                    <div class="item"><img src="/static/image/blog/40.jpg" alt=""></div>
                    <div class="item"><img src="/static/image/blog/40.jpg" alt=""></div>
                    <div class="item"><img src="/static/image/blog/40.jpg" alt=""></div>
                    <div class="item"><img src="/static/image/blog/40.jpg" alt=""></div>
                    <div class="item"><img src="/static/image/blog/40.jpg" alt=""></div>
                    <div class="item"><img src="/static/image/blog/40.jpg" alt=""></div>
                </ul>
            </div>
        </div>

        <!--友情链接-->
        <div class="bg-fff box-shadow radius mb-20">
            <div class="tab-category">
                <a href=""><strong>友情链接</strong></a>
            </div>
            <div class="tab-category-item">
                <?php foreach($website_list as $vo): ?>
                <span><i class="Hui-iconfont">&#xe6f1;</i><a href="<?php echo htmlentities((isset($vo['href']) && ($vo['href'] !== '')?$vo['href']:'#')); ?>" class="btn-link" target="_blank"> <?php echo htmlentities((isset($vo['website_name']) && ($vo['website_name'] !== '')?$vo['website_name']:'=')); ?></a></span>
                <?php endforeach; ?>
            </div>
        </div>

        <!--分享-->
        <div class="bg-fff box-shadow radius mb-20">
            <div class="tab-category">
                <a href=""><strong>站点分享</strong></a>
            </div>
            <div class="panel-body">
                <div class="bdsharebuttonbox Hui-share"><a href="#" class="bds_weixin Hui-iconfont" data-cmd="weixin" title="分享到微信">&#xe694;</a><a href="#" class="bds_qzone Hui-iconfont" data-cmd="qzone" title="分享到QQ空间">&#xe6c8;</a> <a href="#" class="bds_sqq Hui-iconfont" data-cmd="sqq" title="分享到QQ好友">&#xe67b;</a> <a href="#" class="bds_tsina Hui-iconfont" data-cmd="tsina" title="分享到新浪微博">&#xe6da;</a> <a href="#" class="bds_tqq Hui-iconfont" data-cmd="tqq" title="分享到腾讯微博">&#xe6d9;</a></div>
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


<script>
    $(function () {
//幻灯片
        jQuery(".slider_main .slider").slide({mainCell: ".bd ul", titCell: ".hd li", trigger: "mouseover", effect: "leftLoop", autoPlay: true, delayTime: 700, interTime: 2000, pnLoop: true, titOnClassName: "active"})
//tips
        jQuery(".slideTxtBox").slide({titCell: ".hd ul", mainCell: ".bd ul", autoPage: true, effect: "top", autoPlay: true});
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
