<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改数据</title>
<style>
.center { width:800px;margin:50px auto 0;padding:0;}
table { width:80%;margin:0 auto;border-collapse:collapse; font-size:18px;; font-family:"Times New Roman";}
#hint1 ,#hint2 { color:#F00; font-size:14px;}
</style>
<script type="text/javascript">
function check()
{
	var nameobj=window.document.getElementById("showname");
	var desobj=window.document.getElementById("showdes");
	var hrefobj=window.document.getElementById("showhref");
	var referobj=window.document.getElementById("showhref");
	 
}
function check()
{ 
    var nameobj=window.document.getElementById("showname");
	var hrefobj=window.document.getElementById("showhref");
	window.document.getElementById("hint2").innerHTML=" ";
	window.document.getElementById("hint1").innerHTML=" ";
	if(nameobj.value==""){
	   window.document.getElementById("hint1").innerHTML="*名称字段不得为空";
	   nameobj.focus();
	   return false;
	}	
		if(hrefobj.value==""){
	   window.document.getElementById("hint2").innerHTML="*链接字段不得为空";
	   hrefobj.focus();
	   return false;
	}
}
</script>

</head>

<body background="../images/tiny_win_bg.jpg">
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
  
$sql="select * from $tablename where $keyname=$key";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$showseq=$row[0];
$showname=$row[1];
$showdes=$row[2];
$showhref=$row[3];
$showrefer=$row[4];
$showyear=$row[5];
?>

<div class="center" >
<form name="form1" action="modi_exe.php?db_id=<?php echo $db_id;?>&num=<?php echo $key;?>" method="post" onsubmit="return check()"> 
<table cellpadding="5" border="0">
<tr>
<td  width="100" align="right">编号：</td>
<td><input id="seq" type="text" name="num" readonly="readonly"/ value="<?php echo $showseq;?>"></td>
</tr>
<tr>
<td align="right">名称：</td>
<td><textarea id="showname" type="text" name="name" cols="45" /><?php echo $showname?></textarea></td>
<td id="hint1"></td>
</tr>
<tr>
<td align="right">描述：</td>
<td><textarea id="showdes" name="des" cols="45"/><?php echo $showdes;?></textarea></td>
</tr>
<tr>
<td align="right">链接：</td>
<td><textarea id="showhref" name="href"	cols="45" /><?php echo $showhref;?></textarea></td>
<td id="hint2"></td>
</tr>
<tr>
<td align="right">参考文献：</td>
<td><textarea  id="showrefer" name="refer" rows="5" cols="45"/><?php echo $showrefer;?></textarea></td>
</tr>
<tr>
<td align="right">Year：</td>
<td><input type="text"  id="showyear" name="year" value="<?php echo $showyear;?>" /></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" value="确认修改""/></td>
</tr>
</table>
</form>
</div>

</body>
</html>
