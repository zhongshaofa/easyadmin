/*添加收藏*/
function addFavorite(name, site) {
	try { window.external.addFavorite(site, name) } catch(e) {
		try { window.sidebar.addPanel(name, site, "") } catch(e) { alert("加入收藏失败，请使用Ctrl+D进行添加") }
	}
}


$(document).ready(function () {
    /*通过地址栏url激活菜单状态*/
    $(".w_menu li a").each(function () {
        if (String(window.location).startWith($($(this))[0].href)) {
            $(this).removeAttr("data-hover");
            $(this).parent().addClass('active').siblings().removeClass("active");
        }
    });
})

String.prototype.startWith=function(str){
    var reg=new RegExp("^"+str);
    return reg.test(this);
}
