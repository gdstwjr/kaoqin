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
		if ( ! /^\d+$/.exec(form.sortnum.value)){
			alert("序号只能使用数字！");
			form.sortnum.focus();
			return false;
		}
		if( ! form.title.value){
			alert("标题不能为空！");
			form.title.focus();
			return false;
		}
		return true;
	}

	function makeTitleFontWeight(obj){
		if (obj.src.indexOf('icon_nobold.gif') != -1){
			obj.src	= "<?=app_url()?>images/icon_bold.gif";
			$G('titleFontWeight').value = "bold";
			$G('title').style.fontWeight = "bold";
		}else{
			obj.src	= "<?=app_url()?>images/icon_nobold.gif";
			$G('titleFontWeight').value = "";
			$G('title').style.fontWeight = "";
		}
	}

	function titleBlur(obj){
		var str = obj.value;
		$G('firstLetter').value	= spell(str.Trim().charAt(0)).substr(0,1).toUpperCase();
		if($G('subTitle').value == ""){
			$G('subTitle').value = str;
		}
	}
</script>
</head>
<body onload="document.form1.title.focus();">
<p class="position">当前位置: 管理中心 -&gt; 修改员工信息

</p>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr height="30">
		<td><a href="javascript:history.back();">[返回列表]</a></td>
	</tr>
</table>
<form name="form1" method="post" action="<?=site_url('news_info/update/')?>" onsubmit="return check(this)">
	<table width="98%" border="0" cellspacing="1" cellpadding="0" align="center" class="editTable">
		<tr class="editHeaderTr">
			<td class="editHeaderTd" colspan="2">编辑</td>
		</tr>

		
			<tr class="editTr">
				<td class="editLeftTd">姓名</td>
				<td class="editRightTd">
					<input type="text" class="inputText1" id="subTitle" name="subTitle" value="<?=convert2utf8($rst['employeename'])?>" />
				</td>
			</tr>
                        <tr class="editTr">
				<td class="editLeftTd">中心</td>
				<td class="editRightTd">
                             
					<select name="infoState">
					<option value="">- 请选择 -</option>
                                        	<?php
                                    foreach($department as $nav):
                                        	?>			
                                        <option value="<?php echo $nav['managername'];?> "<?php if($nav['departmentid'] == $rst['departmentid']) echo ' selected';?>><?php echo convert2utf8($nav['managername'])?></option>
                                           <?php
                                    endforeach;
                                ?>
					</select>
				</td>
			</tr>
			<tr class="editTr">
				<td class="editLeftTd">部门</td>
				<td class="editRightTd">
                             
					<select name="infoState">
					<option value="">- 请选择 -</option>
                                        	<?php
                                    foreach($department as $nav):
                                        	?>			
                                        <option value="<?php echo $nav['departmentid'];?> "<?php if($nav['departmentid'] == $rst['departmentid']) echo ' selected';?>><?php echo convert2utf8($nav['departmentname'])?></option>
                                           <?php
                                    endforeach;
                                ?>
					</select>
				</td>
			</tr>
                        <tr class="editTr">
				<td class="editLeftTd">IC卡编号</td>
				<td class="editRightTd">
					<input type="text" class="inputText1" id="subTitle" name="subTitle" value="<?=$rst['iccardid']?>" />
				</td>
			</tr>   
	
		</tr>
		<tr class="editFooterTr">
			<td class="editFooterTd" colspan="2">
				<input type="hidden" name="id" value="<?=$rs['employeeid']?>" />
				<input type="submit" value="确 定" class="small" />
			</td>
		</tr>
	</table>
</form>
</body>
</html>