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
            admin.table.render({
                elem: '#' + init.table_elem,
                id: init.table_render_id,
                url: admin.url(init.index_url),
                init: init,
                toolbar: ['refresh', 'add', 'delete'],
                cols: [[
                    {type: "checkbox"},
                    {field: 'id', width: 80, title: 'ID', sort: true, align: "center"},
                    {field: 'username', minWidth: 80, title: '登录账户', align: "center"},
                    {field: 'head_img', minWidth: 80, title: '头像', search: false, imageHeight: 40, align: "center", templet: admin.table.image},
                    {field: 'phone', minWidth: 80, title: '手机', align: "center"},
                    {field: 'login_num', minWidth: 80, title: '登录次数', align: "center"},
                    {field: 'remark', minWidth: 80, title: '备注信息', align: "center"},
                    {field: 'status', title: '状态', width: 85, align: "center", search: 'select', selectList: {0: '禁用', 1: '启用'}, filter: 'status', templet: admin.table.switch},
                    {field: 'create_time', minWidth: 80, title: '创建时间', align: "center", search: 'range'},
                    {
                        width: 250, align: 'center', title: '操作', init: init, templet: admin.table.tool, operat: ['edit',
                            [
                                {
                                    class: 'layui-btn layui-btn-normal layui-btn-xs',
                                    text: '授权',
                                    open: init.edit_url,
                                    extend: ""
                                },
                                {
                                    class: 'layui-btn layui-btn-xs',
                                    text: '设置密码',
                                    open: 'system.admin/setPassword',
                                    extend: ""
                                }
                            ],'delete'
                        ]
                    }
                ]],
            });

            table.on('toolbar(currentTable)', function(obj){ //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
                var data = obj.data; //获得当前行数据
                var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
                var tr = obj.tr; //获得当前行 tr 的 DOM 对象（如果有的话）

                if(layEvent === 'LAY-table-1'){ //查看
                    console.log('搜索');
                    alert('搜索');
                    //do somehing
                } else if(layEvent === 'del'){ //删除
                    layer.confirm('真的删除行么', function(index){
                        obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                        layer.close(index);
                        //向服务端发送删除指令
                    });
                } else if(layEvent === 'edit'){ //编辑
                    //do something

                    //同步更新缓存对应的值
                    obj.update({
                        username: '123'
                        ,title: 'xxx'
                    });
                } else if(layEvent === 'LAYTABLE_TIPS'){
                    layer.alert('Hi，头部工具栏扩展的右侧图标。');
                }
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