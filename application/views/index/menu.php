<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?=app_url()?>images/menu.css" />
<title></title>
<script type="text/javascript">
	function expand(el){
		childObj = document.getElementById("child" + el);
		if (!childObj){
			return;
		}
		if (childObj.style.display == 'none'){
			childObj.style.display = 'block';
		}else{
			childObj.style.display = 'none';
		}
		return;
	}
	function showspan(spanObj, imgObj){
		var obj = document.getElementById(spanObj);
		var img = document.getElementById(imgObj);
		if (!obj || !img){
			return;
		}
		if (obj.style.display == 'none') {
			obj.style.display = "block";
			img.src = "<?=app_url()?>images/arrow2.gif";
		} else {
			obj.style.display = "none";
			img.src = "<?=app_url()?>images/arrow1.gif";
		}
	}
</script>
</head>
<body style="background-color:#E3EFFB;">

<?php
$session_group_id = $this->session->userdata('session_group_id');
$i=0;
?>

<dl class="menu">

	<?php $i++;?>
	<dt><a href="javascript:;" onclick="expand(<?=$i?>)">信息管理</a></dt>
	<dd id="child<?=$i?>" style="display:none;">
		
			<div class="row">
				
					
				
				
					<p><a href="<?=site_url('kaoqin/chaxu/')?>" target="main">打卡查询</a></p>
                                        
                                        <p><a href="<?=site_url('kaoqin/employee/')?>" target="main">员工信息</a></p>
				
			</div>
	</dd>
        <?php $i++;?>
        <dt><a href="javascript:;" onclick="expand(<?=$i?>)">报表管理</a></dt>
	<dd id="child<?=$i?>" style="display:none;">
		
			<div class="row">
				
					
				
				
					<p><a href="<?=site_url('report/chaxu/')?>" target="main">考勤统计表</a></p>
				
			</div>
	</dd>
</dl>
<div class="none">
	<img src="<?=app_url()?>images/arrow1.gif" />
	<img src="<?=app_url()?>images/arrow2.gif" />
	<img src="<?=app_url()?>images/arrow3.gif" />
</div>



</body>
</html>
