<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php 
    $conn=mysql_connect("localhost","root","") or die("fail to connect database");
    mysql_select_db("project") or die("fail to choose database");
    mysql_query("set names utf8");
    
    
?>
</body>
</html>