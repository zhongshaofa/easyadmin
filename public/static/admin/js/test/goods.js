define(["jquery", "easy-admin"], function ($, ea) {

    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'test.goods/index',
        add_url: 'test.goods/add',
        edit_url: 'test.goods/edit',
        delete_url: 'test.goods/delete',
        export_url: 'test.goods/export',
        modify_url: 'test.goods/modify',
    };

    var Controller = {

        index: function () {
            ea.table.render({
                init: init,
                cols: [[
                    {type: 'checkbox'},                    {field: 'id', title: 'ID'},                    {field: 'sex', search: 'select', selectList: {"1":"男","2":"女","0":"未知"}, title: '性别'},                    {field: 'checkbox', search: 'select', selectList: {"1":"选择1","2":"选择2","3":"选择3"}, title: '测试多选'},                    {field: 'mode', search: 'select', selectList: {"1":"正常购买","2":"秒杀活动"}, title: '购买模式'},                    {field: 'cate_id', title: '分类ID'},                    {field: 'title', title: '商品名称'},                    {field: 'logo', title: '商品logo', templet: ea.table.image},                    {field: 'market_price', title: '市场价'},                    {field: 'discount_price', title: '折扣价'},                    {field: 'sales', title: '销量'},                    {field: 'virtual_sales', title: '虚拟销量'},                    {field: 'stock', title: '库存'},                    {field: 'total_stock', title: '总库存'},                    {field: 'sort', title: '排序', edit: 'text'},                    {field: 'status', search: 'select', selectList: ["禁用","启用"], title: '状态', templet: ea.table.switch},                    {field: 'remark', title: '备注说明', templet: ea.table.text},                    {field: 'create_time', title: '创建时间'},                    {width: 250, title: '操作', templet: ea.table.tool},
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