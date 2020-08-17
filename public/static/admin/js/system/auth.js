define(["jquery", "easy-admin"], function ($, ea) {

    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'system.auth/index',
        add_url: 'system.auth/add',
        edit_url: 'system.auth/edit',
        delete_url: 'system.auth/delete',
        export_url: 'system.auth/export',
        modify_url: 'system.auth/modify',
        authorize_url: 'system.auth/authorize',
    };

    var Controller = {

        index: function () {
            ea.table.render({
                init: init,
                cols: [[
                    {type: "checkbox"},
                    {field: 'id', width: 80, title: 'ID'},
                    {field: 'sort', width: 80, title: '排序', edit: 'text'},
                    {field: 'title', minWidth: 80, title: '权限名称'},
                    {field: 'remark', minWidth: 80, title: '备注信息'},
                    {field: 'status', title: '状态', width: 85, search: 'select', selectList: {0: '禁用', 1: '启用'}, templet: ea.table.switch},
                    {field: 'create_time', minWidth: 80, title: '创建时间', search: 'range'},
                    {
                        width: 250,
                        title: '操作',
                        templet: ea.table.tool,
                        operat: [
                            'edit',
                            [{
                                text: '授权',
                                url: init.authorize_url,
                                method: 'open',
                                auth: 'authorize',
                                class: 'layui-btn layui-btn-normal layui-btn-xs',
                            }],
                            'delete'
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

            ea.request.get(
                {
                    url: window.location.href,
                }, function (res) {
                    res.data = res.data || [];
                    tree.render({
                        elem: '#node_ids',
                        data: res.data,
                        showCheckbox: true,
                        id: 'nodeDataId',
                    });
                }
            );

            ea.listen(function (data) {
                var checkedData = tree.getChecked('nodeDataId');
                var ids = [];
                $.each(checkedData, function (i, v) {
                    ids.push(v.id);
                    if (v.children !== undefined && v.children.length > 0) {
                        $.each(v.children, function (ii, vv) {
                            ids.push(vv.id);
                        });
                    }
                });
                data.node = JSON.stringify(ids);
                return data;
            });

        }
    };
    return Controller;
});