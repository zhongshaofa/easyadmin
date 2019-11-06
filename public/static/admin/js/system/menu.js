define(["jquery", "admin","treetable"], function ($,admin) {

    var Controller = {
        index: function () {
            var table = layui.table;
            var treetable = layui.treetable;

            var init = {
                index_url: admin.url('system.menu/index'),
                add_url: 'course/booking/add',
                del_url: 'course/booking/del',
                multi_url: 'course/booking/multi',
                table: 'course_booking',
            };

            // 渲染表格
            layer.load(2);
            treetable.render({
                treeColIndex: 1,
                treeSpid: 0,
                homdPid: 99999999,
                treeIdName: 'id',
                treePidName: 'pid',
                elem: '#munu-table',
                url: init.index_url,
                toolbar: '#toolbar',
                page: false,
                cols: [[
                    {type:'checkbox'},
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

            //头工具栏事件
            table.on('toolbar(munu-table)', function(obj){
                var checkStatus = table.checkStatus(obj.config.id);
                switch(obj.event){
                    case 'deleteAll':
                        var data = checkStatus.data;
                        layer.alert(JSON.stringify(data));
                        break;
                };
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
        },

    };
    return Controller;
});