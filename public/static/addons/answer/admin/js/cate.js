define(["jquery", "easy-admin"], function ($, ea) {

    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: ea.url('cate/index', 'answer'),
        add_url: ea.url('cate/add', 'answer'),
        edit_url: ea.url('cate/edit', 'answer'),
        delete_url: ea.url('cate/delete', 'answer'),
        export_url: ea.url('cate/export', 'answer'),
        modify_url: ea.url('cate/modify', 'answer'),
    };

    var Controller = {

        index: function () {
            ea.table.render({
                init: init,
                cols: [[
                    {type: "checkbox"},
                    {field: 'id', width: 80, title: 'ID'},
                    {field: 'sort', width: 80, title: '排序', edit: 'text'},
                    {field: 'title', minWidth: 80, title: '分类名称'},
                    {field: 'image', minWidth: 80, title: '分类图片', search: false, templet: ea.table.image},
                    {field: 'remark', minWidth: 80, title: '备注信息'},
                    {field: 'status', title: '状态', width: 85, search: 'select', selectList: {0: '禁用', 1: '启用'}, templet: ea.table.switch},
                    {field: 'create_time', minWidth: 80, title: '创建时间', search: 'range'},
                    {width: 250, title: '操作', templet: ea.table.tool}
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
    };

    return Controller;
});