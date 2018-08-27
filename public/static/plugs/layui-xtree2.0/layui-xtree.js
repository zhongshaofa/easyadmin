//**********************************
//**   本插件依赖 贤心 layui form模块   
//**   由 小巷 制作 QQ：151446298    
//**   版本3.0 时间 2018-01-10 20:48 
//**********************************

//构造
function layuiXtree(options) {
    var _this = this;
    _this._containerid = options.elem;
    _this._container = document.getElementById(options.elem); //容器
    _this._container.style.minHeight = "100px";
    _this._options = options;
    _this.Loading(options);
}

//封装IE8 Class选择
layuiXtree.prototype.getByClassName = function (cn) {
    if (document.getElementsByClassName) return this._container.getElementsByClassName(cn);
    var _xlist = this._container.childNodes;
    var _xtemp = new Array();
    for (var i = 0; i < _xlist.length; i++) {
        var _xchild = _xlist[i];
        var _xclassNames = _xchild.getAttribute('class').split(' ');
        for (var j = 0; j < _xclassNames.length; j++) {
            if (_xclassNames[j] == cn) {
                _xtemp.push(_xchild);
                break;
            }
        }
    }
    return _xtemp;
}

//在一个对象下面找子级
layuiXtree.prototype.getChildByClassName = function (obj, cn) {
    var _xlist = obj.childNodes;
    var _xtemp = new Array();
    for (var i = 0; i < _xlist.length; i++) {
        var _xchild = _xlist[i];
        var _xclassNames = _xchild.getAttribute('class').split(' ');
        for (var j = 0; j < _xclassNames.length; j++) {
            if (_xclassNames[j] == cn) {
                _xtemp.push(_xchild);
                break;
            }
        }
    }
    return _xtemp;
}

//加载特效，且获取数据
layuiXtree.prototype.Loading = function (options) {
    var _this = this;
    _this.xloading = document.createElement("span"); //创建加载对象
    _this.xloading.setAttribute('class', 'layui-icon layui-anim layui-anim-rotate layui-anim-loop');
    _this.xloading.innerHTML = '&#xe63e;';
    _this.xloading.style.fontSize = "50px";
    _this.xloading.style.color = "#009688";
    _this.xloading.style.fontWeight = "bold";
    _this.xloading.style.marginLeft = _this._container.offsetWidth / 2 - 25 + 'px';
    _this.xloading.style.marginTop = _this._container.offsetHeight / 2 - 50 + 'px';
    _this._container.innerHTML = '';
    _this._container.appendChild(_this.xloading); //加载显示
    if (typeof (options.data) == 'object') {
        _this._dataJson = options.data;
        _this.Initial(options);
        return;
    }

    //如果是字符串url，进行异步加载
    var obj = new XMLHttpRequest();
    obj.open('get', options.data, true);
    obj.onreadystatechange = function () {
        if (obj.readyState == 4 && obj.status == 200 || obj.status == 304) { //回调成功
            _this._dataJson = eval('(' + obj.responseText + ')'); //将返回的数据转为json
            _this.Initial(options);
        }
    };
    obj.send();
}

//data验证后的数据初始化
layuiXtree.prototype.Initial = function (o) {
    var _this = this;
    _this._form = o.form; //layui from对象
    _this._domStr = "";  //结构字符串
    _this._isopen = o.isopen != null ? o.isopen : true;
    if (o.color == null) o.color = { open: '#2F4056', close: '#2F4056', end: '#2F4056' };//图标颜色
    _this._iconOpenColor = o.color.open != null ? o.color.open : "#2F4056";
    _this._iconCloseColor = o.color.close != null ? o.color.close : "#2F4056";
    _this._iconEndColor = o.color.end != null ? o.color.end : "#2F4056";
    if (o.icon == null) o.icon = { open: '&#xe625;', close: '&#xe623;', end: '&#xe621;' };//图标样式
    _this._iconOpen = o.icon.open != null ? o.icon.open : '&#xe625;';
    _this._iconClose = o.icon.close != null ? o.icon.close : '&#xe623;';
    _this._iconEnd = o.icon.end != null ? o.icon.end : '&#xe621;';
    _this._click = o.click != null ? o.click : function () { };
    _this._ckall = o.ckall != null ? o.ckall : false;  //全选是否启用
    _this._ckallSuccess = o.ckallback != null ? o.ckallback : function () { };//全选回调
    _this.CreateCkAll();
    _this.dataBind(_this._dataJson);
    _this.Rendering();
}

//全选框
layuiXtree.prototype.CreateCkAll = function () {
    var _this = this;
    if (_this._ckall) {
        _this._domStr += '<div class="layui-xtree-item">';
        _this._domStr += '<input type="checkbox" class="layui-xtree-checkbox layui-xtree-ckall" title="全选" lay-skin="primary" lay-filter="xtreeckall' + _this._containerid + '">';
        _this._domStr += '</div>';
    }
}

