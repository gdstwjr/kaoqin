<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Expires" content="0">
<script type="text/javascript">
	function window_onbeforeunload() {
		var str="";
		str = "您如果关闭主窗口，会导致您断开与服务器的连接，您真的要退出系统吗？";
		return str;
	}
	window.moveTo(0, 0);
	window.resizeTo(screen.availWidth, screen.availHeight);
</script>
<title>管理中心</title>
<frameset frameborder="0" framespacing="0" border="0" rows="60,*,30" onbeforeunload="return window_onbeforeunload();">
	<frame src="<?=site_url("index/header")?>" name="header" frameborder="0" noresize="noresize" scrolling="no" marginwidth="0" marginheight="0" />
	<frameset frameborder="0" framespacing="0" border="0" cols="176,7,*" id="frame-body">
		<frame src="<?=site_url("index/menu")?>" frameborder="0" name="menu" scrolling="auto" />
		<frame src="<?=site_url("index/drag")?>" frameborder="0" name="drag" scrolling="no" noresize="noresize" />
		<frame src="<?=site_url("index/main")?>" frameborder="0" name="main" scrolling="yes" style="overflow-x:hidden;" />
	</frameset>
	<frame src="<?=site_url("index/footer")?>" name="footer" frameborder="0" noresize scrolling="no" marginwidth="0" marginheight="0" />
</frameset>
</html>