<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
body{margin:0;padding:0;background-color:#E3EFFB;cursor:E-resize;}
a{blr:expression(this.onFocus=this.blur());}
a:focus{outline:none;}
</style>
<title></title>
<script type="text/javascript">
	var orgX = 0;
	document.onmousedown = function(e){
		var evt = Utils.fixEvent(e);
		orgX = evt.clientX;
		if (Browser.isIE) document.getElementById('tbl').setCapture();
	}

	document.onmouseup = function(e){
		var evt = Utils.fixEvent(e);
		frmBody = parent.document.getElementById('frame-body');
		frmWidth = frmBody.cols.substr(0, frmBody.cols.indexOf(','));
		frmWidth = (parseInt(frmWidth) + (evt.clientX - orgX));
		frmBody.cols = frmWidth + ", 7, *";
		if (Browser.isIE) document.releaseCapture();
	}

	var Browser = new Object();
	Browser.isMozilla = (typeof document.implementation != 'undefined') && (typeof document.implementation.createDocument != 'undefined') && (typeof HTMLDocument != 'undefined');
	Browser.isIE = window.ActiveXObject ? true : false;
	Browser.isFirefox = (navigator.userAgent.toLowerCase().indexOf("firefox") != - 1);
	Browser.isSafari = (navigator.userAgent.toLowerCase().indexOf("safari") != - 1);
	Browser.isOpera = (navigator.userAgent.toLowerCase().indexOf("opera") != - 1);
	var Utils = new Object();
	Utils.fixEvent = function(e){
		var evt = (typeof e == "undefined") ? window.event : e;
		return evt;
	}
</script>

</head>
<body onselect="return false;" oncontextmenu="return false;" onselectstart="return false;">
<table height="100%" cellspacing="0" cellpadding="0" style="border-left:1px solid #C8DCF7;" id="tbl">
	<tr>
		<td></td>
	</tr>
</table>
</body>
</html>
