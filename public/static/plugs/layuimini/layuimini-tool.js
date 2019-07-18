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
     * 封装 form 方法
     */
    tool.form = new function () {

        /**
         * 弹出新窗口
         * @param title 标题
         * @param url 链接
         * @param width 宽
         * @param height 高
         * @param isResize 窗口变动，是否重置
         */
        this.open = function (title, url, width, height, isResize) {
            if (isResize == undefined) isResize = true;
            var index = layer.open({
                title: title,
                type: 2,
                maxmin: true,
                area: [width, height],
                content: url,
                success: function (layero, index) {
                    var body = layer.getChildFrame('body', index);
                }
            });
            if (tool.check.checkMobile() || width == undefined || height == undefined) {
                layer.full(index);
            } else {
                if (width.replace("px", "") > window.innerWidth || height.replace("px", "") > window.innerHeight) {
                    layer.full(index);
                }
            }
            if (isResize == true) {
                $(window).on("resize", function () {
                    layer.full(index);
                })
            }
        }
    };

    tool.check = new function () {

        /**
         * 判断是否为手机
         */
        this.checkMobile = function () {
            var ua = navigator.userAgent.toLocaleLowerCase();
            var pf = navigator.platform.toLocaleLowerCase();
            var isAndroid = (/android/i).test(ua) || ((/iPhone|iPod|iPad/i).test(ua) && (/linux/i).test(pf))
                || (/ucweb.*linux/i.test(ua));
            var isIOS = (/iPhone|iPod|iPad/i).test(ua) && !isAndroid;
            var isWinPhone = (/Windows Phone|ZuneWP7/i).test(ua);
            var clientWidth = document.documentElement.clientWidth;
            if (!isAndroid && !isIOS && !isWinPhone && clientWidth > 768) {
                return false;
            } else {
                return true;
            }
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

    /**
     * 注册 data-open 事件
     * 用于打开弹出层
     */
    $('body').on('click', '[data-open]', function () {
        var title = $(this).attr('data-title'),
            url = $(this).attr('data-open'),
            width = $(this).attr('data-width'),
            height = $(this).attr('data-height'),
            isResize = $(this).attr('data-resize');
        tool.form.open(title, url, width, height, isResize);
    });

    exports("tool", tool);
});