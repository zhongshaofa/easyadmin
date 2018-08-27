;(function($,window,document,undefined){
	var pluginName = 'eventFlow',
		defaults ={};
	function EventFlow(element,options){
		this.init(element,options);
	}
	EventFlow.prototype = {
		init : function(element,options){
			this.spliceHtml(element,options);
			var $text = $('.event_wrap .list .ev_text');
			var point = [];
  			$text.each(function(index, el) {  		
  				point.push($(this).offset().top)  	
  			});
  			for(var i =0;i<point.length;i++){ 
  				if($(document).height() > point[i] ){
					$($text[i]).addClass('aActiveWid');  			
				}
  			}
  			$(window).scroll(function(event) {
  				var s = $(this).scrollTop();  
  				for(var i =0;i<point.length;i++){  
  					if(s+ $(document).height()*2/3 > point[i] ){
  						$($text[i]).addClass('aActiveWid');  			
  					}else{
  						$($text[i]).removeClass('aActiveWid')
  					}
  				}
  			});
		},
		spliceHtml :function(element,options){
			var $element = element;
			var $middleLine = $element.find('.middle_line');
			var middleLineI = '';
			var list = ''
			for(var i = 0;i<options.events.length;i++){
				middleLineI +='<i class="first"></i>'
					+'<i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i>'
					+'<i class="last"></i>';
				if((i+1)%2 == 0){
                       list += '<div class="list_right list">'
				}else{
					list +='<div class="list_left list">'
				}
				list +='<span class="big_squre"><i>'+options.events[i].year+'</i></span>';
				for(var j = 0;j < options.events[i].events.length;j++){
					if((j+1)%2 == 0){
						list +='<div class="ev_text_odd ev_text ev_t'+options.events[i].events[j].mouths+'">'
					}else{
						list +='<div class="ev_text ev_text_event ev_t'+options.events[i].events[j].mouths+'">'
					}
					list +=	'<span class="small_squire"><i></i></span>'
						+'<span class="small_line"></span>'
						+'<h3>'+options.events[i].events[j].times+'</h3>'
						+'<p>'+options.events[i].events[j].even+'</p>'
					+'</div>';				
				}
				list += '</div>';
			};
			$element.append(list);
			$middleLine.html(middleLineI);
		}
	}
	$.fn[pluginName] = function(options){
		options = $.extend(true, options, defaults);		
		return this.each(function(){
            new EventFlow($(this),options)
        });
	}
})(jQuery,window,document)














