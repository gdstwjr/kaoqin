<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?=app_url()?>images/main.css" />
<script type="text/javascript" src="<?=app_url()?>script/common.js"></script>
<title></title>
</head>
<body>
<p class="position">当前位置：管理中心 -&gt; 管理首页</p>
<div class="main">
	<div class="c_left">
		<div class="border">
			<h2>管理员基本信息</h2>
			<div class="con_base">
				<p style="border:0;"><strong><?=$this->session->userdata('session_realname')?></strong>，欢迎您登录管理后台。</p>
			</div>
		</div>
		<div class="border">
			<h2>管理快捷方式</h2>
			<ul class="con_link">
				<li style="border:0;text-indent:1em;">
					<a href="<?=site_url('person')?>">修改资料</a>
					<a href="<?=site_url('person/changepass')?>">修改密码</a>
				</li>
			</ul>
		</div>
		<div class="border">
			<h2>系统基本信息</h2>
			<ul class="con_link">
				<li style="border:0;">
					<strong>您的级别：</strong>
		
				</li>
			</ul>
		</div>
		<div class="border">
			<h2>开发团队</h2>
			<ul class="con_kftd">
				<li><strong>主程序开发：</strong> </li>
				<li><strong>界面及交互设计：</strong> </li>
				<li style="border:0;"><strong>版本Version：</strong> v1.0 </li>
			</ul>
		</div>
	</div>
	<div class="c_right">
		<div class="border">
			<h2>信息</h2>
			<ul class="list_xxtj">
			
			</ul>
		</div>



	</div>
</div>
</body>
</html>