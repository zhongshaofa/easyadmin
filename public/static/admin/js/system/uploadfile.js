define(["jquery", "admin",], function ($, admin) {
    var table = layui.table;
    var form = layui.form;
    var upload = layui.upload;

    var init = {
        table_elem: 'currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'system.uploadfile/index',
        add_url: 'system.uploadfile/add',
        edit_url: 'system.uploadfile/edit',
        del_url: 'system.uploadfile/del',
        modify_url: 'system.uploadfile/modify',
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
                    {field: 'upload_type', minWidth: 80, title: '存储位置', align: "center", search: 'select', selectList: {'local': '本地', 'alioss': '阿里云', 'qnoss': '七牛云', ',txcos': '腾讯云'}, templet: admin.table.list},
                    {field: 'url', minWidth: 80, search: false, title: '图片信息', search: false, imageHeight: 40, align: "center", templet: admin.table.image},
                    {field: 'url', minWidth: 120, title: '保存地址', align: "center", templet: admin.table.url},
                    {field: 'original_name', minWidth: 80, title: '文件原名', align: "center"},
                    {field: 'mime_type', minWidth: 80, title: 'mime类型', align: "center"},
                    {field: 'file_ext', minWidth: 80, title: '文件后缀', align: "center"},
                    {field: 'create_time', minWidth: 80, title: '创建时间', align: "center", search: 'range'},
                    {
                        width: 250, align: 'center', title: '操作', init: init, templet: admin.table.tool, operat: ['delete']
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
        password: function () {
            admin.listen();
        }
    };
    return Controller;
});