define(["jquery", "admin", "treetable"], function ($, admin) {

    var Controller = {
        index: function () {
            var table = layui.table;
            var form = layui.form;
            var treetable = layui.treetable;

            var init = {
                index_url: 'system.menu/index',
                add_url: 'system.menu/add',
                del_url: 'system.menu/del',
                modify_url: 'system.menu/modify',
                table: 'currentTable',
            };

            // 渲染表格
            layer.load(2);
            treetable.render({
                treeColIndex: 1,
                treeSpid: 0,
                homdPid: 99999999,
                treeIdName: 'id',
                treePidName: 'pid',
                elem: '#currentTable',
                url: admin.url(init.index_url),
                toolbar: '#toolbar',
                page: false,
                cols: [[
                    {type: 'checkbox'},
                    {field: 'title', width: 250, title: '菜单名称'},
                    {
                        field: 'icon', width: 80, align: 'center', title: '图标', templet: function (d) {
                            return '<i class="' + d.icon + '"></i>';
                        }
                    },
                    {field: 'href', minWidth: 120, title: '菜单链接'},
                    {
                        field: 'is_home', width: 80, align: 'center', title: '类型', templet: function (d) {
                            if (d.pid == 99999999) {
                                return '<span class="layui-badge layui-bg-blue">首页</span>';
                            }
                            if (d.pid == 0) {
                                return '<span class="layui-badge layui-bg-gray">模块</span>';
                            } else {
                                return '<span class="layui-badge-rim">菜单</span>';
                            }
                        }
                    },
                    {
                        field: 'status', title: '性别', width: 85, unresize: true, filter: 'status', templet: function (d) {
                            return admin.table.switch(this, d)
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
                    {
                        width: 200, align: 'center', title: '操作', operat: [
                            {
                                class: 'layui-btn layui-btn-primary layui-btn-xs',
                                text: '编辑',
                                event: 'edit',
                                icon: 'fa fa-gears',
                                open: 'system.menu/edit',
                                extend: ""
                            },
                            {
                                class: 'layui-btn layui-btn-danger layui-btn-xs',
                                text: '删除',
                                event: 'del',
                                icon: 'fa fa-gears',
                                open: 'system.menu/edit',
                                extend: ""
                            }
                        ], templet: function (d) {
                            return admin.table.tool(this, d)
                        }
                    }
                ]],
                done: function () {
                    layer.closeAll('loading');
                }
            });

            $('#btn-expand').click(function () {
                treetable.expandAll('#currentTable');
            });

            $('#btn-fold').click(function () {
                treetable.foldAll('#currentTable');
            });

            //头工具栏事件
            table.on('toolbar(currentTable)', function (obj) {
                var checkStatus = table.checkStatus(obj.config.id);
                switch (obj.event) {
                    case 'deleteAll':
                        var data = checkStatus.data;
                        layer.alert(JSON.stringify(data));
                        break;
                }
            });

            // 监听开关切换
            admin.table.listenSwitch({
                filter: 'status',
                url: init.modify_url
            });

            //监听工具条
            table.on('tool(currentTable)', function (obj) {
                var data = obj.data;
                var layEvent = obj.event;

                if (layEvent === 'del') {
                    layer.msg('删除' + data.id);
                } else if (layEvent === 'edit') {
                    layer.msg('修改' + data.id);
                }
            });
        },

    };
    return Controller;
});