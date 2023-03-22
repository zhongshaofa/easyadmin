layui.define(['jquery', 'laytpl', 'layer'], function (e) {
    "use strict";
    var hint = layui.hint(),
        $ = layui.jquery,
        laytpl = layui.laytpl,
        layer = layui.layer,
        module = 'autocomplete',
        filter = 'layui-autocomplete',
        container = 'layui-form-autocomplete',
        container_focus = 'layui-form-autocomplete-focus',
        system = {
            config: {
                template: ['<div class="layui-form-autocomplete">', '<dl class="layui-anim layui-anim-upbit">', '</dl>', '</div>'].join(''),
                layout: ['<dd data-index="{{d.index}}">{{- d.text}}</dd>'].join(''),
                template_txt: '{{d.text}}',
                template_val: '{{d.value}}',
                cache: false
            },
            data: {}
        },
        callback = function () {
            var _self = this,
                _config = _self.config;
            return {
                call: function (handle, params) {
                    if (!_self.handles[handle]) return hint.error(handle + " handle is not defined");
                    _self.handles[handle].call(_self, params)
                }
            }
        },
        job = function (e) {
            var _self = this;
            _self.config = $.extend({}, _self.config, system.config, e);
            _self.render();
        };
    job.prototype.config = {
        response: {
            code: 'code',
            data: 'content'
        },
        request: {
            keywords: 'keywords'
        },
        time_limit: 300,
        pullTimer: null,
        data: {},
        temp_data: {},
        params: {},
        filter: '',
        method: 'get',
        ajaxParams: {}
    }
    job.prototype.render = function () {
        var _self = this, _config = _self.config;
        if (_config.elem = $(_config.elem), _config.where = _config.where || {}, !_config.elem[0]) return _self;
        var _elem = _config.elem,
            _container = _elem.next('.' + container),
            _html = _self.elem = $(laytpl(_config.template).render({}));
        _config.id = _self.id, _container && _container.remove(), _elem.attr('autocomplete', 'off'), _elem.after(_html);
        _self.events()
    }
    job.prototype.pullData = function () {
        var _self = this,
            _config = _self.config,
            _elem = _config.elem,
            _container = _elem.next('.' + container);
        if (!_config.filter) return _self.renderData([]);
        if ((_config.cache || !_config.url) && Object.keys(_config.data).length > 0) return _self.renderData(_config.data);
        var keywords = _config.request.keywords
        var params = {
            t: new Date().getTime()
        }
        params[keywords] = _config.filter;

        var $loading = $('<i class="layui-icon layui-icon-loading layui-anim layui-anim-rotate layui-anim-loop"></i>');
        $.ajax($.extend({
            type: _config.method,
            url: _config.url,
            data: $.extend(params, _config.params instanceof Function ? _config.params() :_config.params),
            contentType: 'text/json,charset=utf-8',
            dataType: "json",
            beforeSend: function () {
                $loading.attr('style', [
                    'position:absolute',
                    'left:' + (_elem.offset().left + _elem.outerWidth() - 20) + 'px',
                    'top:' + _elem.offset().top + 'px',
                    'height:' + _elem.height() + 'px',
                    'line-height:' + _elem.height() + 'px'
                ].join(';'));
                $loading.appendTo('body');
            },
            success: function (resp) {
                $loading.remove();
                return 0 != resp[_config.response.code] ? layer.msg(resp[_config.response.data]) : _config.data = resp[_config.response.data], _self.renderData(_config.data)
            },
            error: function () {
                hint.error("请求失败")
            }
        }, _config.ajaxParams))
    }
    job.prototype.renderData = function (resp) {
        var _self = this,
            _config = _self.config,
            _elem = _config.elem,
            _container = _elem.next('.' + container),
            _dom = _container.find('dl'),
            _list = [];
        _config.temp_data = [];
        layui.each(resp, function (i, e) {
            if (_config.cache) {
                if (e instanceof Object) {
                    layui.each(e, function (_i, _e) {
                        if (_e.toString().toLowerCase().indexOf(_config.filter.toLowerCase()) > -1) {
                            _config.temp_data.push(e), _list.push(laytpl(_config.layout).render({ index: i, text: laytpl(_config.template_txt).render(e) }));
                            return true;
                        }
                    });
                } else {
                    if (e.toString().toLowerCase().indexOf(_config.filter.toLowerCase()) > -1) {
                        _config.temp_data.push(e), _list.push(laytpl(_config.layout).render({ index: i, text: laytpl(_config.template_txt).render(e) }));
                    }
                }
            } else {
                _config.temp_data.push(e), _list.push(laytpl(_config.layout).render({ index: i, text: laytpl(_config.template_txt).render(e) }));
            }
        });
        _dom.html(_list.join('')), _list.length > 0 ? _container.addClass(container_focus) : _container.removeClass(container_focus)
    }
    job.prototype.handles = {
        addData: function (data) {
            var _self = this,
                _config = _self.config;
            if (data instanceof Array) {
                _config.data = _config.data.concat(data)
            } else {
                _config.data.push(data)
            }
        },
        setData: function (data) {
            var _self = this,
                _config = _self.config;
            _config.data = data;
        }
    }
    job.prototype.events = function () {
        var _self = this,
            _config = _self.config,
            _elem = _config.elem,
            _container = _elem.next('.' + container),
            _dom = _container.find('dl');
        _elem.unbind('focus').unbind('input propertychange').on('focus', function () {
            _config.filter = this.value, _self.renderData(_config.data)
        }).on('input propertychange', function (e) {
            var _value = this.value;
            clearTimeout(_config.pullTimer), _config.pullTimer = setTimeout(function () {
                _config.filter = _value, _self.pullData()
            }, _config.time_limit)
        })
        $(document).on('click', function (e) {
            var _target = e.target, _item = _dom.find(_target), _e = _item.length > 0 ? _item.closest('dd') : undefined;
            if (_target === _elem[0]) return false;
            if (_e !== undefined) {
                if (_e.attr('autocomplete-load') !== undefined) return false;
                var curr_data = _config.temp_data[_e.index()]
                _elem.val(laytpl(_config.template_val).render(curr_data)), _config.onselect == undefined || _config.onselect(curr_data)
            }
            _container.removeClass(container_focus);
        })
    }
    system.init = function (e, c) {
        var c = c || {}, _self = this, _elems = $(e ? 'input[lay-filter="' + e + '"]' : 'input[' + filter + ']');
        _elems.each(function (_i, _e) {
            var _elem = $(_e),
                _lay_data = _elem.attr('lay-data');
            try {
                _lay_data = new Function("return " + _lay_data)()
            } catch (ex) {
                return hint.error("autocomplete元素属性lay-data配置项存在语法错误：" + _lay_data)
            }
            var _config = $.extend({ elem: this }, system.config, c, _lay_data);
            _config.url == undefined && (_config.data == undefined || _config.length === 0) && hint.error("autocomplete配置有误，缺少获取数据方式");
            system.render(_config);
        })
    }
    system.render = function (e) {
        var j = new job(e);
        return callback.call(j)
    }
    system.init(), e(module, system);
});