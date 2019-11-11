define(["jquery", "admin", "echarts", "layuimini", "echarts-theme"], function ($, admin, echarts, undefined) {

    var Controller = {
        index: function () {
            var layuimini = layui.layuimini;
            layuimini.init(admin.url('ajax/initAdmin'));
            $('.login-out').on("click", function () {
                admin.request.get({
                    url: 'login/out',
                    prefix: true,
                }, function (res) {
                    admin.msg.success(res.msg, function () {
                        window.location = admin.url('login/index');
                    })
                });
            });
        },
        welcome: function () {
            // /**
            //  * 查看公告信息
            //  **/
            // $('body').on('click', '.layuimini-notice', function () {
            //     var title = $(this).children('.layuimini-notice-title').text(),
            //         noticeTime = $(this).children('.layuimini-notice-extra').text(),
            //         content = $(this).children('.layuimini-notice-content').html();
            //     var html = '<div style="padding:15px 20px; text-align:justify; line-height: 22px;border-bottom:1px solid #e2e2e2;background-color: #2f4056;color: #ffffff">\n' +
            //         '<div style="text-align: center;margin-bottom: 20px;font-weight: bold;border-bottom:1px solid #718fb5;padding-bottom: 5px"><h4 class="text-danger">' + title + '</h4></div>\n' +
            //         '<div style="font-size: 12px">' + content + '</div>\n' +
            //         '</div>\n';
            //     layer.open({
            //         type: 1,
            //         title: '系统公告' + '<span style="float: right;right: 1px;font-size: 12px;color: #b1b3b9;margin-top: 1px">' + noticeTime + '</span>',
            //         area: '300px;',
            //         shade: 0.8,
            //         id: 'layuimini-notice',
            //         btn: ['查看', '取消'],
            //         btnAlign: 'c',
            //         moveType: 1,
            //         content: html,
            //         success: function (layero) {
            //             var btn = layero.find('.layui-layer-btn');
            //             btn.find('.layui-layer-btn0').attr({
            //                 href: 'https://gitee.com/zhongshaofa/layuimini',
            //                 target: '_blank'
            //             });
            //         }
            //     });
            // });

            /**
             * 报表功能
             */
            var echartsRecords = echarts.init(document.getElementById('echarts-records'), 'walden');
            var optionRecords = {
                title: {
                    text: '访问统计'
                },
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    data: ['邮件营销', '联盟广告', '视频广告', '直接访问', '搜索引擎']
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                toolbox: {
                    feature: {
                        saveAsImage: {}
                    }
                },
                xAxis: {
                    type: 'category',
                    boundaryGap: false,
                    data: ['周一', '周二', '周三', '周四', '周五', '周六', '周日']
                },
                yAxis: {
                    type: 'value'
                },
                series: [
                    {
                        name: '邮件营销',
                        type: 'line',
                        stack: '总量',
                        data: [120, 132, 101, 134, 90, 230, 210]
                    },
                    {
                        name: '联盟广告',
                        type: 'line',
                        stack: '总量',
                        data: [220, 182, 191, 234, 290, 330, 310]
                    },
                    {
                        name: '视频广告',
                        type: 'line',
                        stack: '总量',
                        data: [150, 232, 201, 154, 190, 330, 410]
                    },
                    {
                        name: '直接访问',
                        type: 'line',
                        stack: '总量',
                        data: [320, 332, 301, 334, 390, 330, 320]
                    },
                    {
                        name: '搜索引擎',
                        type: 'line',
                        stack: '总量',
                        data: [820, 932, 901, 934, 1290, 1330, 1320]
                    }
                ]
            };
            echartsRecords.setOption(optionRecords);
        },
        edit_admin: function () {
            admin.listen();
        }
    };
    return Controller;
});