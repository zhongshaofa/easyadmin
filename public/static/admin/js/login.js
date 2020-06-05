define(["easy-admin"], function (ea) {

    var Controller = {
        index: function () {
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