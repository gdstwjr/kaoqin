<?php
$page = toLimitLng($this->input->get('page'), 1);
$class_id = $this->uri->segment(3);
$title = $this->input->get('title');

$urlString	= "?title=". urlencode($title);
$list_url = site_url('news_info/index/');
set_cookie("return_url", $list_url, 86400);
$page_url = site_url() . '/news_info/index/' . $urlString;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="<?=app_url()?>images/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=app_url()?>script/common.js"></script>
<script type="text/javascript" src="<?=app_url()?>script/jquery.js"></script>
<script type="text/javascript" src="<?=app_url()?>script/jquery.ajax.js"></script>
</head>
<body>
<p class="position">当前位置: 管理中心 -&gt; 网站管理

</p>
<table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr height="30">
		<td>
			<a href="?">[全部列表]</a>&nbsp;
			&nbsp;
		</td>
		<td align="right">
			<form id="form1" name="form1" method="get">
				标题：<input type="text" name="title" title="标题" value="" class="inputText1 medium" />
				<input type="submit" value="查询" class="space tMiddle" />
			</form>
		</td>
	</tr>
</table>
<table id="listTable" width="98%" border="0" cellspacing="0" cellpadding="0" align="center" class="listTable">
	<tr class="listHeaderTr">

		<th width="80">姓名</th>
		<th width ="80">部门</th>
		<th width="100">打卡时间</th>
                <th width="20">打卡地点</th>
	</tr>
    <?php foreach($rs->result() as $row):?>
		<tr onmouseover="over(event)" onmouseout="out(event)" onclick="change(event)">
		<td><?php echo convert2utf8($row->employeename); ?></td>
                <td><?php echo convert2utf8($row->departmentname); ?></td>
                <td><?php echo convert2utf8($row->dakatime); ?></td>
                <td> <?php echo $row->ioplace; ?></td>
		</tr>
      <?php endforeach;
      ?>
	<tr class="listFooterTr">
		<td colspan="20"></td>
	</tr>
</table>
</body>
</html>