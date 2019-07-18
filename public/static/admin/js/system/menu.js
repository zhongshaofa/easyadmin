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
                treeSpid: -1,
                treeIdName: 'authorityId',
                treePidName: 'parentId',
                elem: '#munu-table',
                url: '/admin/system.menu/index?type=ajax',
                page: false,
                cols: [[
                    {type: 'numbers'},
                    {field: 'authorityName', minWidth: 200, title: '权限名称'},
                    {field: 'authority', title: '权限标识'},
                    {field: 'menuUrl', title: '菜单url'},
                    {field: 'orderNumber', width: 80, align: 'center', title: '排序号'},
                    {
                        field: 'isMenu', width: 80, align: 'center', templet: function (d) {
                            if (d.isMenu == 1) {
                                return '<span class="layui-badge layui-bg-gray">按钮</span>';
                            }
                            if (d.parentId == -1) {
                                return '<span class="layui-badge layui-bg-blue">目录</span>';
                            } else {
                                return '<span class="layui-badge-rim">菜单</span>';
                            }
                        }, title: '类型'
                    },
                    {templet: '#auth-state', width: 120, align: 'center', title: '操作'}
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