define(["jquery", "easy-admin"], function ($, ea) {

    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'system.uploadfile/index',
        add_url: 'system.uploadfile/add',
        edit_url: 'system.uploadfile/edit',
        delete_url: 'system.uploadfile/delete',
        modify_url: 'system.uploadfile/modify',
        export_url:'system.uploadfile/export',
    };

    var Controller = {

        index: function () {
            ea.table.render({
                init: init,
                cols: [[
                    {type: "checkbox"},
                    {field: 'id', width: 80, title: 'ID'},
                    {field: 'upload_type', minWidth: 80, title: '存储位置', search: 'select', selectList: {'local': '本地', 'alioss': '阿里云', 'qnoss': '七牛云', ',txcos': '腾讯云'}},
                    {field: 'url', minWidth: 80, search: false, title: '图片信息', templet: ea.table.image},
                    {field: 'url', minWidth: 120, title: '保存地址', templet: ea.table.url},
                    {field: 'original_name', minWidth: 80, title: '文件原名'},
                    {field: 'mime_type', minWidth: 80, title: 'mime类型'},
                    {field: 'file_ext', minWidth: 80, title: '文件后缀'},
                    {field: 'create_time', minWidth: 80, title: '创建时间', search: 'range'},
                    {width: 250, title: '操作', templet: ea.table.tool, operat: ['delete']}
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
        password: function () {
            ea.listen();
        }
    };
    return Controller;
});