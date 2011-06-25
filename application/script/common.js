////常用函数////
function $G(id){
	return document.getElementById(id);
}

//检测浏览器类型
function is_IE(){return navigator.userAgent.indexOf("MSIE")>0;}
function is_FF(){return navigator.userAgent.indexOf("Firefox")>0;}

//---------------------------------------------------
//	打开新窗口
//---------------------------------------------------
function PopWindow(pageUrl,WinWidth,WinHeight) {
	var popwin=window.open(pageUrl,"_blank","scrollbars=yes,toolbar=no,location=no,directories=no,status=no,menubar=no,resizable=no,width="+WinWidth+",height="+WinHeight);
	return false;
}

//+---------------------------------------------------
//|	打开模式窗口，返回新窗口的操作值
//+---------------------------------------------------
function PopModalWindow(url,width,height){
	var result=window.showModalDialog(url,"win","dialogWidth:"+width+"px;dialogHeight:"+height+"px;center:yes;status:no;scroll:auto;dialogHide:no;resizable:no;help:no;edge:sunken;");
	return result;
}

//获取文档层次中指定的父对象
function GetParentNode(obj, tag){
	while(obj.parentNode && obj.tagName.toLowerCase() != tag){
		obj	= obj.parentNode;
	}
	return obj;
}

function change(e){
	var e = e || event;
	var obj = e.srcElement || e.target;
	if(obj.tagName != "TD") return;
	obj	= GetParentNode(obj, 'tr').getElementsByTagName("input");
	if (obj[0] !== undefined) {
		obj[0].checked = !obj[0].checked;
	}
}

function out(e){
	var e = e || event;
	var obj = e.srcElement || e.target;
	obj	= GetParentNode(obj, 'tr');
	obj.className	= 'out';
}

function over(e){
	var e = e || event;
	var obj = e.srcElement || e.target;
	obj	= GetParentNode(obj, 'tr');
	obj.className	= 'over';
}

//全选
function CheckAll(strSection){
	var	colInputs = document.getElementById(strSection).getElementsByTagName("input");
	for	(var i=1; i < colInputs.length; i++){
		colInputs[i].checked=colInputs[0].checked;
	}
}
//反向选中指定的选择框对象
function reverseCheck(strSection){
	var	colInputs = document.getElementById(strSection).getElementsByTagName("input");
	for	(var i=1; i < colInputs.length; i++){
		colInputs[i].checked = !colInputs[i].checked;
	}
}
//获取选中的选择框对象值组成字符串
function getSelectCheckboxValues(){
	var obj = document.getElementsByName('ids');
	var result ='';
	for (var i=0; i<obj.length; i++){
		if (obj[i].checked==true){
			result += "," + obj[i].value;
		}
	}
	return result.substring(1);
}

//获取扩展名
function getFileExt(filename){
	var dot	= filename.lastIndexOf(".");
	if (dot >= 0){
		return filename.substr(dot + 1).toLowerCase();
	}else{
		return "";
	}
}

//检查数组中是否存在指定的值
function in_array(value, array){
	if (typeof(value) != "string" && typeof(value) != "number"){
		return false;
	}
	if (array.constructor != Array){
		return false;
	}
	for(var i in array){
		if (array[i] == value){
			return true;
		}
	}
	return false;
}

function tabit(btn, n){
	var idname = new String(btn.id);
	var s = idname.indexOf("_");
	var e = idname.lastIndexOf("_") + 1;
	var tabName = idname.substr(0, s);
	var id = parseInt(idname.substr(e, 1));
	for (i=0; i<n; i++){
		$G(tabName + "_div_" + i).style.display = "none";
		$G(tabName + "_btn_" + i).className = '';
	};
	$G(tabName+"_div_"+id).style.display = "block";
	btn.className = "cur";
}

Date.prototype.format = function(format) {
	var o = {
		"M+": this.getMonth() + 1,
		"d+": this.getDate(),
		"h+": this.getHours(),
		"m+": this.getMinutes(),
		"s+": this.getSeconds(),
		"q+": Math.floor((this.getMonth() + 3) / 3),
		"S": this.getMilliseconds()
	};
	if (/(y+)/.test(format)){
		format = format.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
	}
	for (var k in o) if (new RegExp("(" + k + ")").test(format)){
		format = format.replace(RegExp.$1, RegExp.$1.length == 1 ? o[k] : ("00" + o[k]).substr(("" + o[k]).length));
	}
	return format;
}

/*
* 预加载图片
* 调用：preloadimages("a.gif", "b.gif");
*/
var myimages=new Array();
function preloadimages(){
	for (i=0; i<preloadimages.arguments.length; i++){
		myimages[i]	= new Image();
		myimages[i].src	= preloadimages.arguments[i];
	}
}

/*
* 产生随机字符串
*/
function rand_string(len, type, addChars){
	if( ! arguments[0]) len = 8;
	if( ! arguments[2]) addChars = "";
	var chars = "";
	switch (type){
		case 1:
			chars	= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' + addChars;
			break;
		case 2:
			chars	= '012345678901234567890123456789';
			break;
		case 3:
			chars	= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' + addChars;
			break;
		case 4:
			chars	= 'abcdefghijklmnopqrstuvwxyz' + addChars;
			break;
		default:
			chars	= 'ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789' + addChars;
			break;
	}

	var str	= "";
	for(var i=0; i<len; i++)  {
		str += chars.charAt(Math.ceil(Math.random()*100000000) % chars.length);
	}
	return str;
}


