define(["jquery", "admin",], function ($, ea) {
    var table = layui.table;
    var form = layui.form;
    var upload = layui.upload;

    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'system.auth/index',
        add_url: 'system.auth/add',
        edit_url: 'system.auth/edit',
        del_url: 'system.auth/del',
        modify_url: 'system.auth/modify',
        authorize_url: 'system.auth/authorize',
        save_authorize: 'system.auth/saveAuthorize',
    };

    var Controller = {

        index: function () {
            ea.table.render({
                init: init,
                toolbar: ['refresh', 'add', 'delete'],
                cols: [[
                    {type: "checkbox"},
                    {field: 'id', width: 80, title: 'ID', sort: true, align: "center"},
                    {field: 'title', minWidth: 80, title: '权限名称', align: "center"},
                    {field: 'remark', minWidth: 80, title: '备注信息', align: "center"},
                    {field: 'status', title: '状态', width: 85, align: "center", search: 'select', selectList: {0: '禁用', 1: '启用'}, filter: 'status', templet: ea.table.switch},
                    {field: 'create_time', minWidth: 80, title: '创建时间', align: "center", search: 'range'},
                    {
                        width: 250, align: 'center', title: '操作', init: init, templet: ea.table.tool, operat: ['edit',
                            [
                                {
                                    class: 'layui-btn layui-btn-normal layui-btn-xs',
                                    method: 'open',
                                    text: '授权',
                                    auth: 'authorize',
                                    url: init.authorize_url,
                                },
                            ], 'delete'
                        ]
                    }
                ]],
            });

            ea.listen();
        },
        add: function () {
            ea.listen();
        },
        edit: function () {
            ea.listen();
        },
        authorize: function () {
            var tree = layui.tree;

            ea.request.post(
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

            ea.listen(function (url, data) {
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
                url = ea.url(init.save_authorize);
                ea.api.form(url, data, function (res) {
                    ea.msg.success(res.msg, function () {
                        ea.api.closeCurrentOpen({refreshTable: init.table_render_id});
                    });
                });
                return false;
            });

        }
    };
    return Controller;
});