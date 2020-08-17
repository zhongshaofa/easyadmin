define(["jquery", "admin", "vue"], function ($, admin, Vue) {

    var Controller = {
        index: function () {

            /**
             * 添加模板
             */
            $('.add-template').on('click', function () {
                var dataKey = document.querySelectorAll("tr[data-key]"),
                    key = 0;
                if (dataKey.length > 0) key = parseInt($(dataKey[dataKey.length - 1]).attr('data-key')) + 1;
                var html = '            <tr data-key="' + key + '">\n' +
                    '                <td><input type="text" name="name[' + key + ']" lay-verify="required" autocomplete="off" class="layui-input" value=""></td>\n' +
                    '                <td><input type="text" name="value[' + key + ']" lay-verify="required" autocomplete="off" class="layui-input" value=""></td>\n' +
                    '                <td><input type="text" name="remark[' + key + ']" lay-verify="required" autocomplete="off" class="layui-input" value=""></td>\n' +
                    '                <td><span class="layui-btn layui-btn-danger layui-btn-sm"  delete-template="">删除</span></td>\n' +
                    '            </tr>';
                $('.template-list').append(html);
            });

            $('body').on('click', '[delete-template]', function () {
                $(this).parent().parent().remove();
            });

            admin.listen();
        }
    };
    return Controller;
});