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
     * 注册 data-upload-image 事件
     * 表单图片上传
     */
    $body.on('click', '[data-upload-image]', function () {
        var upload_type = $(this).attr('data-upload-image'),
            upload_id = $(this).attr('data-upload-id'),
            upload_class = $(this).attr('class'),
            upload_src = $(this).attr('src'),
            upload_style = $(this).attr('style'),
            upload_url = '/blog/tool.upload/image',
            divId = $(this).attr('data-upload-div');
        if (upload_type == 'one') {
            var title = '上传单图片';
            var url = upload_url + "?type=one";
        } else {
            var title = '上传多图片';
            var url = upload_url + "?type=multi";
        }
        var uploadImage = layer.open({
            title: title,
            type: 2,
            area: ['700px', '450px'],
            content: url,
            success: function (layero, selectIcon) {
                var body = layer.getChildFrame('body', uploadImage);
            },
            end: function () {
                var upload_iamges = window.sessionStorage.getItem("upload_iamges");
                console.log(upload_iamges);
                if (upload_iamges != null) {
                    if (upload_type == 'one') {
                        $('#' + upload_id).attr('value', upload_iamges);
                        $(this).attr('src', upload_iamges);

                        //获取隐藏的div
                        var upload_id_html = '<input type="hidden" id="' + upload_id + '" value="' + upload_iamges + '">';
                        //重新渲染显示层
                        var upload_image_html = '<div class="' + upload_class + '" data-upload-image="one" data-upload-id="' + upload_id + '" data-upload-div="' + divId + '" style="background-image: url(' + upload_iamges + ');"> </div>';

                        //插入到html内
                        var uploadDiv = document.getElementById(divId);
                        uploadDiv.innerHTML = upload_id_html + upload_image_html;

                    } else {
                        var upload_url = $('#' + upload_id).attr('value');
                        if (upload_url == '') {
                            $('#' + upload_id).attr('value', upload_iamges);
                        } else {
                            upload_iamges = upload_url + '|' + upload_iamges;
                            $('#' + upload_id).attr('value',);
                        }

                        var uploadDiv = document.getElementById(divId);
                        var upload_id_html = '<input type="hidden" id="' + upload_id + '" value="' + upload_iamges + '">';
                        var upload_image_html = '<div class="' + upload_class + '" data-upload-image="more" data-upload-id="' + upload_id + '" data-upload-div="' + divId + '" style="' + upload_style + '"> </div>';
                        var html = '';

                        //切割图片重新生成写入
                        arr = upload_iamges.split("|");
                        arr.forEach(function (value, i) {
                            html = html + '<div class="' + upload_class + '" data-upload-url="' + value + '" style="background-image: url(' + value + ');"> <em class="layui-icon upload-icon-tip" style="float: right; display: none;">&#x1006;</em> </div>';
                        });

                        uploadDiv.innerHTML = upload_id_html + html + upload_image_html;
                        $.form.imageListen();
                    }
                }
                window.sessionStorage.removeItem("upload_iamges");
            }
        })
        return false;
    });

    /**
     * 表单初始化
     */
    $.form = new function () {

        /**
         * 渲染图片列表
         * @param type
         */
        this.imageRender = function (divId, type = 'one') {
            var $uploadParent = $("#" + divId);
            var $inputParent = $uploadParent.children('input');
            var $parent = $uploadParent.children('div');
            var url = $inputParent.attr('value');
            console.log(url);
            if (url == '' || url == undefined) return false;
            if (type == 'one') {
                var style = 'background-image: url("' + url + '");';
                $parent.attr('style', style);
                $parent.attr('data-upload-image', 'one');
            }
            else {
                var url_array = url.split("|"); //所有图片url数组
                var upload_id = $inputParent.attr('id');
                var upload_class = $parent.attr('class');
                var upload_style = $parent.attr('style');
                var uploadDiv = document.getElementById(divId);
                var upload_id_html = '<input type="hidden" id="' + upload_id + '" value="' + url + '">';
                var upload_image_html = '<div class="' + upload_class + '" data-upload-image="more" data-upload-id="' + upload_id + '" data-upload-div="' + divId + '" style="' + upload_style + '"> </div>';
                var html = '';
                //对新的所有图片url进行重新拼接
                $.each(url_array, function (index, value, arr) {
                    html = html + '<div class="' + upload_class + '" data-upload-url="' + value + '" style="background-image: url(' + value + ');"> <em class="layui-icon upload-icon-tip" style="float: right; display: none;">&#x1006;</em> </div>';
                })
                uploadDiv.innerHTML = upload_id_html + html + upload_image_html;
            }
            $.form.imageListen();
            return false;
        }

        /**
         * 上传图片监听器
         * @param id
         */
        this.imageListen = function (id) {
            //对删除图片的显示隐藏操作
            $(".uploadimage").hover(function () {
                $(this).children('em').show();
            }, function () {
                $(this).children('em').hide();
            })

            //删除图片操作
            $('.upload-icon-tip').on('click', function () {
                //获取操作元素对象
                var $parent = $(this).parent('div');
                var $uploadParent = $parent.parent('div');
                var $inputParent = $uploadParent.children('input');

                var current_upload_url = $parent.attr('data-upload-url'); //当前图片url
                var all_upload_url = $inputParent.attr('value'); //所有图片url
                var all_upload_url_array = all_upload_url.split("|"); //所有图片url数组
                var all_upload_url_new = ''; //新的所有图片url

                //对新的所有图片url进行重新拼接
                $.each(all_upload_url_array, function (index, vaule, arr) {
                    if (vaule != current_upload_url) {
                        if (all_upload_url_new == '') {
                            all_upload_url_new = vaule;
                        } else {
                            all_upload_url_new = all_upload_url_new + '|' + vaule;
                        }
                    }
                })

                //进行图片删除操作
                var dialogIndex = $.msg.confirm('确定要移除这张图片吗？', function () {
                    $inputParent.attr('value', all_upload_url_new);
                    $parent.remove();
                    $.msg.close(dialogIndex);
                });
            });
        }

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