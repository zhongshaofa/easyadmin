define(["jquery", "admin",], function ($, admin) {
    var table = layui.table;
    var form = layui.form;
    var upload = layui.upload;

    var init = {
        table_elem: 'currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'system.auth/index',
        add_url: 'system.auth/add',
        edit_url: 'system.auth/edit',
        del_url: 'system.auth/del',
        authorize_url: 'system.auth/authorize',
        save_authorize: 'system.auth/saveAuthorize',
        modify_url: 'system.auth/modify',
    };

    var Controller = {

        index: function () {
            admin.table.render({
                elem: '#' + init.table_elem,
                id: init.table_render_id,
                url: admin.url(init.index_url),
                init: init,
                toolbar: ['refresh', 'add', 'delete'],
                cols: [[
                    {type: "checkbox"},
                    {field: 'id', width: 80, title: 'ID', sort: true, align: "center"},
                    {field: 'title', minWidth: 80, title: '权限名称', align: "center"},
                    {field: 'remark', minWidth: 80, title: '备注信息', align: "center"},
                    {field: 'status', title: '状态', width: 85, align: "center", search: 'select', selectList: {0: '禁用', 1: '启用'}, filter: 'status', templet: admin.table.switch},
                    {field: 'create_time', minWidth: 80, title: '创建时间', align: "center", search: 'range'},
                    {
                        width: 250, align: 'center', title: '操作', init: init, templet: admin.table.tool, operat: ['edit',
                            [
                                {
                                    class: 'layui-btn layui-btn-normal layui-btn-xs',
                                    text: '授权',
                                    open: init.authorize_url,
                                    extend: ""
                                },
                            ], 'delete'
                        ]
                    }
                ]],
            });

            admin.listen();
        },
        add: function () {
            admin.listen();
        },
        edit: function () {
            admin.listen();
        },
        authorize: function () {
            var tree = layui.tree;

            admin.request.post(
                {
                    url: window.location.href,
                }, function (res) {
                    res.data == res.data || [];
                    tree.render({
                        elem: '#node_ids',
                        data: res.data,
                        showCheckbox: true,
                        id: 'nodeDataId',
                    });
                }
            );

            admin.listen(function (url, data) {
                var checkedData = tree.getChecked('nodeDataId');
                var ids = [];
                $.each(checkedData, function (i, v) {
                    ids.push(v.id);
                    if (v.children != undefined && v.children.length > 0) {
                        $.each(v.children, function (ii, vv) {
                            ids.push(vv.id);
                        });
                    }
                });
                data.node = JSON.stringify(ids);
                url = admin.url(init.save_authorize);
                admin.api.form(url, data, function (res) {
                    admin.msg.success(res.msg, function () {
                        admin.api.closeCurrentOpen({refreshTable: init.table_render_id});
                    });
                });
                return false;
            });

        }
    };
    return Controller;
});