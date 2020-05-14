define(["jquery", "easy-admin"], function ($, ea) {
    var table = layui.table;
    var form = layui.form;
    var upload = layui.upload;

    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'mall.cate/index',
        add_url: 'mall.cate/add',
        edit_url: 'mall.cate/edit',
        del_url: 'mall.cate/del',
        export_url: 'mall.cate/export',
        modify_url: 'mall.cate/modify',
    };

    var Controller = {

        index: function () {
            ea.table.render({
                init: init,
                modifyReload: true,
                cols: [[
                    {type: "checkbox"},
                    {field: 'id', width: 80, title: 'ID', sort: true, align: "center"},
                    {field: 'sort', width: 80, title: '排序', edit: 'text', sort: true, align: "center"},
                    {field: 'title', minWidth: 80, title: '分类名称', align: "center"},
                    {field: 'image', minWidth: 80, title: '分类图片', search: false, imageHeight: 40, align: "center", templet: ea.table.image},
                    {field: 'remark', minWidth: 80, title: '备注信息', align: "center"},
                    {field: 'status', title: '状态', width: 85, align: "center", search: 'select', selectList: {0: '禁用', 1: '启用'}, filter: 'status', templet: ea.table.switch},
                    {field: 'create_time', minWidth: 80, title: '创建时间', align: "center", search: 'range'},
                    {
                        width: 250,
                        align: 'center',
                        title: '操作',
                        init: init,
                        templet: ea.table.tool,
                        operat: ['edit', 'delete']
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
    };
    return Controller;
});