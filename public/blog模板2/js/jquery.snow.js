(function ($) {
 
    $.fn.snow = function (options) {
 
        var $flake = $('<div id="snowbox" />').css({
            'position': 'absolute',
            'top': '-50px',
            'z-index': '99999'
        }).html('❄'),
            documentHeight = $(document).height(),
            documentWidth = $(document).width(),
            defaults = {
                minSize: 10, //雪花的最小尺寸
                maxSize: 20, //雪花的最大尺寸
                newOn: 1000, //雪花出现的频率
                flakeColor: "#FFFFFF" //雪花颜色
            },
            options = $.extend({}, defaults, options);
 
        var interval = setInterval(function () {
            var startPositionLeft = Math.random() * documentWidth - 100,
                startOpacity = 0.3 + Math.random(),
                sizeFlake = options.minSize + Math.random() * options.maxSize,
                endPositionTop = documentHeight - 40,
                endPositionLeft = startPositionLeft - 100 + Math.random() * 500,
                durationFall = documentHeight * 10 + Math.random() * 5000;
            $flake.clone().appendTo('body').css({
                left: startPositionLeft,
                opacity: startOpacity,
                'font-size': sizeFlake,
                color: options.flakeColor
            }).animate({
                top: endPositionTop,
                left: endPositionLeft,
                opacity: 0.2
            }, durationFall, 'linear', function () {
                $(this).remove()
            });
 
        }, options.newOn);
 
    };
 
})(jQuery);
/*
$(function(){
	$.fn.snow({ 
		minSize: 3,		//雪花的最小尺寸
		maxSize: 20, 	//雪花的最大尺寸
		newOn: 300		//雪花出现的频率 这个数值越小雪花越多
	});
});
*/