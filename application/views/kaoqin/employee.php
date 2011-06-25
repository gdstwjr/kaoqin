<?php
$page = toLimitLng($this->input->get('page'), 1);

$title = convert2gbk($this->input->get('title'));
$list_url = site_url('kaoqin/employee/');
set_cookie("return_url", $list_url, 86400);
$page_url = site_url() . '/kaoqin/employee/' ;
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
			&nbsp;
			&nbsp;
		</td>
		<td align="right">
			<form id="form1" name="form1" method="get">
				姓名：<input type="text" name="title" title="标题" value="" class="inputText1 medium" />
				<input type="submit" value="查询" class="space tMiddle" />
			</form>
		</td>
	</tr>
</table>
<table id="listTable" width="98%" border="0" cellspacing="0" cellpadding="0" align="center" class="listTable">
	<tr class="listHeaderTr">

		<th width="4%">序号</th>
		<th width ="5%" >姓名</th>
                <th width ="4%" >性别</th>
		<th width="7%">部门</th>
                <th width="8%">中心</th>
                <th width="8%">所属公司</th>
                <th width="12%">入职时间</th>
                <th width="8%">IC卡编号</th>
                <th width="12%">录入时间</th>
                <th width="12%">修改时间</th>
                <th width="5%">修改者</th>
                <th width="10%">操作</th>
	</tr>
    <?php
        //$condition = array('employeeid'=>$class_id);
        $table_num =$this->db->count_all('t_employee');
        //$rst = $this->db->get('t_employee');
	$page_size = 20;
	$offset	= ($page - 1) * $page_size +20 ;
        //$offset = 20;
	$page_str = page($page_url, $table_num, $page_size, $page);
        $sql='';
	if($title) {
            $sql="where employeename='".$title."'";
            $page_str='';
        }
        
        
        
        //echo $page_str;
	//$this->db->order_by('employeeid DESC');
         //echo  $this->db->last_query();
	//$rst = $this->db->get_where('t_employee','',$page_size, $offset);
        /*
         * 
          SELECT * FROM ( SELECT TOP  20  * FROM  (
		SELECT TOP 20 departmentname,employeeid,employeename
		FROM  t_employee JOIN t_department ON  t_department.departmentid = t_employee.departmentid where employeename='吴锦荣'
		ORDER BY   employeeid DESC
                        ) t1
                        ORDER BY   employeeid
                ) t2
             ORDER BY  employeeid DESC


            select top 20 * from (

            select top 20 departmentname,employeeid,employeename  from t_employee JOIN t_department ON
             t_department.departmentid = t_employee.departmentid 
            WHERE t_employee.employeename='吴锦荣'

            order by employeeid desc) as a

            order by employeeid desc
         */
        
        $rst = $this->db->query("SELECT * FROM ( SELECT TOP  $page_size  * FROM  (
		SELECT TOP $offset departmentname,employeeid,employeename,managername,parentdptid,t_employee.sex,
                t_employee.inputtime,t_employee.modifytime,iccardid,inworktime,username
		FROM  t_employee JOIN t_department ON  t_department.departmentid = t_employee.departmentid 
                JOIN t_users ON t_users.userid = t_employee.modifyby
                $sql
		ORDER BY  employeeid DESC
                        ) t1
                        ORDER BY  employeeid
                ) t2
                ORDER BY  employeeid DESC ");
        //echo  $this->db->last_query();
        
	foreach($rst->result_array() as $row):
	
    ?>
		<tr onmouseover="over(event)" onmouseout="out(event)" onclick="change(event)">
		<td ><?php echo convert2utf8($row['employeeid']); ?></td>
                <td align='left'>　<?php echo convert2utf8($row['employeename']); ?></td>
                <td ><?php if ($row['sex']=="1")
                        echo "男";
                    else{
                        echo "女";
                    }; ?></td>
                <td><?php echo convert2utf8($row['departmentname']); ?></td>
                <td align='left' >　<?php echo convert2utf8($row['managername']); ?></td>
                <td align='left' >　<?php echo convert2utf8($row['parentdptid']); ?></td>
                <td><?php echo $row['inworktime']?></td>
                <td ><?php echo $row['iccardid']?></td>
                <td align='left' >　<?php echo convert2utf8($row['inputtime']); ?></td>
                <td align='left' >　<?php echo convert2utf8($row['modifytime']); ?></td>
                <td align="left">　<?php echo convert2utf8($row['username']); ?></td>
                <td><a href="<?=site_url('kaoqin/edit/'.$row['employeeid'])?>">修改</a></td>
		</tr>
      <?php endforeach;
      ?>
	<tr class="listFooterTr">
		<td colspan="20"><?=$page_str?> </td>
	</tr>
</table>
</body>
</html>