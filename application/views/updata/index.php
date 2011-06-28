<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!-- saved from url=(0026)http://laterthis.com/login -->
<HTML lang=en xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE>查询</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="js/jquery-1.5.1.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.13.custom.min.js" type="text/javascript"></script>
<script src="js/jquery.ui.datepicker-zh-CN.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/start/jquery-ui-1.8.13.custom.css">
<link rel="stylesheet" href="css/style.css">
	<script>

	$(function() {
		$( "#dakatime" ).datepicker(
            {


            }
        );
	});

	</script>
</HEAD>
<BODY>
<DIV id=page-content>
  <DIV id=login-page>
    <DIV id=logo>查询 </DIV>
    <form id="form1" name="form1" method="post" action="<?php echo site_url("updata/view"); ?> ">
      <DIV id=normal-login>
        <P>
          <LABEL for=login>姓名:</LABEL>
          <INPUT id="employeename" name="employeename" size="10">
        </P>
        <P>
          <LABEL for=dakatime>时间:</LABEL>
          <BR>
          <INPUT id="dakatime" type="text" name="dakatime" >
        </P>
      </DIV>
      <P>
        <INPUT class=button type=submit value="查询" name="commit" >
    </FORM>
  </DIV>
</DIV>
</BODY>
</HTML>

