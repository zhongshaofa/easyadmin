define(["jquery", "admin",], function ($, admin) {
    var table = layui.table;
    var form = layui.form;
    var upload = layui.upload;

    var init = {
        table_elem: 'currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'system.node/index',
        add_url: 'system.node/add',
        edit_url: 'system.node/edit',
        del_url: 'system.node/del',
        modify_url: 'system.node/modify',
    };

    var Controller = {

        index: function () {
            admin.table.render({
                elem: '#' + init.table_elem,
                id: init.table_render_id,
                url: admin.url(init.index_url),
                init: init,
                toolbar: ['refresh', [
                    {
                        text: ' 更新节点',
                        class: 'layui-btn layui-btn-sm',
                        icon: 'fa fa-hourglass ',
                        title: '确定更新新节点？',
                        extend: ' data-request="system.node/refreshNode" data-table="' + init.table_render_id + '"',
                    },
                    {
                        text: ' 强制更新节点',
                        class: 'layui-btn layui-btn-sm layui-btn-danger',
                        icon: 'fa fa-hourglass ',
                        title: '该操作会全部原来的节点，重新再生成一遍。<br>确定强制更新节点？',
                        extend: ' data-request="system.node/refreshNode" data-table="' + init.table_render_id + '"',
                    },
                ]],
                search: false,
                defaultToolbar: ['filter'],
                page: false,
                cols: [[
                    {type: "checkbox"},
                    {field: 'node', minWidth: 200, align: 'left', title: '系统节点'},
                    {field: 'title', minWidth: 80, title: '节点名称 <i class="table-edit-tips color-red">*</i>', edit: 'text', align: "center"},
                    {field: 'create_time', minWidth: 80, title: '创建时间', align: "center", search: 'range'},
                    {field: 'is_auth', title: '节点控制', width: 85, align: "center", search: 'select', selectList: {0: '禁用', 1: '启用'}, filter: 'is_auth', templet: admin.table.switch},
                ]],
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