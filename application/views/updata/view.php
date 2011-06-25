<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body >
<style type="text/css">
<!--
body {
font-size: 12px;
font-family: Arial, Helvetica, sans-serif;
}
table#dd {
background-color: #6CADD9;
}
table#dd thead th {
background-color: #6CADD9;
color: #FFFFFF;
}
#dd td {
padding: 6px;
width: 180px;
}
table#dd tbody.tb1 td {
background-color: #FFFFFF;
}
table#dd tbody.tb2 td {
background-color: #F7F7F7;
}
table#dd tbody td:hover {
background-color: #BFEDF9;
}
table#dd colgroup col.name {
background-color: #E6E6E6;
width: 100px;
font-weight: normal;
}-->
</style>



</head>
<body>         
  <table border="0" align="center" cellspacing="1" id="dd">

      <caption>
    查询记录
    </caption>

    <colgroup>
    <col class="name" />
    <col />
    <col />
    </colgroup>

    <thead>
      <tr>
        <th>姓名</th>

        <th>部门</th>
        <th>IC卡</th>
        <th width="180">打卡时间</th>
        <th>地点</th>
      </tr>
    </thead>
    <tbody class="tb1">
      <tr>
         
              <?php if ($rs->result()==null)
          {  ?>
          
           <td colspan="5" align="center">无数据</td>
      
         <?php } else{  ?>
    <?php foreach($rs->result() as $row):
?>
        <th><?php echo convert2utf8($row->employeename); ?></th>
        <td><?php echo convert2utf8($row->departmentname); ?></td>
        <td><?php echo $row->iccardid; ?></td>
        <td width="180"><?php echo convert2utf8($row->dakatime); ?></td>
        <td><?php echo $row->ioplace; ?></td>
      </tr>
      <?php endforeach;
      
          }
      ?>
        
        
       
    </tbody>

    </tbody>
  </table>
</body>
</html>