//生产结构
layuiXtree.prototype.dataBind = function (d) {
    var _this = this;
    if (d.length > 0) {
        for (i in d) {
            var xtree_isend = '';
            var xtree_ischecked = '';
            var xtree_isdisabled = d[i].disabled ? ' disabled="disabled" ' : '';
            _this._domStr += '<div class="layui-xtree-item">';
            if (d[i].data.length > 0)
                _this._domStr += '<i class="layui-icon layui-xtree-icon" data-xtree="' + (_this._isopen ? '1' : '0') + '">' + (_this._isopen ? _this._iconOpen : _this._iconClose) + '</i>';
            else {
                _this._domStr += '<i class="layui-icon layui-xtree-icon-null">' + _this._iconEnd + '</i>';
                xtree_isend = 'data-xend="1"';
                xtree_ischecked = d[i].checked ? ' checked ' : '';
                xtree_isdisabled = d[i].disabled ? ' disabled="disabled" ' : '';
            }
            _this._domStr += '<input type="checkbox" class="layui-xtree-checkbox" ' + xtree_isend + xtree_ischecked + xtree_isdisabled + ' value="' + d[i].value + '" title="' + d[i].title + '" lay-skin="primary" lay-filter="xtreeck' + _this._containerid + '">';
            _this.dataBind(d[i].data);
            _this._domStr += '</div>';
        }
    }
}

//渲染呈现
layuiXtree.prototype.Rendering = function () {
    var _this = this;
    _this._container.innerHTML = _this._domStr;
    _this._domStr = "";

    //检查选中状态
    var xtree_ckitems = _this.getByClassName('layui-xtree-checkbox');
    for (var i = 0; i < xtree_ckitems.length; i++) {
        if (xtree_ckitems[i].getAttribute('data-xend') == '1' && xtree_ckitems[i].checked) {
            _this.ParentCheckboxChecked(xtree_ckitems[i]);
        }
    }

    _this._form.render('checkbox'); //layui渲染

    var xtree_items = _this.getByClassName('layui-xtree-item');
    var xtree_icons = _this.getByClassName('layui-xtree-icon');
    var xtree_nullicons = _this.getByClassName('layui-xtree-icon-null');

    for (var i = 0; i < xtree_items.length; i++) {
        if (xtree_items[i].parentNode == _this._container)
            xtree_items[i].style.margin = '5px 0 0 10px';
        else {
            xtree_items[i].style.margin = '5px 0 0 45px';
            if (!_this._isopen) xtree_items[i].style.display = 'none';
        }
    }

    for (var i = 0; i < xtree_icons.length; i++) {
        xtree_icons[i].style.position = "relative";
        xtree_icons[i].style.top = "3px";
        xtree_icons[i].style.margin = "0 5px 0 0";
        xtree_icons[i].style.fontSize = "18px";
        xtree_icons[i].style.color = _this._isopen ? _this._iconOpenColor : _this._iconCloseColor;
        xtree_icons[i].style.cursor = "pointer";

        xtree_icons[i].onclick = function () {
            var xtree_chi = this.parentNode.childNodes;
            if (this.getAttribute('data-xtree') == 1) {
                for (var j = 0; j < xtree_chi.length; j++) {
                    if (xtree_chi[j].getAttribute('class') == 'layui-xtree-item')
                        xtree_chi[j].style.display = 'none';
                }
                this.setAttribute('data-xtree', '0')
                this.innerHTML = _this._iconClose;
                this.style.color = _this._iconCloseColor;
            } else {
                for (var j = 0; j < xtree_chi.length; j++) {
                    if (xtree_chi[j].getAttribute('class') == 'layui-xtree-item')
                        xtree_chi[j].style.display = 'block';
                }
                this.setAttribute('data-xtree', '1')
                this.innerHTML = _this._iconOpen;
                this.style.color = _this._iconOpenColor;
            }
        }
    }

    for (var i = 0; i < xtree_nullicons.length; i++) {
        xtree_nullicons[i].style.position = "relative";
        xtree_nullicons[i].style.top = "3px";
        xtree_nullicons[i].style.margin = "0 5px 0 0";
        xtree_nullicons[i].style.fontSize = "18px";
        xtree_nullicons[i].style.color = _this._iconEndColor;
    }

    _this._form.on('checkbox(xtreeck' + _this._containerid + ')', function (da) {
        //获取当前点击复选框的容器下面的所有子级容器 
        var xtree_chis = da.elem.parentNode.getElementsByClassName('layui-xtree-item');
        //遍历它们，选中状态与它们的父级一致（类似全选功能）
        for (var i = 0; i < xtree_chis.length; i++) {
            if (!_this.getChildByClassName(xtree_chis[i], 'layui-xtree-checkbox')[0].disabled) {
                _this.getChildByClassName(xtree_chis[i], 'layui-xtree-checkbox')[0].checked = da.elem.checked;
                if (da.elem.checked) _this.getChildByClassName(xtree_chis[i], 'layui-xtree-checkbox')[0].nextSibling.classList.add('layui-form-checked');
                else _this.getChildByClassName(xtree_chis[i], 'layui-xtree-checkbox')[0].nextSibling.classList.remove('layui-form-checked');
            }
        }
        _this.ParendCheck(da.elem);
        _this._click(da);
    });

    var _xtree_disableds = _this.getByClassName('layui-disabled');
    for (var i = 0; i < _xtree_disableds.length; i++) {
        _xtree_disableds[i].getElementsByTagName('span')[0].style.color = "#B5B5B5";
    }

    //全选按钮
    if (_this._ckall) {
        _this._form.on('checkbox(xtreeckall' + _this._containerid + ')', function (data) {
            var xtree_allck = data.elem.parentNode.parentNode.getElementsByClassName('layui-form-checkbox');
            for (var i = 0; i < xtree_allck.length; i++) {
                if (xtree_allck[i].getAttribute('class').indexOf('layui-checkbox-disbaled') == -1) {
                    if (data.elem.checked) {
                        xtree_allck[i].classList.add('layui-form-checked');
                    }
                    else {
                        xtree_allck[i].classList.remove('layui-form-checked');
                    }
                    xtree_allck[i].parentNode.getElementsByClassName('layui-xtree-checkbox')[0].checked = data.elem.checked;
                }
            }
            _this._ckallSuccess();
        });
    }
}

