<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?=app_url()?>images/style.css" />
<title></title>
<style type="text/css">
body{-moz-user-focus:ignore;-moz-user-input:disabled;-moz-user-select:none;}
</style>
</head>
<body onload="clock();" onselect="return false;" oncontextmenu="return false;" onselectstart="return false;">
<table height="30" cellspacing="0" cellpadding="0" width="100%" background="<?=app_url()?>images/bg_bottom.jpg" border="0" style="color:#FFFFFF;font:12px Helvetica,Arial,sans-serif;">
	<tr>
		<td align="center" width="30"><a href="javascript:;" onclick="toggleMenu()"><img id="img" src="<?=app_url()?>images/application_side_contract.gif" border="0" /></a></td>
		<td align="left"><span id="clock"></span></td>
		<td align="right" style="padding-right:10px;">
			<span>版权所有 &copy; 2011 汕头方特投资发展有限公司</span>
		</td>
	</tr>
</table>
<script type="text/javascript">
	function toggleMenu(){
		var frmBody = parent.document.getElementById('frame-body');
		var imgArrow = document.getElementById('img');
		if (frmBody.cols == "0, 7, *"){
			frmBody.cols="176,7,*";
			imgArrow.src = "<?=app_url()?>images/application_side_contract.gif";
		}else{
			frmBody.cols="0, 7, *";
			imgArrow.src = "<?=app_url()?>images/application_side_expand.gif";
		}
	}

	function clock(){
		document.getElementById('clock').innerHTML	= new Date().toLocaleString();
	}
	setInterval('clock()', 1000);
</script>
<div class="none"><img src="<?=app_url()?>images/application_side_expand.gif" /></div>
</body>
</html>
