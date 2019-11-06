require.config({
    urlArgs: "v=" + (new Date().getTime()),
    baseUrl: "/static/",
    paths: {
        "layuiall": ["plugs/layui-v2.5.4/layui.all"],
        "layui": ["plugs/layui-v2.5.4/layui"],
        "layuimini": ["plugs/lay-module/layuimini/layuimini"],
        "echarts": ["plugs/echarts/echarts.min"],
        "echarts-theme": ["plugs/echarts/echarts-theme"],
        "jquery": ["plugs/jquery-3.4.1/jquery-3.4.1.min"],
        "jquery-particleground": ["plugs/jq-module/jquery.particleground.min"],
        "admin": ["plugs/easy-admin/admin"],
    }
});


// 初始化控制器对应的JS自动加载
if (AUTOLOAD_JS) {
    require([CONTROLLER_JS_PATH], function (Controller) {
        if (eval('Controller.' + ACTION)) {
            eval('Controller.' + ACTION + '()');
        }
    });
}