/**
 * 2018/9/3
 * 博客JS初始化
 */

layui.use(['laydate', 'form', 'layer', 'table', 'laytpl'], function () {
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laytpl = layui.laytpl,
        table = layui.table,
        laydate = layui.laydate;

    // 当前页面Bogy对象
    var $body = $('body');

    /**
     * 注册 data-confirm 事件
     */
    $body.on('click', '[data-confirm]', function () {
        $.form.confirm($(this).attr('data-title'), $(this).attr('data-confirm'));
    })

    /**
     * 注册 data-open 事件
     */
    $body.on('click', '[data-open]', function () {
        $.form.open($(this).attr('data-title'), $(this).attr('data-open'), $(this).attr('data-width'), $(this).attr('data-height'));
    })

    /**
     * 打开链接
     */
    $body.on('click', '[data-href]', function () {
        if ($(this).attr('target') == '_blank') {
            window.open($(this).attr('data-href'));
        } else {
            $.msg.loading('正在加载，请稍等！');
            window.location.href = $(this).attr('data-href');
        }
    })

    /**
     * 消息组件实例
     */
    $.msg = new function () {
        var self = this;
        this.shade = [0.02, '#000'];
        this.dialogIndexs = [];

        /**
         * 关闭消息框
         * @param index
         * @returns {*}
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
            return this.dialogIndexs.push(index), index;
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
         * @param time
         * @param callback
         */
        this.success = function (msg, callback) {
            if (callback == undefined) {
                callback = function () {
                }
            }
            var index = layer.msg(msg, {icon: 1, shade: this.shade, scrollbar: false, time: 2000, shadeClose: true}, callback);
            return this.dialogIndexs.push(index), index;
        };

        /**
         * 显示失败类型的消息
         * @param msg
         * @param time
         * @param callback
         */
        this.error = function (msg, callback) {
            if (callback == undefined) {
                callback = function () {
                }
            }
            var index = layer.msg(msg, {icon: 2, shade: this.shade, scrollbar: false, time: 3000, shadeClose: true}, callback);
            return this.dialogIndexs.push(index), index;
        };

        /**
         * 状态消息提示
         * @param msg
         * @param time
         * @param callback
         */
        this.tips = function (msg, time, callback) {
            var index = layer.msg(msg, {time: (time || 3) * 1000, shade: this.shade, end: callback, shadeClose: true});
            return this.dialogIndexs.push(index), index;
        };

        /**
         * 显示正在加载中的提示
         * @param msg
         * @param callback
         */
        this.loading = function (msg, callback) {
            var index = msg ? layer.msg(msg, {icon: 16, scrollbar: false, shade: this.shade, time: 0, end: callback}) : layer.load(2, {time: 0, scrollbar: false, shade: this.shade, end: callback});
            return this.dialogIndexs.push(index), index;
        };
    };

    /**
     * 表单初始化
     */
    $.form = new function () {

        /**
         * 弹出新窗口
         * @param title
         * @param url
         * @param width
         * @param height
         */
        this.open = function (title, url, width, height) {
            var index = layui.layer.open({
                title: title,
                type: 2,
                area: [width, height],
                content: url,
                success: function (layero, index) {
                    var body = layui.layer.getChildFrame('body', index);
                    // setTimeout(function () {
                    //     layui.layer.tips('点击此处返回', '.layui-layer-setwin .layui-layer-close', {
                    //         tips: 3
                    //     });
                    // }, 500)
                }
            })
            if (width == undefined || height == undefined) {
                layui.layer.full(index);
            }
            // $(window).on("resize", function () {
            //     layui.layer.full(index);
            // })
        }

        /**
         * 弹出确认框
         * @param title 提示内容
         * @param url 请求URL
         */
        this.confirm = function (title, url) {
            layer.confirm(title, {icon: 3, title: '提示信息'}, function (index) {
                $.request.get(url, {}, function (data) {
                    $.msg.success(data.msg, function () {
                        window.location.reload();
                    });
                });
                return false;
            })
        }
    }

    /**
     * 封装请求
     */
    $.request = new function () {
        //post请求
        this.post = function (url, data, callback) {
            request('POST', url, data, callback);
        }
        //get请求
        this.get = function (url, data, callback) {
            request('GET', url, data, callback);
        }
    }

    /**
     * AJAX请求
     * @param type
     * @param url
     * @param data
     * @param callback
     */
    function request(type, url, data, callback) {
        $.msg.loading('正在加载，请稍等！');
        $.ajax({
            url: url,
            type: type,
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            dataType: "json",
            data: data,
            timeout: 60000,
            success: function (res) {
                log_ajax(type, url, res);
                $.msg.close();
                if (res.code == 0) {
                    callback(res);
                } else {
                    $.msg.error(res.msg);
                }
            },
            error: function (xhr, textstatus, thrown) {
                $.msg.error('Status:' + xhr.status + '，' + xhr.statusText + '，请稍后再试！');
            }
        });
    }

    /**
     * 记录AJAX请求
     * @param type
     * @param url
     * @param data
     */
    function log_ajax(type, url, data) {
        console.log('------------------------------------');
        console.log(type + '请求：' + url);
        console.log(data);
        console.log('------------------------------------');
    }

})