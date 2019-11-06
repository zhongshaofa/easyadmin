define(["jquery", "jquery-particleground", "admin"], function ($, undefined, admin) {

    var Controller = {
        index: function () {
            var form = layui.form,
                layer = layui.layer;

            if (top.location != self.location) {
                top.location = self.location;
            }
            $(document).ready(function () {
                $('.layui-container').particleground({
                    dotColor: '#5cbdaa',
                    lineColor: '#5cbdaa'
                });
            });
            form.on('submit(login)', function (data) {
                var data = data.field;
                if (data.username == '') {
                    layer.msg('用户名不能为空');
                    return false;
                }
                if (data.password == '') {
                    layer.msg('密码不能为空');
                    return false;
                }
                admin.request.post({
                    url: 'login/index',
                    prefix: true,
                    data: data,
                }, function (res) {

                });
                return false;
            });
        },

    };
    return Controller;
});