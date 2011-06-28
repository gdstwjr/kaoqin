<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?=app_url()?>images/style.css" />
<title></title>
<style type="text/css">
body{/*-moz-user-focus:ignore;-moz-user-input:disabled;*/-moz-user-select:none;}
.top_r{width:268px;background:url(<?=app_url()?>images/header_right.jpg) no-repeat top left;text-align:right;vertical-align:top;padding-top:10px;}
.top_r a{color:#FFF;font-weight:bold;}
.top_r a:hover{text-decoration:none;}
A.link1 { font-size:12px; color:#FFF;; text-decoration:none; font-family:"宋体"; height:16px; width:78px; line-height:16px; padding-top:4px; font-weight:bold; display:block; background:url(<?=app_url()?>images/bt_bg1_admin.gif) no-repeat center; }
A.link1:hover { color:#F60;; text-decoration:none; }
</style>
<script type="text/javascript">
	function to_manage_main(){
		window.top.frames("menu").window.location = "<?=site_url('index/menu')?>";
		window.top.frames("main").window.location = "<?=site_url('index/main')?>";
	}
</script>
</head>
<body onselect="return false;" oncontextmenu="return false;" onselectstart="return false;">
<table width="100%" height="56" border="0" cellspacing="0" cellpadding="0" background="<?=app_url()?>images/header_bg.jpg">
	<tr>
		<td width="239"><img src="<?=app_url()?>images/header_left.jpg" width="260" height="56"></td>
		<td style="padding-top:20px;color:#FFF;font-weight:bold;text-align:center;">
			欢迎您，<?=$this->session->userdata('session_realname')?>
			&nbsp;&nbsp;
			<a href="<?=base_url()?>" target="_blank" style="color:#FFF;"></a>
			&nbsp;&nbsp;
			<a href="javascript:;" onclick="to_manage_main()" style="color:#FFF;">【管理首页】</a>
		</td>
		<td class="top_r"><a href="<?=site_url("login/logout")?>" target="_top" onclick="return confirm('确定要退出吗？');"><img src="<?=app_url()?>images/icon_close.gif" align="absmiddle" /> 安全退出</a>&nbsp;&nbsp;</td>
	</tr>
</table>
<div style="background-color:#1C5DB6;height:4px;line-height:4px;"></div>
</body>
</html>
