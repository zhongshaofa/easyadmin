define(["jquery", "admin", "vue"], function ($, admin, Vue) {

    var form = layui.form,
        element = layui.element;

    var Controller = {
        index: function () {

            var app = new Vue({
                el: '#app',
                data: {
                    upload_type: upload_type
                }
            });

            form.on("radio(upload_type)", function (data) {
                app.upload_type = this.value;
            });

            admin.listen();
        }
    };
    return Controller;
});