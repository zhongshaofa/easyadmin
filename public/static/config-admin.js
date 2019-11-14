var BASE_URL = document.scripts[document.scripts.length - 1].src.substring(0, document.scripts[document.scripts.length - 1].src.lastIndexOf("/") + 1);
window.BASE_URL = BASE_URL;
require.config({
    urlArgs: "v=" + (new Date().getTime()),
    baseUrl: BASE_URL,
    paths: {
        "jquery": ["plugs/jquery-3.4.1/jquery-3.4.1.min"],
        "jquery-particleground": ["plugs/jq-module/jquery.particleground.min"],
        "echarts": ["plugs/echarts/echarts.min"],
        "echarts-theme": ["plugs/echarts/echarts-theme"],
        "admin": ["plugs/easy-admin/admin"],
        "layuiall": ["plugs/layui-v2.5.5/layui.all"],
        "layui": ["plugs/layui-v2.5.5/layui"],
        "layuimini": ["plugs/lay-module/layuimini/layuimini"],
        "treetable": ["plugs/lay-module/treetable-lay/treetable"],
        "tableSelect": ["plugs/lay-module/tableSelect/tableSelect"],
        "iconPickerFa": ["plugs/lay-module/iconPicker/iconPickerFa"],
        "wangEditor": ["plugs/lay-module/wangEditor/wangEditor"],
        "autocomplete": ["plugs/lay-module/autocomplete/autocomplete"],
        "vue": ["plugs/vue-2.6.10/vue.min"],
    }
});

// 路径配置信息
var PATH_CONFIG = {
    iconLess: BASE_URL + "plugs/font-awesome-4.7.0/less/variables.less",
};
window.PATH_CONFIG = PATH_CONFIG;


// 初始化控制器对应的JS自动加载
if (AUTOLOAD_JS) {
    require([BASE_URL + CONTROLLER_JS_PATH], function (Controller) {
        if (eval('Controller.' + ACTION)) {
            eval('Controller.' + ACTION + '()');
        }
    });
}