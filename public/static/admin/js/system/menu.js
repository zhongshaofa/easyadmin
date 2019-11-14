define(["jquery", "admin", "treetable", "iconPickerFa", "autocomplete"], function ($, admin) {

    var table = layui.table;
    var form = layui.form;
    var treetable = layui.treetable;
    var iconPickerFa = layui.iconPickerFa;
    var autocomplete = layui.autocomplete;

    var init = {
        table_elem: 'currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'system.menu/index',
        add_url: 'system.menu/add',
        del_url: 'system.menu/del',
        edit_url: 'system.menu/edit',
        modify_url: 'system.menu/modify',
    };

    var Controller = {
        index: function () {

            var renderTable = function () {
                layer.load(2);
                treetable.render({
                    treeColIndex: 1,
                    treeSpid: 0,
                    homdPid: 99999999,
                    treeIdName: 'id',
                    treePidName: 'pid',
                    url: admin.url(init.index_url),
                    elem: '#' + init.table_elem,
                    id: init.table_render_id,
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
                        {field: 'status', title: '状态', width: 85, align: "center", filter: 'status', templet: admin.table.switch},
                        {field: 'status', width: 80, align: 'center', title: '排序'},
                        {
                            width: 200, align: 'center', title: '操作', init: init, templet: admin.table.tool, operat: [[
                                {
                                    class: 'layui-btn layui-btn-xs layui-btn-normal',
                                    text: '添加下级',
                                    open: 'system.menu/add',
                                    extend: ""
                                }], 'edit', 'delete'
                            ]
                        }
                    ]],
                    done: function () {
                        layer.closeAll('loading');
                    }
                });
            };

            renderTable();

            $('body').on('click', '[data-treetable-refresh]', function () {
                renderTable();
            });

            $('body').on('click', '[data-treetable-delete]', function () {
                var tableId = $(this).attr('data-treetable-delete'),
                    url = $(this).attr('data-url');
                tableId = tableId || init.table_render_id;
                url = url != undefined ? admin.url(url) : window.location.href;
                var checkStatus = table.checkStatus(tableId),
                    data = checkStatus.data;
                if (data.length <= 0) {
                    admin.msg.error('请勾选需要删除的数据');
                    return false;
                }
                var ids = [];
                $.each(data, function (i, v) {
                    ids.push(v.id);
                });
                admin.msg.confirm('确定删除？', function () {
                    admin.request.post({
                        url: url,
                        data: {
                            id: ids
                        },
                    }, function (res) {
                        admin.msg.success(res.msg, function () {
                            renderTable();
                        });
                    });
                });
                return false;
            });

            admin.table.listenSwitch({filter: 'status', url: init.modify_url});

            admin.listen();
        },
        add: function () {
            iconPickerFa.render({
                elem: '#icon',
                url: PATH_CONFIG.iconLess,
                limit: 12,
                click: function (data) {
                    $('#icon').val('fa ' + data.icon);
                },
                success: function (d) {
                    console.log(d);
                }
            });
            autocomplete.render({
                elem: $('#href')[0],
                url: admin.url('system.menu/getMenuTips'),
                template_val: '{{d.node}}',
                template_txt: '{{d.node}} <span class=\'layui-badge layui-bg-gray\'>{{d.title}}</span>',
                onselect: function (resp) {
                }
            });
            admin.listen(function (url, data) {
                admin.api.form(url, data, function (res) {
                    admin.msg.success(res.msg, function () {
                        admin.api.closeCurrentOpen({
                            refreshTable: true,
                            refreshFrame: true
                        });
                    });
                });
                return false;
            });
        },
        edit: function () {
            iconPickerFa.render({
                elem: '#icon',
                url: PATH_CONFIG.iconLess,
                limit: 12,
                click: function (data) {
                    $('#icon').val('fa ' + data.icon);
                },
                success: function (d) {
                    console.log(d);
                }
            });
            autocomplete.render({
                elem: $('#href')[0],
                url: admin.url('system.menu/getMenuTips'),
                template_val: '{{d.node}}',
                template_txt: '{{d.node}} <span class=\'layui-badge layui-bg-gray\'>{{d.title}}</span>',
                onselect: function (resp) {
                }
            });
            admin.listen(function (url, data) {
                admin.api.form(url, data, function (res) {
                    admin.msg.success(res.msg, function () {
                        admin.api.closeCurrentOpen({
                            refreshTable: true,
                            refreshFrame: true
                        });
                    });
                });
                return false;
            });
        }
    };
    return Controller;
});