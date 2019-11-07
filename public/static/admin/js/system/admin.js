define(["jquery", "admin",], function ($, admin) {
    var table = layui.table;
    var form = layui.form;

    var init = {
        table_elem: 'currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'system.admin/index',
        add_url: 'system.admin/add',
        edit_url: 'system.admin/edit',
        del_url: 'system.admin/del',
        modify_url: 'system.admin/modify',
    };

    var Controller = {

        index: function () {
            table.render({
                elem: '#' + init.table_elem,
                id: init.table_render_id,
                url: admin.url(init.index_url),
                toolbar: '#toolbar',
                page: true,
                limit: 15,
                limits: [10, 15, 20, 25, 50, 100],
                cols: [[
                    {type: "checkbox", width: 50, fixed: "left"},
                    {field: 'id', width: 80, title: 'ID', sort: true, align: "center"},
                    {field: 'username', minWidth: 80, title: '登录账户', align: "center"},
                    {field: 'head_img', minWidth: 80, title: '头像', align: "center"},
                    {field: 'phone', minWidth: 80, title: '手机', align: "center"},
                    {field: 'login_num', minWidth: 80, title: '登录次数', align: "center"},
                    {field: 'remark', minWidth: 80, title: '备注信息', align: "center"},
                    {field: 'status', title: '状态', width: 85, align: "center", filter: 'status', templet: admin.table.switch},
                    {field: 'create_time', minWidth: 80, title: '创建时间', align: "center"},
                    {
                        width: 200, align: 'center', title: '操作', templet: admin.table.tool, operat: [
                            {
                                class: 'layui-btn layui-btn-xs',
                                text: '编辑',
                                open: init.add_url,
                                extend: ""
                            },
                            {
                                class: 'layui-btn layui-btn-normal layui-btn-xs',
                                text: '授权',
                                open: init.edit_url,
                                extend: ""
                            },
                            {
                                class: 'layui-btn layui-btn-danger layui-btn-xs',
                                text: '删除',
                                request: init.del_url,
                                extend: ""
                            }
                        ]
                    }
                ]],
            });

            admin.table.listenSwitch({filter: 'status', url: init.modify_url});

            admin.listen();
        },
        add: function () {
            admin.listen();
        },
        edit: function () {
            admin.listen();
        }
    };
    return Controller;
});