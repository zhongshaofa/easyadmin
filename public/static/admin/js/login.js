define(["jquery-particleground", "admin"], function (undefined, admin) {
    var form = layui.form,
        layer = layui.layer;

    var Controller = {
        index: function () {
            if (top.location != self.location) {
                top.location = self.location;
            }
            $('.layui-container').particleground({
                dotColor: '#5cbdaa',
                lineColor: '#5cbdaa'
            });
            admin.listen('', function (res) {
                admin.msg.success(res.msg, function () {
                    window.location = admin.url('index');
                })
            }, function (res) {
                admin.msg.error(res.msg, function () {
                    $('#refreshCaptcha').trigger("click");
                });
            });
        },

    };
    return Controller;
});