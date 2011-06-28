//jQuery Ajax 相关
document.write("<div id='AjaxResult' class='AjaxResult'></div>");

$.ajaxSetup({
	type : 'POST',
	dataType : 'json'
});

//显示返回信息
function showResult(str){
	var obj	= $('#AjaxResult');
	obj.html(str);
	obj.fadeIn(function() {
		setTimeout(function() {
			obj.fadeOut();
		}, 3000);
	});
}