//更新渲染
layuiXtree.prototype.render = function () {
    var _this = this;
    _this.Loading(_this._options);
}

//子节点选中改变，父节点更改自身状态
layuiXtree.prototype.ParendCheck = function (ckelem) {
    var _this = this;
    var xtree_p = ckelem.parentNode.parentNode;
    if (xtree_p.getAttribute('class') == 'layui-xtree-item') {
        var xtree_all = _this.getChildByClassName(xtree_p, 'layui-xtree-item');
        var xtree_count = 0;

        for (var i = 0; i < xtree_all.length; i++) {
            if (_this.getChildByClassName(xtree_all[i], 'layui-xtree-checkbox')[0].checked) {
                xtree_count++;
            }
        }

        if (xtree_count <= 0) {
            _this.getChildByClassName(xtree_p, 'layui-xtree-checkbox')[0].checked = false;
            _this.getChildByClassName(xtree_p, 'layui-xtree-checkbox')[0].nextSibling.classList.remove('layui-form-checked');
        } else {
            _this.getChildByClassName(xtree_p, 'layui-xtree-checkbox')[0].checked = true;
            _this.getChildByClassName(xtree_p, 'layui-xtree-checkbox')[0].nextSibling.classList.add('layui-form-checked');
        }
        this.ParendCheck(_this.getChildByClassName(xtree_p, 'layui-xtree-checkbox')[0]);
    }
}

//渲染之前按照选中的末级去改变父级选中状态
layuiXtree.prototype.ParentCheckboxChecked = function (e) {
    var _this = this;
    if (e.parentNode.parentNode.getAttribute('class') == 'layui-xtree-item') {
        var _pe = _this.getChildByClassName(e.parentNode.parentNode, 'layui-xtree-checkbox')[0];
        _pe.checked = true;
        _this.ParentCheckboxChecked(_pe);
    }
}

//获取全部选中的末级checkbox对象
layuiXtree.prototype.GetChecked = function () {
    var _this = this;
    var arr = new Array();
    var arrIndex = 0;
    var cks = _this.getByClassName('layui-xtree-checkbox');
    for (var i = 0; i < cks.length; i++) {
        if (cks[i].checked && cks[i].getAttribute('data-xend') == '1') {
            arr[arrIndex] = cks[i]; arrIndex++;
        }
    }
    return arr;
}

//获取全部的原始checkbox对象
layuiXtree.prototype.GetAllCheckBox = function () {
    var _this = this;
    var arr = new Array();
    var arrIndex = 0;
    var cks = _this.getByClassName('layui-xtree-checkbox');
    for (var i = 0; i < cks.length; i++) {
        arr[arrIndex] = cks[i]; arrIndex++;
    }
    return arr;
}

//根据值来获取其父级的checkbox原dom对象
layuiXtree.prototype.GetParent = function (a) {
    var _this = this;
    var cks = _this.getByClassName('layui-xtree-checkbox');
    for (var i = 0; i < cks.length; i++) {
        if (cks[i].value == a) {
            if (cks[i].parentNode.parentNode.getAttribute('id') == _this._container.getAttribute('id')) return null;
            return _this.getChildByClassName(cks[i].parentNode.parentNode, 'layui-xtree-checkbox')[0];
        }
    }
    return null;
}