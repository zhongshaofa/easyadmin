define(["jquery-particleground", "admin"], function (undefined, ea) {
    var form = layui.form,
        layer = layui.layer;

    var Controller = {
        index: function () {
            if (top.location !== self.location) {
                top.location = self.location;
            }
            $('.layui-container').particleground({
                dotColor: '#5cbdaa',
                lineColor: '#5cbdaa'
            });
            ea.listen('', function (res) {
                ea.msg.success(res.msg, function () {
                    window.location = ea.url('index');
                })
            }, function (res) {
                ea.msg.error(res.msg, function () {
                    $('#refreshCaptcha').trigger("click");
                });
            });
        },
    };
    return Controller;
});