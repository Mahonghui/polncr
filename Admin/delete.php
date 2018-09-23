<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
$str=$_SERVER['QUERY_STRING'];

$end1=strpos($str,"&");
$sub1=substr($str,0,$end1);
$db_id=substr($sub1,stripos($sub1,"=")+1)+0;

$sub2=substr($str,stripos($str,"&"));
$second=stripos($sub2,"=");
$key=substr($sub2,stripos($sub2,"=")+1)+0;
 require('../connect.php');
 
if($db_id==1)
  {$tablename="toolinfo";$keyname="toolnum";}
if($db_id==2)
  {$tablename="dbinfo";$keyname="dbnum";}
if($db_id==3)
 {$tablename="concepts";$keyname="position";}
if($db_id==4)
{$tablename='news';$keyname='news_id';exec("rm -f news/news_$key.html");} 
if($db_id==5)
{$tablename='lncRNA_study';$keyname='position';} 
  $sql="delete from $tablename where $keyname=$key";
  if(mysql_query($sql) or die(mysql_error()))
 { 
   $update="update concepts set position=position-1 where position >$key";
   mysql_query($update) or die(mysql_error());
   echo '<script>alert("删除成功!");window.opener.location.href=window.opener.location.href;window.close();</script>';
} 
 else
  echo '<script>alert("删除失败！");</script>';
?>
</body>
</html>
