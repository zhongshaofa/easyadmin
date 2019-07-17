layui.define(["element", "jquery"], function (exports) {
    var element = layui.element,
        $ = layui.$,
        layer = layui.layer;

    var shade = [0.02, '#000'],
        dialogIndexs = [];

    var tool = new function () {
    };

    /**
     * 封装msg方法
     */
    tool.msg = new function () {

        /**
         * 关闭消息框
         * @param index
         */
        this.close = function (index) {
            return layer.close(index);
        };

        /**
         * 弹出警告消息框
         * @param msg
         * @param callback
         */
        this.alert = function (msg, callback) {
            var index = layer.alert(msg, {end: callback, scrollbar: false});
            return dialogIndexs.push(index), index;
        };

        /**
         * 确认对话框
         * @param msg
         * @param ok
         * @param no
         * @returns {*}
         */
        this.confirm = function (msg, ok, no) {
            var index = layer.confirm(msg, {title: '操作确认', btn: ['确认', '取消']}, function () {
                typeof ok === 'function' && ok.call(this);
            }, function () {
                typeof no === 'function' && no.call(this);
                self.close(index);
            });
            return index;
        };

        /**
         * 显示成功类型的消息
         * @param msg
         * @param callback
         */
        this.success = function (msg, callback) {
            if (callback == undefined) {
                callback = function () {
                }
            }
            var index = layer.msg(msg, {icon: 1, shade: shade, scrollbar: false, time: 2000, shadeClose: true}, callback);
            return dialogIndexs.push(index), index;
        };

        /**
         * 显示失败类型的消息
         * @param msg
         * @param callback
         */
        this.error = function (msg, callback) {
            if (callback == undefined) {
                callback = function () {
                }
            }
            var index = layer.msg(msg, {icon: 2, shade: shade, scrollbar: false, time: 3000, shadeClose: true}, callback);
            return dialogIndexs.push(index), index;
        };

        /**
         * 状态消息提示
         * @param msg
         * @param time
         * @param callback
         */
        this.tips = function (msg, time, callback) {
            var index = layer.msg(msg, {time: (time || 3) * 1000, shade: shade, end: callback, shadeClose: true});
            return dialogIndexs.push(index), index;
        };

        /**
         * 显示正在加载中的提示
         * @param msg
         * @param callback
         */
        this.loading = function (msg, callback) {
            var index = msg ? layer.msg(msg, {icon: 16, scrollbar: false, shade: shade, time: 0, end: callback}) : layer.load(2, {time: 0, scrollbar: false, shade: shade, end: callback});
            return dialogIndexs.push(index), index;
        };
    };

    /**
     * 封装请求方法
     */
    tool.request = new function () {

        /**
         * ajax请求
         * @param type
         * @param url
         * @param data
         * @param callback
         */
        this.ajax = function (type, url, data, callback) {
            $.ajax({
                url: url,
                type: type,
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                dataType: "json",
                data: data,
                timeout: 60000,
                success: function (res) {
                    if (res.code == 1) {
                        callback(res);
                    } else {
                        tool.msg.error(res.msg);
                    }
                },
                error: function (xhr, textstatus, thrown) {
                    tool.msg.error('Status:' + xhr.status + '，' + xhr.statusText + '，请稍后再试！');
                }
            });
        };

        /**
         * get请求
         * @param url
         * @param data
         * @param callback
         */
        this.get = function (url, data, callback) {
            tool.request.ajax('get', url, data, callback);
        };

        /**
         * post请求
         * @param url
         * @param data
         * @param callback
         */
        this.post = function (url, data, callback) {
            tool.request.ajax('post', url, data, callback);
        };
    };

    exports("tool", tool);
});