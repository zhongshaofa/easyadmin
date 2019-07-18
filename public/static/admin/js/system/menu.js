layui.config({
    base: '/static/plugs/lay-module/'
}).extend({
    treetable: "treetable-lay/treetable",
});
layui.define(['table', 'treetable'], function (exports) {
    var $ = layui.jquery;
    var table = layui.table;
    var treetable = layui.treetable;

    var controller = new function () {

        this.index = function () {
            treetable.render({
                treeColIndex: 1,
                treeSpid: 0,
                treeIdName: 'id',
                treePidName: 'pid',
                elem: '#munu-table',
                url: '/admin/system.menu/index?type=ajax',
                page: false,
                cols: [[
                    {type: 'numbers'},
                    {field: 'title', width: 250, title: '权限名称'},
                    {
                        field: 'icon', width: 80, align: 'center', title: '图标', templet: function (d) {
                            return '<i class="' + d.icon + '"></i>';
                        }
                    },
                    {field: 'href', minWidth: 120, title: '菜单url'},
                    {
                        field: 'is_home', width: 80, align: 'center', title: '类型', templet: function (d) {
                            if (d.is_home == 1) {
                                return '<span class="layui-badge layui-bg-blue">首页</span>';
                            }
                            if (d.pid == 0) {
                                return '<span class="layui-badge layui-bg-gray">模块</span>';
                            } else {
                                return '<span class="layui-badge-rim">菜单</span>';
                            }
                        }
                    },
                    {field: 'status', width: 80, align: 'center', title: '排序'},
                    {
                        field: 'status', width: 80, align: 'center', title: '状态', templet: function (d) {
                            if (d.status == 0) {
                                return '<span class="layui-badge layui-bg-gray">禁用</span>';
                            } else if (d.status == 1) {
                                return '<span class="layui-badge layui-bg-blue">启用</span>';
                            } else {
                                return '<span class=" layui-badge layui-bg-red">未知</span>';
                            }
                        }
                    },
                    {templet: '#auth-state', width: 200, align: 'center', title: '操作'}
                ]],
                done: function () {
                    layer.closeAll('loading');
                }
            });

            $('#btn-expand').click(function () {
                treetable.expandAll('#munu-table');
            });

            $('#btn-fold').click(function () {
                treetable.foldAll('#munu-table');
            });

            //监听工具条
            table.on('tool(munu-table)', function (obj) {
                var data = obj.data;
                var layEvent = obj.event;

                if (layEvent === 'del') {
                    layer.msg('删除' + data.id);
                } else if (layEvent === 'edit') {
                    layer.msg('修改' + data.id);
                }
            });
        };

    };

    exports("controller", controller);
});