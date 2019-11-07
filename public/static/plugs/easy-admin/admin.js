define(["jquery"], function ($) {

    var form = layui.form,
        layer = layui.layer,
        laytpl = layui.laytpl,
        table = layui.table,
        laydate = layui.laydate;

    var admin = {
        config: {
            shade: [0.02, '#000'],
        },
        url: function (url) {
            return '/' + ADMIN + '/' + url;
        },
        request: {
            post: function (option, ok, no, ex) {
                return admin.request.ajax('post', option, ok, no, ex);
            },
            get: function (option, ok, no, ex) {
                return admin.request.ajax('get', option, ok, no, ex);
            },
            ajax: function (type, option, ok, no, ex) {
                type = type || 'get';
                option.url = option.url || '';
                option.data = option.data || {};
                option.prefix = option.prefix || false;
                option.statusName = option.statusName || 'code';
                option.statusCode = option.statusCode || 1;
                ok = ok || function (res) {
                };
                no = no || function (res) {
                    var msg = res.msg == undefined ? '返回数据格式有误' : res.msg;
                    admin.msg.error(msg);
                    return false;
                };
                ex = ex || function (res) {
                };
                if (option.url == '') {
                    admin.msg.error('请求地址不能为空');
                    return false;
                }
                if (option.prefix == true) {
                    option.url = admin.url(option.url);
                }
                var index = admin.msg.loading('加载中');
                $.ajax({
                    url: option.url,
                    type: type,
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    dataType: "json",
                    data: option.data,
                    timeout: 60000,
                    success: function (res) {
                        admin.msg.close(index);
                        if (eval('res.' + option.statusName) == option.statusCode) {
                            return ok(res);
                        } else {
                            return no(res);
                        }
                    },
                    error: function (xhr, textstatus, thrown) {
                        admin.msg.error('Status:' + xhr.status + '，' + xhr.statusText + '，请稍后再试！', function () {
                            ex(this);
                        });
                        return false;
                    }
                });
            }
        },
        msg: {
            // 成功消息
            success: function (msg, callback) {
                if (callback == undefined) {
                    callback = function () {
                    }
                }
                var index = layer.msg(msg, {icon: 1, shade: admin.config.shade, scrollbar: false, time: 2000, shadeClose: true}, callback);
                return index;
            },
            // 失败消息
            error: function (msg, callback) {
                if (callback == undefined) {
                    callback = function () {
                    }
                }
                var index = layer.msg(msg, {icon: 2, shade: admin.config.shade, scrollbar: false, time: 3000, shadeClose: true}, callback);
                return index;
            },
            // 警告消息框
            alert: function (msg, callback) {
                var index = layer.alert(msg, {end: callback, scrollbar: false});
                return index;
            },
            // 对话框
            confirm: function (msg, ok, no) {
                var index = layer.confirm(msg, {title: '操作确认', btn: ['确认', '取消']}, function () {
                    typeof ok === 'function' && ok.call(this);
                }, function () {
                    typeof no === 'function' && no.call(this);
                    self.close(index);
                });
                return index;
            },
            // 消息提示
            tips: function (msg, time, callback) {
                var index = layer.msg(msg, {time: (time || 3) * 1000, shade: this.shade, end: callback, shadeClose: true});
                return index;
            },
            // 加载中提示
            loading: function (msg, callback) {
                var index = msg ? layer.msg(msg, {icon: 16, scrollbar: false, shade: this.shade, time: 0, end: callback}) : layer.load(2, {time: 0, scrollbar: false, shade: this.shade, end: callback});
                return index;
            },
            // 关闭消息框
            close: function (index) {
                return layer.close(index);
            }
        },
        table: {
            tool: function (data, option) {
                option.operat = option.operat || [];
                var html = '';
                $.each(option.operat, function (i, v) {
                    // 初始化数据
                    v.class = v.class || '';
                    v.text = v.text || '';
                    v.event = v.event || '';
                    v.icon = v.icon || '';
                    v.open = v.open || '';
                    v.title = v.title || v.text || '';
                    v.extend = v.extend || '';
                    // 组合数据
                    v.icon = v.icon != '' ? '<i class="' + v.icon + '"></i>' : '';
                    v.class = v.class != '' ? 'class="' + v.class + '" ' : '';
                    v.open = v.open != '' ? 'data-open="' + v.open + '" data-title="' + v.title + '" ' : '';
                    v.event = v.event != '' ? 'lay-event="' + v.event + '" ' : '';
                    html += '<a ' + v.class + v.open + v.event + v.extend + '>' + v.icon + v.text + '</a>';
                });
                return html;
            },
            switch: function (data, option) {
                option.filter = option.filter || option.field || null;
                option.checked = option.checked || 1;
                option.tips = option.tips || '开|关';
                var checked = data.status == option.checked ? 'checked' : '';
                return '<input type="checkbox" name="' + option.field + '" value="' + data.id + '" lay-skin="switch" lay-text="' + option.tips + '" lay-filter="' + option.filter + '" ' + checked + ' >';
            },
            listenSwitch: function (option, ok) {
                option.filter = option.filter || '';
                option.url = option.url || '';
                option.field = option.field || option.filter || '';
                option.tableName = option.tableName || 'currentTable';
                form.on('switch(' + option.filter + ')', function (obj) {
                    var checked = obj.elem.checked ? 1 : 0;
                    if (typeof ok === 'function') {
                        return ok({
                            id: obj.value,
                            checked: checked,
                        });
                    } else {
                        var data = {
                            id: obj.value,
                            field: option.field,
                            value: checked,
                        };
                        admin.request.post({
                            url: option.url,
                            prefix: true,
                            data: data,
                        }, function (res) {
                        }, function (res) {
                            admin.msg.error(res.msg, function () {
                                table.reload(option.tableName);
                            });
                        }, function () {
                            table.reload(option.tableName);
                        });
                    }
                });
            }
        },
        checkMobile: function () {
            var userAgentInfo = navigator.userAgent;
            var mobileAgents = ["Android", "iPhone", "SymbianOS", "Windows Phone", "iPad", "iPod"];
            var mobile_flag = false;
            //根据userAgent判断是否是手机
            for (var v = 0; v < mobileAgents.length; v++) {
                if (userAgentInfo.indexOf(mobileAgents[v]) > 0) {
                    mobile_flag = true;
                    break;
                }
            }
            var screen_width = window.screen.width;
            var screen_height = window.screen.height;
            //根据屏幕分辨率判断是否是手机
            if (screen_width < 600 && screen_height < 800) {
                mobile_flag = true;
            }
            return mobile_flag;
        },
        open: function (title, url, width, height, isResize) {
            if (isResize == undefined) isResize = true;
            var index = layui.layer.open({
                title: title,
                type: 2,
                area: [width, height],
                content: url,
                success: function (layero, index) {
                    var body = layui.layer.getChildFrame('body', index);
                }
            });
            if (admin.checkMobile() || width == undefined || height == undefined) {
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
        },
        listen: function (formCallback) {

            // 监听弹出层的打开
            $('body').on('click', '[data-open]', function () {
                admin.open(
                    $(this).attr('data-title'),
                    admin.url($(this).attr('data-open')),
                    $(this).attr('data-width'),
                    $(this).attr('data-height')
                );
            });

            // 监听表单提交事件
            $('body').on('click', '[lay-submit]', function () {
                var filter = $(this).attr('lay-filter'),
                    url = $(this).attr('lay-submit');
                if (url == undefined || url == '' || url == null) {
                    url = window.location.href;
                } else {
                    url = admin.url(url);
                }
                if (filter == undefined || filter == '' || filter == null) {
                    admin.msg.error('请设置lay-filter提交事件');
                    return false;
                }
                form.on('submit(' + filter + ')', function (data) {
                    var dataField = data.field;
                    if (typeof formCallback === 'function') {
                        formCallback(url, dataField);
                    } else {
                        admin.api.form(url, dataField);
                    }
                    return false;
                });
            });
        },
        api: {
            form: function (url, data, ok, no, ex) {
                ok = ok || function (res) {
                    res.msg = res.msg || '';
                    admin.msg.success(res.msg, function () {
                        admin.api.closeCurrentOpen({
                            refreshTable: true
                        });
                    });
                    return false;
                };
                admin.request.post({
                    url: url,
                    data: data,
                }, ok, no, ex);
                return false;
            },
            closeCurrentOpen: function (option) {
                option = option || {};
                option.refreshTable = option.refreshTable|| false;
                option.refreshFrame = option.refreshFrame || false;
                if(option.refreshTable == true){
                    option.refreshTable = 'currentTable';
                }
                var index = parent.layer.getFrameIndex(window.name);
                parent.layer.close(index);
                if (option.refreshTable != false) {
                    parent.layui.table.reload(option.refreshTable);
                }
                if (option.refreshFrame) {
                    parent.location.reload();
                }
                return false;
            },
            refreshFrame: function () {
                location.reload();
                return false;
            },
            refreshTable: function (tableName) {
                tableName = tableName | 'currentTable';
                table.reload(tableName);
            }
        },
    };
    return admin;
});