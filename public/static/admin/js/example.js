define(["jquery", "admin", ], function ($, admin) {

    var table = layui.table;
    var form = layui.form;

    var init = {
        index_url: 'system.admin/index',
        add_url: 'system.admin/add',
        del_url: 'system.admin/del',
        modify_url: 'system.admin/modify',
        tableId: 'currentTable',
    };

    var Controller = {

        index: function () {
            table.render({
                elem: '#' + init.tableId,
                url: admin.url(init.index_url),
                cols: [[
                    {type: "checkbox", width: 50, fixed: "left"},
                    {field: 'id', width: 80, title: 'ID', sort: true},
                    {field: 'username', width: 80, title: '用户名'},
                    {field: 'sex', width: 80, title: '性别', sort: true},
                    {field: 'city', width: 80, title: '城市'},
                    {field: 'sign', title: '签名', minWidth: 150},
                    {field: 'experience', width: 80, title: '积分', sort: true},
                    {field: 'score', width: 80, title: '评分', sort: true},
                    {field: 'classify', width: 80, title: '职业'},
                    {field: 'wealth', width: 135, title: '财富', sort: true},
                    {title: '操作', minWidth: 50, templet: '#currentTableBar', fixed: "right", align: "center"}
                ]],
                limits: [10, 15, 20, 25, 50, 100],
                limit: 15,
                page: true
            });
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