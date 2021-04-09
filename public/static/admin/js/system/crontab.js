define(["jquery", "easy-admin"], function ($, ea) {

    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'system.crontab/index',
        add_url: 'system.crontab/add',
        edit_url: 'system.crontab/edit',
        delete_url: 'system.crontab/delete',
        export_url: 'system.crontab/export',
        modify_url: 'system.crontab/modify',
        flow_url: 'system.crontab/flow',
        relod_url: 'system.crontab/reload'
    };

    var Controller = {

        index: function () {
            ea.table.render({
                init: init,
                cellMinWidth: 100,
                cols: [[
                    {type: 'checkbox'},
                    {field: 'id', title: 'ID', sort: true, width: 80, search: false},
                    {field: 'title', title: '任务标题'},
                    {field: 'type', title: '任务类型', selectList: {0: '请求url', 1: '执行sql', 2: '执行shell'}},
                    {field: 'frequency', title: '任务频率', edit: "text", search: false},
                    {field: 'shell', title: '任务脚本', edit: "text", search: false},
                    {field: 'remark', title: '任务备注', edit: "text", search: false},
                    {field: 'sort', title: '排序', sort: true, edit: 'text', search: false},
                    {field: 'status', title: '状态', sort: true, templet: ea.table.switch, selectList: {0: '禁用', 1: '启用'}},
                    {field: 'create_time', title: '创建时间', sort: true, search: 'range'},
                    {
                        width: 150, title: '操作', templet: ea.table.tool, operat: [
                            [{
                                text: '重启',
                                url: init.relod_url,
                                field: 'id',
                                method: 'request',
                                title: '确定重启吗？',
                                auth: 'reload',
                                class: 'layui-btn layui-btn-xs layui-btn-success'
                            }, {
                                text: '日志',
                                url: init.flow_url,
                                field: 'id',
                                method: 'open',
                                auth: 'flow',
                                class: 'layui-btn layui-btn-xs layui-btn-normal',
                                extend: 'data-full="false"',
                            }],
                            'delete']
                    }
                ]],
            });
            ea.listen();
        },
        add: function () {
            ea.listen();
        },
        flow: function () {
            var table = layui.table,
                form = layui.form,
                intervalID,
                init = {
                    table_elem: '#currentTable',
                    table_render_id: 'currentTableRenderId',
                    index_url: 'system.crontab/flow?id=' + id
                };

            ea.table.render({
                init: init,
                toolbar: ['refresh', 'export'],
                cellMinWidth: 100,
                cols: [[
                    {field: 'create_time', title: '创建时间', sort: true, search: 'range'},
                    {field: 'remark', title: '备注', search: false},
                ]],
            });

            form.on('switch(monitor)', function (data) {
                if (data.elem.checked) {
                    intervalID = setInterval(function () {
                        table.reload(init.table_render_id);
                    }, 1000);
                } else {
                    clearInterval(intervalID);
                }

            });
            ea.listen();
        }
    };
    return Controller;
});