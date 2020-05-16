define(["jquery", "admin",], function ($, admin) {

    var init = {
        table_elem: 'currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: '/addons/alisms/record/index',
        delete_url: '/addons/alisms/record/del',
    };

    var Controller = {

        index: function () {
            admin.table.render({
                elem: '#' + init.table_elem,
                id: init.table_render_id,
                url: init.index_url,
                init: init,
                toolbar: ['refresh', 'delete'],
                cols: [[
                    {type: "checkbox"},
                    {field: 'id', width: 80, title: 'ID', sort: true, align: "center"},
                    {field: 'phone', minWidth: 80, title: '发送手机', align: "center"},
                    {field: 'content', minWidth: 80, title: '短信内容', align: "center"},
                    {field: 'template', minWidth: 80, title: '短信模板', align: "center"},
                    {field: 'result', minWidth: 80, title: '返回结果', align: "center"},
                    {field: 'create_time', minWidth: 80, title: '发送时间', align: "center", search: 'range'},
                    {
                        width: 250, align: 'center', title: '操作', init: init, templet: admin.table.tool, operat: ['delete']
                    }
                ]],
            });

            admin.listen();
        }
    };
    return Controller;
});