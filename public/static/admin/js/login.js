layui.extend({
    tool: "plugs/layuimini/layuimini-tool",
});
layui.define(['form', 'tool'], function (exports) {
    var $ = layui.jquery,
        form = layui.form,
        tool = layui.tool;

    var controller = new function () {

        this.index = function () {
            if (top.location != self.location) top.location = self.location;
            form.on('submit(login)', function (data) {
                data = data.field;
                tool.request.post("/admin/login/index", data, function (res) {
                    tool.msg.success(res.msg, function () {
                        window.location.href = res.url;
                    });
                });
                return false;
            });
        };

    };

    exports("controller", controller);
});