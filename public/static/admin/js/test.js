/**
 * js 引入示例
 */

// 此处 require 引入外部js ,例如echarts和jq插件
require(["echarts", "echarts-theme"], function (echarts, undefined) {

    // 此处引入layui内部自定义插件例如layuimini-tool
    layui.extend({
        tool: "plugs/layuimini/layuimini-tool",
    });

    layui.define(['element', 'layer', 'tool'], function (exports) {
        var $ = layui.jquery,
            element = layui.element,
            layer = layui.layer,
            tool = layui.tool;

        var controller = new function () {

            this.index = function () {

            };

        };

        exports("controller", controller);
    });

});