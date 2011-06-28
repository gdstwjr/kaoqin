<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="<?=app_url()?>images/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=app_url()?>script/common.js"></script>
<script type="text/javascript" src="<?=app_url()?>script/color.js"></script>
<script type="text/javascript" src="<?=app_url()?>script/Cn2PinYin.js"></script>
<script type="text/javascript" src="<?=app_url()?>script/string.js"></script>
<script type="text/javascript" src="<?=app_url()?>script/datepicker/WdatePicker.js"></script>
<script type="text/javascript">
	function check(form){
		if( ! form.employeename.value){
			alert("姓名不能为空！");
			form.employeename.focus();
			return false;
		}
		return true;
	}


</script>
</head>
<body onload="document.form1.title.focus();">
<p class="position">当前位置: 管理中心 -&gt; 考勤查询

</p>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr height="30">
		<td></td>
	</tr>
</table>
<form name="form1" method="post" action="<?=site_url('kaoqin/view/')?>" onsubmit="return check(this)">
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="editTable">
		<tr class="editHeaderTr">
			<td class="editHeaderTd" colspan="2">查询</td>
		</tr>
		<tr class="editTr">
			<td class="editLeftTd">姓名</td>
			<td class="editRightTd">
				<input type="text" id="employeename" name="employeename" size="12" class="inputText1 bLeftRequire" />
				
			</td>
		</tr>
	
			<tr class="editTr">
				<td class="editLeftTd">时间</td>
				<td class="editRightTd">
					<input type="text" class="inputText1" name="publishdate" size="12" style="margin-right:30px;" onfocus="WdatePicker()" value="<?=toDay(time())?>" />
				</td>
			</tr>
	

		<tr class="editFooterTr">
			<td class="editFooterTd" colspan="2">
				<input type="submit" value=" 确 定 " class="medium" />
			</td>
		</tr>
	</table>
</form>
</body>
</html>