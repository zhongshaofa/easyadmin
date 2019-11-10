define(["jquery"], function ($) {

    var form = layui.form,
        layer = layui.layer,
        laytpl = layui.laytpl,
        table = layui.table,
        laydate = layui.laydate,
        upload = layui.upload;

    var init = {
        table_elem: 'currentTable',
        table_render_id: 'currentTableRenderId',
        upload_url: 'ajax/upload',
        upload_exts: 'doc|gif|ico|icon|jpg|mp3|mp4|p12|pem|png|rar',
    };

    var admin = {
        config: {
            shade: [0.02, '#000'],
        },
        url: function (url) {
            return '/' + ADMIN + '/' + url;
        },
        parame: function (param, defaultParam) {
            return param != undefined ? param : defaultParam;
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
            render: function (options) {
                options.elem = options.elem || '#' + init.table_elem;
                options.init = options.init || init;
                options.id = options.id || init.table_render_id;
                options.layFilter = options.id + '_LayFilter';
                options.url = options.url || window.location.href;
                options.toolbar = options.toolbar || '#toolbar';
                options.page = admin.parame(options.page, true);
                options.search = admin.parame(options.search, true);
                options.limit = options.limit || 15;
                options.limits = options.limits || [10, 15, 20, 25, 50, 100];
                options.defaultToolbar = options.defaultToolbar || ['filter', {
                    title: '搜索表格',
                    layEvent: 'TABLE_SEARCH',
                    icon: 'layui-icon-search',
                    extend: 'data-table-id="' + options.id + '"'
                }];

                // 初始化表格lay-filter
                $(options.elem).attr('lay-filter', options.layFilter);

                // 初始化表格搜索
                options.toolbar = options.toolbar || ['refresh', 'add', 'delete'];
                if (options.search == true) {
                    admin.table.renderSearch(options.cols, options.elem, options.id);
                }
                // 初始化表格左上方工具栏
                options.toolbar = admin.table.renderToolbar(options.toolbar, options.elem, options.id, options.init);
                var newTable = table.render(options);

                // 监听表格搜索开关显示
                admin.table.listenToolbar(options.layFilter, options.id);

                // 监听表格开关切换
                admin.table.renderSwitch(options.cols, options.init);

                return newTable;
            },
            renderToolbar: function (data, elem, tableId, init) {
                data = data || [];
                var toolbarHtml = '';
                $.each(data, function (i, v) {
                    if (v == 'refresh') {
                        toolbarHtml += ' <button class="layui-btn layui-btn-sm layuimini-btn-primary" data-table-refresh="' + tableId + '"><i class="fa fa-refresh"></i> </button>\n';
                    } else if (v == 'add') {
                        toolbarHtml += '<button class="layui-btn layui-btn-sm" data-open="' + init.add_url + '" data-title="添加"><i class="layui-icon layui-icon-add-circle-fine"></i>添加</button>\n';
                    } else if (v == 'delete') {
                        toolbarHtml += '<button class="layui-btn layui-btn-sm layui-btn-danger" data-url="' + init.del_url + '" data-table-delete="' + tableId + '"><i class="layui-icon layui-icon-delete"></i>删除</button>\n';
                    } else if (typeof v == "object") {
                        $.each(v, function (ii, vv) {
                            vv.class = vv.class || '';
                            vv.text = vv.text || '';
                            vv.icon = vv.icon || '';
                            vv.open = vv.open || '';
                            vv.title = vv.title || vv.text || '';
                            vv.extend = vv.extend || '';
                            // 组合数据
                            vv.icon = vv.icon != '' ? '<i class="' + vv.icon + '"></i>' : '';
                            vv.class = vv.class != '' ? 'class="' + vv.class + '" ' : '';
                            vv.open = vv.open != '' ? 'data-open="' + vv.open + '" data-title="' + vv.title + '" ' : '';
                            toolbarHtml += '<button ' + vv.class + vv.open + vv.request + vv.event + vv.extend + '>' + vv.icon + vv.text + '</button>\n';
                        });
                    }
                });
                return '<div>' + toolbarHtml + '</div>';
            },
            renderSearch: function (cols, elem, tableId) {
                // TODO 只初始化第一个table搜索字段，如果存在多个(绝少数需求)，得自己去扩展
                cols = cols[0] || {};
                var newCols = [];
                var formHtml = '';
                $.each(cols, function (i, d) {
                    d.field = d.field || false;
                    d.fieldAlias = admin.parame(d.fieldAlias, d.field);
                    d.title = d.title || d.field || '';
                    d.selectList = d.selectList || {};
                    d.search = admin.parame(d.search, true);
                    d.searchTip = d.searchTip || '请输入' + d.title || '';
                    d.searchValue = d.searchValue || '';
                    d.searchOp = d.searchOp || '%*%';
                    d.timeType = d.timeType || 'date';
                    if (d.field != false && d.search != false) {
                        switch (d.search) {
                            case true:
                                formHtml += '\t<div class="layui-form-item layui-inline">\n' +
                                    '<label class="layui-form-label">' + d.title + '</label>\n' +
                                    '<div class="layui-input-inline">\n' +
                                    '<input id="c-' + d.fieldAlias + '" name="' + d.fieldAlias + '" data-search-op="' + d.searchOp + '" value="' + d.searchValue + '" placeholder="' + d.searchTip + '" class="layui-input">\n' +
                                    '</div>\n' +
                                    '</div>';
                                break;
                            case  'select':
                                d.searchOp = '=';
                                var selectHtml = '';
                                $.each(d.selectList, function (sI, sV) {
                                    var selected = '';
                                    if (sI == d.searchValue) {
                                        selected = 'selected=""';
                                    }
                                    selectHtml += '<option value="' + sI + '" ' + selected + '>' + sV + '</option>/n';
                                });
                                formHtml += '\t<div class="layui-form-item layui-inline">\n' +
                                    '<label class="layui-form-label">' + d.title + '</label>\n' +
                                    '<div class="layui-input-inline">\n' +
                                    '<select class="layui-select" id="c-' + d.fieldAlias + '" name="' + d.fieldAlias + '"  data-search-op="' + d.searchOp + '" >\n' +
                                    '<option value="">- 全部 -</option> \n' +
                                    selectHtml +
                                    '</select>\n' +
                                    '</div>\n' +
                                    '</div>';
                                break;
                            case 'range':
                                d.searchOp = 'range';
                                formHtml += '\t<div class="layui-form-item layui-inline">\n' +
                                    '<label class="layui-form-label">' + d.title + '</label>\n' +
                                    '<div class="layui-input-inline">\n' +
                                    '<input id="c-' + d.fieldAlias + '" name="' + d.fieldAlias + '"  data-search-op="' + d.searchOp + '"  value="' + d.searchValue + '" placeholder="' + d.searchTip + '" class="layui-input">\n' +
                                    '</div>\n' +
                                    '</div>';
                                break;
                            case 'time':
                                d.searchOp = '=';
                                formHtml += '\t<div class="layui-form-item layui-inline">\n' +
                                    '<label class="layui-form-label">' + d.title + '</label>\n' +
                                    '<div class="layui-input-inline">\n' +
                                    '<input id="c-' + d.fieldAlias + '" name="' + d.fieldAlias + '"  data-search-op="' + d.searchOp + '"  value="' + d.searchValue + '" placeholder="' + d.searchTip + '" class="layui-input">\n' +
                                    '</div>\n' +
                                    '</div>';
                                break;
                        }
                        newCols.push(d);
                    }
                });
                if (formHtml != '') {

                    $(elem).before('<fieldset id="searchFieldset_' + tableId + '" class="table-search-fieldset layui-hide">\n' +
                        '<legend>条件搜索</legend>\n' +
                        '<form class="layui-form layui-form-pane">\n' +
                        formHtml +
                        '<div class="layui-form-item layui-inline">\n' +
                        '<button type="submit" class="layui-btn layui-btn-primary" data-type="tableSearch" data-table-search="' + tableId + '" lay-submit lay-filter="' + tableId + '_filter"><i class="layui-icon">&#xe615;</i> 搜 索</button>\n' +
                        ' </div>' +
                        '</form>' +
                        '</fieldset>');

                    // 初始化form表单
                    form.render();
                    $.each(newCols, function (ncI, ncV) {
                        if (ncV.search == 'range') {
                            laydate.render({range: true, type: ncV.timeType, elem: '[name="' + ncV.field + '"]'});
                        }
                        if (ncV.search == 'time') {
                            laydate.render({type: ncV.timeType, elem: '[name="' + ncV.field + '"]'});
                        }
                    });
                }
            },
            renderSwitch: function (cols, tableInit, tableId) {
                tableInit.modify_url = tableInit.modify_url || false;
                cols = cols[0] || {};
                tableId = tableId || init.table_render_id;
                if (cols.length > 0) {
                    $.each(cols, function (i, v) {
                        v.filter = v.filter || false;
                        if (v.filter != false && tableInit.modify_url != false) {
                            admin.table.listenSwitch({filter: v.filter, url: tableInit.modify_url, tableId: tableId});
                        }
                    });
                }
            },
            tool: function (data, option) {
                option.operat = option.operat || ['edit', 'delete'];
                var html = '';
                $.each(option.operat, function (i, v) {
                    if (v == 'edit' || v == 'delete') {
                        var vv = {};
                        if (v == 'edit') {
                            vv = {
                                class: 'layui-btn layui-btn-xs',
                                text: '编辑',
                                open: option.init.edit_url,
                                extend: ""
                            };
                        } else {
                            vv = {
                                class: 'layui-btn layui-btn-danger layui-btn-xs',
                                text: '删除',
                                title: '确定删除？',
                                request: option.init.del_url,
                                extend: ""
                            };
                        }
                        // 初始化数据
                        vv.class = vv.class || '';
                        vv.text = vv.text || '';
                        vv.event = vv.event || '';
                        vv.icon = vv.icon || '';
                        vv.open = vv.open || '';
                        vv.request = vv.request || '';
                        vv.title = vv.title || vv.text || '';
                        vv.extend = vv.extend || '';
                        if (vv.open != '') {
                            vv.open = vv.open.indexOf("?") != -1 ? vv.open + '&id=' + data.id : vv.open + '?id=' + data.id;
                        }
                        if (vv.request != '') {
                            vv.request = vv.request.indexOf("?") != -1 ? vv.request + '&id=' + data.id : vv.request + '?id=' + data.id;
                        }
                        // 组合数据
                        vv.icon = vv.icon != '' ? '<i class="' + vv.icon + '"></i>' : '';
                        vv.class = vv.class != '' ? 'class="' + vv.class + '" ' : '';
                        vv.open = vv.open != '' ? 'data-open="' + vv.open + '" data-title="' + vv.title + '" ' : '';
                        vv.request = vv.request != '' ? 'data-request="' + vv.request + '" data-title="' + vv.title + '" ' : '';
                        vv.event = vv.event != '' ? 'lay-event="' + vv.event + '" ' : '';
                        html += '<a ' + vv.class + vv.open + vv.request + vv.event + vv.extend + '>' + vv.icon + vv.text + '</a>';
                    } else if (typeof v == "object") {
                        $.each(v, function (ii, vv) {
                            // 初始化数据
                            vv.class = vv.class || '';
                            vv.text = vv.text || '';
                            vv.event = vv.event || '';
                            vv.icon = vv.icon || '';
                            vv.open = vv.open || '';
                            vv.request = vv.request || '';
                            vv.title = vv.title || vv.text || '';
                            vv.extend = vv.extend || '';
                            if (vv.open != '') {
                                vv.open = vv.open.indexOf("?") != -1 ? vv.open + '&id=' + data.id : vv.open + '?id=' + data.id;
                            }
                            if (vv.request != '') {
                                vv.request = vv.request.indexOf("?") != -1 ? vv.request + '&id=' + data.id : vv.request + '?id=' + data.id;
                            }
                            // 组合数据
                            vv.icon = vv.icon != '' ? '<i class="' + vv.icon + '"></i>' : '';
                            vv.class = vv.class != '' ? 'class="' + vv.class + '" ' : '';
                            vv.open = vv.open != '' ? 'data-open="' + vv.open + '" data-title="' + vv.title + '" ' : '';
                            vv.request = vv.request != '' ? 'data-request="' + vv.request + '" data-title="' + vv.title + '" ' : '';
                            vv.event = vv.event != '' ? 'lay-event="' + vv.event + '" ' : '';
                            html += '<a ' + vv.class + vv.open + vv.request + vv.event + vv.extend + '>' + vv.icon + vv.text + '</a>';
                        });
                    }
                });
                return html;
            },
            image: function (data, option) {
                option.imageWidth = option.imageWidth || 200;
                option.imageHeight = option.imageHeight || 40;
                option.title = option.title || option.field;
                var src = data[option.field],
                    title = data[option.title];
                return '<img style="max-width: ' + option.imageWidth + 'px; max-height: ' + option.imageHeight + 'px;" src="' + src + '" data-image="' + title + '"  src="' + title + '">';
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
                option.tableId = option.tableId || init.table_render_id;
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
                                table.reload(option.tableId);
                            });
                        }, function () {
                            table.reload(option.tableId);
                        });
                    }
                });
            },
            listenToolbar: function (layFilter, tableId) {
                table.on('toolbar(' + layFilter + ')', function (obj) {

                    // 搜索表单的显示
                    switch (obj.event) {
                        case 'TABLE_SEARCH':
                            var searchFieldsetId = 'searchFieldset_' + tableId;
                            var _that = $("#" + searchFieldsetId);
                            if (_that.hasClass("layui-hide")) {
                                _that.removeClass('layui-hide').animate({'opacity': '0.3%'}, 800);
                            } else {
                                _that.addClass('layui-hide').animate({'opacity': '0.3%'}, 800);
                            }
                            break;
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
        listen: function (formCallback, ok, no, ex) {

            // 初始化图片显示以及监听上传事件
            admin.api.upload();

            // 监听弹出层的打开
            $('body').on('click', '[data-open]', function () {
                admin.open(
                    $(this).attr('data-title'),
                    admin.url($(this).attr('data-open')),
                    $(this).attr('data-width'),
                    $(this).attr('data-height')
                );
            });

            // 放大图片
            $('body').on('click', '[data-image]', function () {
                var title = $(this).attr('data-image'),
                    src = $(this).attr('src'),
                    alt = $(this).attr('alt');
                var photos = {
                    "title": title,
                    "id": Math.random(),
                    "data": [
                        {
                            "alt": alt,
                            "pid": Math.random(),
                            "src": src,
                            "thumb": src
                        }
                    ]
                };
                layer.photos({
                    photos: photos,
                    anim: 5
                });
                return false;
            });


            // 监听动态表格刷新
            $('body').on('click', '[data-table-refresh]', function () {
                var tableId = $(this).attr('data-table-refresh');
                if (tableId == undefined || tableId == '' || tableId == null) {
                    tableId = init.table_render_id;
                }
                table.reload(tableId);
            });

            // 监听请求
            $('body').on('click', '[data-request]', function () {
                var title = $(this).attr('data-title'),
                    url = admin.url($(this).attr('data-request'));
                title = title || '确定进行该操作？';
                admin.msg.confirm(title, function () {
                    admin.request.get({
                        url: url,
                    }, function (res) {
                        admin.msg.success(res.msg, function () {
                            table.reload(option.tableName);
                        });
                    })
                });
                return false;
            });

            // 监听表单提交事件
            $('body').on('click', '[lay-submit]', function () {
                var filter = $(this).attr('lay-filter'),
                    url = $(this).attr('lay-submit'),
                    type = $(this).attr('data-type');
                type = type || 'commonSubmit';
                if (type == 'tableSearch') {
                    // 表格搜索重载
                    var tableId = $(this).attr('data-table-search');
                    form.on('submit(' + filter + ')', function (data) {
                        var dataField = data.field;
                        var formatFilter = {},
                            formatOp = {};
                        $.each(dataField, function (key, val) {
                            if (val != '') {
                                formatFilter[key] = val;
                                var op = $('#c-' + key).attr('data-search-op');
                                op = op || '%*%';
                                formatOp[key] = op;
                            }
                        });
                        table.reload(tableId, {
                            page: {
                                curr: 1
                            }
                            , where: {
                                filter: JSON.stringify(formatFilter),
                                op: JSON.stringify(formatOp)
                            }
                        }, 'data');
                        return false;
                    });
                } else {
                    // 普通数据提交
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
                            admin.api.form(url, dataField, ok, no, ex);
                        }
                        return false;
                    });
                }
            });

            // 数据表格多删除
            $('body').on('click', '[data-table-delete]', function () {
                var tableId = $(this).attr('data-table-delete'),
                    url = $(this).attr('data-url');
                tableId = tableId || init.table_render_id;
                url = url != undefined ? admin.url(url) : window.location.href;
                var checkStatus = table.checkStatus(tableId),
                    data = checkStatus.data;
                if (data.length <= 0) {
                    admin.msg.error('请勾选需要删除的数据');
                    return false;
                }
                var ids = [];
                $.each(data, function (i, v) {
                    ids.push(v.id);
                });
                admin.msg.confirm('确定删除？', function () {
                    admin.request.post({
                        url: url,
                        data: {
                            id: ids
                        },
                    }, function (res) {
                        admin.msg.success(res.msg, function () {
                            table.reload(tableId);
                        });
                    });
                });
                return false;
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
                option.refreshTable = option.refreshTable || false;
                option.refreshFrame = option.refreshFrame || false;
                if (option.refreshTable == true) {
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
            },
            upload: function () {
                var uploadList = document.querySelectorAll("a[data-upload]")
                if (uploadList.length > 0) {
                    $.each(uploadList, function (i, v) {
                        var exts = $(this).attr('data-upload-exts'),
                            uploadName = $(this).attr('data-upload'),
                            uploadNumber = $(this).attr('data-upload-number'),
                            uploadSign = $(this).attr('data-upload-sign');
                        exts = exts || init.upload_exts;
                        uploadNumber = uploadNumber || 'one';
                        uploadSign = uploadSign || '|';
                        var elem = "input[name='" + uploadName + "']";

                        // 监听上传事件
                        upload.render({
                            elem: this,
                            url: admin.url(init.upload_url),
                            accept: 'file',
                            exts: exts,
                            done: function (res) {
                                if (res.code == 1) {
                                    var url = res.data.url;
                                    if (uploadNumber != 'one') {
                                        var oldUrl = $(elem).val();
                                        if (oldUrl != '') {
                                            url = oldUrl + uploadSign + url;
                                        }
                                    }
                                    admin.msg.success(res.msg, function () {
                                        $(elem).val(url);
                                        $(elem).trigger("input");
                                    });
                                } else {
                                    admin.msg.error(res.msg);
                                }
                                return false;
                            }
                        });

                        // 监听上传input值变化
                        $(elem).bind("input propertychange", function (event) {
                            var urlString = $(this).val();
                            var urlArray = urlString.split(uploadSign);
                            $('#bing-' + uploadName).remove();
                            if (urlArray.length > 0) {
                                var parant = $(this).parent('div');
                                var liHtml = '';
                                $.each(urlArray, function (i, v) {
                                    liHtml += '<li><a><img src="' + v + '" data-image ></a><small class="uploads-delete-tip bg-red badge" data-upload-delete="' + uploadName + '" data-upload-url="' + v + '" data-upload-sign="' + uploadSign + '">×</small></li>\n';
                                });
                                parant.after('<ul id="bing-' + uploadName + '" class="layui-input-block layuimini-upload-show">\n' + liHtml + '</ul>');
                            }
                        });

                        // 非空初始化图片显示
                        if ($(elem).val() != '') {
                            $(elem).trigger("input");
                        }
                    });

                    // 监听上传文件的删除事件
                    $('body').on('click', '[data-upload-delete]', function () {
                        var uploadName = $(this).attr('data-upload-delete'),
                            deleteUrl = $(this).attr('data-upload-url'),
                            sign = $(this).attr('data-upload-sign');
                        var confirm = admin.msg.confirm('确定删除？', function () {
                            var elem = "input[name='" + uploadName + "']";
                            var currentUrl = $(elem).val();
                            var url = '';
                            if (currentUrl != deleteUrl) {
                                url = currentUrl.replace(sign + deleteUrl, '');
                                $(elem).val(url);
                                $(elem).trigger("input");
                            } else {
                                $(elem).val(url);
                                $('#bing-' + uploadName).remove();
                            }
                            admin.msg.close(confirm);
                        });
                        return false;
                    });
                }
            }
        },
    };
    return admin;
});