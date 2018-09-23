<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php $str=$_SERVER['QUERY_STRING'];

$end1=strpos($str,"&");
$sub1=substr($str,0,$end1);
$db_id=substr($sub1,stripos($sub1,"=")+1)+0;

$sub2=substr($str,stripos($str,"&"));
$second=stripos($sub2,"=");
$key=substr($sub2,stripos($sub2,"=")+1)+0;

 require('connect.php');
if($db_id==1)
  {$tablename='toolinfo';$keyname='toolnum';$name='toolname';$des='tooldes';$href='toolhref';$refer='toolrefer'; $year='tool_year';}
if($db_id==2)
  {$tablename='dbinfo';$keyname='dbnum';$name='dbname';$des='dbdes';$href='dbhref';$refer='dbrefer';$year='db_year'; }
  
  $newname=$_POST['name'];
  $newdes=$_POST['des'];
  $newhref=$_POST['href'];
  $newrefer=$_POST['refer'];
  $newyear=$_POST['year'];
$sql=" update ".$tablename." set ".$name."='".$newname."',".$des." = '".$newdes."',".$href." = '".$newhref."',".$refer."='".$newrefer.
"',".$year."= '".$newyear."' where ".$keyname."=".$key;
if(mysql_query($sql))
{
	echo '<script>alert("修改成功!");window.close();window.opener.location.href=window.opener.location.href;</script>';
	
	}
else echo '<script>alert("修改失败！");window.close();</script>';
?>
</body>
</html>
