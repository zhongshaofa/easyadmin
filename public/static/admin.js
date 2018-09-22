layui.use(['laydate', 'form', 'layer', 'table', 'laytpl', 'jquery'], function () {
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        laytpl = layui.laytpl,
        table = layui.table,
        laydate = layui.laydate,
        $ = layui.jquery;

    /**
     * 消息组件实例
     */
    $.msg = new function () {
        var self = this;
        this.shade = [0.02, '#000'];
        this.dialogIndexs = [];
        //关闭消息框
        this.close = function (index) {
            return layer.close(index);
        };
        //弹出警告消息框
        this.alert = function (msg, callback) {
            var index = layer.alert(msg, {end: callback, scrollbar: false});
            return this.dialogIndexs.push(index), index;
        };
        //确认对话框
        this.confirm = function (msg, ok, no) {
            var index = layer.confirm(msg, {title: '操作确认', btn: ['确认', '取消']}, function () {
                typeof ok === 'function' && ok.call(this);
            }, function () {
                typeof no === 'function' && no.call(this);
                self.close(index);
            });
            return index;
        };
        // 显示成功类型的消息
        this.success = function (msg, callback) {
            if (callback == undefined) {
                callback = function () {
                }
            }
            var index = layer.msg(msg, {icon: 1, shade: this.shade, scrollbar: false, time: 2000, shadeClose: true}, callback);
            return this.dialogIndexs.push(index), index;
        };
        //显示失败类型的消息
        this.error = function (msg, callback) {
            if (callback == undefined) {
                callback = function () {
                }
            }
            var index = layer.msg(msg, {icon: 2, shade: this.shade, scrollbar: false, time: 3000, shadeClose: true}, callback);
            return this.dialogIndexs.push(index), index;
        };
        //状态消息提示
        this.tips = function (msg, time, callback) {
            var index = layer.msg(msg, {time: (time || 3) * 1000, shade: this.shade, end: callback, shadeClose: true});
            return this.dialogIndexs.push(index), index;
        };
        //显示正在加载中的提示
        this.loading = function (msg, callback) {
            var index = msg ? layer.msg(msg, {icon: 16, scrollbar: false, shade: this.shade, time: 0, end: callback}) : layer.load(2, {time: 0, scrollbar: false, shade: this.shade, end: callback});
            return this.dialogIndexs.push(index), index;
        };
    };

    /**
     * 常用工具
     */
    $.tool = new function () {
        //关闭当前弹出层
        this.close = function () {
            var index = parent.layer.getFrameIndex(window.name);
            parent.layer.close(index);
        }
        //刷新当前弹出层
        this.reload = function () {
            var index = parent.layer.getFrameIndex(window.name);
            parent.location.reload();
        }
        //判断数组是否为空
        this.isEmptyArray = function (array) {
            for (var x in array) {
                key = x;//键
                value = array[x];//值
                if (value != '') return false;
            }
            return true;
        }
    }

    /**
     * 重新封装表单插件
     */
    $.form = new function () {

        /**
         * 生成表单
         * @param elem 绑定表单id
         * @param url 链接
         * @param cols 表单渲染
         * @param page 表单渲染
         */
        this.table = function (elem, url, cols, isPage = true, skin = '', size = '', isTool = true) {
            if (!isPage) {
                var data = {
                    elem: '#' + elem + 'Table',
                    url: url,
                    cellMinWidth: 95,
                    height: "full-80",
                    limits: [500],
                    limit: 500,
                    id: elem + 'TableId',
                    cols: cols
                };
            } else {
                var data = {
                    elem: '#' + elem + 'Table',
                    url: url,
                    cellMinWidth: 95,
                    page: true,
                    height: "full-80",
                    limits: [10, 15, 20, 25],
                    limit: 20,
                    id: elem + 'TableId',
                    cols: cols
                };
            }
            if (skin != '') data.skin = skin;
            if (size != '') data.size = size;
            if (!isTool) data.height = "full-40";
            table.render(data);
        }

        /**
         * 表单搜索
         * @param TableId table编号
         * @param search 搜索内容
         * @param page 分页
         */
        this.search = function (TableId, search, page = 1) {
            var loading = $.msg.loading();
            if (!page) {
                var data = {
                    where: {search: search}
                };
            } else {
                var data = {
                    page: {curr: page},
                    where: {search: search}
                };
            }
            if (!$.tool.isEmptyArray(search)) {
                table.reload(TableId, data);
                $.msg.close(loading);
                $.msg.success('查询成功！');
            } else {
                $.msg.close(loading);
                $.tool.reload();
            }
        }

        /**
         * 修改表单字段值
         * @param tableName table名称
         * @param url 链接
         */
        this.editField = function (tableName, url) {
            table.on('edit(' + tableName + ')', function (obj) {
                var value = obj.value //修改后的值
                    , data = obj.data //所在行所有键值
                    , field = obj.field; //字段名称
                $.request.post(url, {
                    id: data.id,
                    field: field,
                    value: value,
                }, function (res) {
                    $.msg.success(res.msg, function () {
                        $.tool.reload();
                    });
                });
                return false;
            });
        }

        /**
         * 修改按钮开关值
         * @param layFilter layFilter名称
         * @param url 链接
         */
        this.switch = function (layFilter, url) {
            form.on('switch(' + layFilter + ')', function (obj) {
                $.request.get(url, {id: this.name}, function (res) {
                    $.msg.success(res.msg, function () {
                        $.tool.reload();
                    });
                });
                return false;
            });
        }

        /**
         * 弹出新窗口
         * @param title 标题
         * @param url 链接
         * @param width 宽
         * @param height 高
         */
        this.open = function (title, url, width, height) {
            var index = layui.layer.open({
                title: title,
                type: 2,
                area: [width, height],
                content: url,
                success: function (layero, index) {
                    var body = layui.layer.getChildFrame('body', index);
                }
            })
            if (width == undefined || height == undefined) {
                layui.layer.full(index);
            }
        }
    }

    /**
     * 时间插件
     */
    $.laydate = new function () {
        var self = this;
        //年选择器
        this.year = function (elem) {
            laydate.render({elem: '#' + elem, type: 'year'});
        }
        //年月选择器
        this.month = function (elem) {
            laydate.render({elem: '#' + elem, type: 'month'});
        }
        //时间选择器
        this.time = function (elem) {
            laydate.render({elem: '#' + elem, type: 'time'});
        }
        //日期时间选择器
        this.datetime = function (elem) {
            laydate.render({elem: '#' + elem, type: 'datetime'});
        }
        //日期范围
        this.range = function (elem) {
            laydate.render({elem: '#' + elem, range: true});
        }
    }

    /**
     * 封装请求
     */
    $.request = new function () {
        var self = this;
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