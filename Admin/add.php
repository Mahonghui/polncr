<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加记录</title>
<style>
.center { width:800px;margin:30px auto 0;padding:0;}
table { width:80%;margin:0 auto;border-collapse:collapse; font-size:18px;; font-family:"Times New Roman";}
.center .upfile {width:70%;margin:10px auto; text-align:center;}
#hint1 ,#hint2 { color:#F00; font-size:14px;}
.tip{  margin:0 auto;border-left:#90C 1px dotted;font-size:14px;  text-align:center; line-height:19px;}
.tip ol{ list-style:square;}
.tip li{  color:#F33;}
#btn { margin-right:30%;}
</style>
<script>
function ensure()
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
	
	return true;
	}
	function checkfile()
	{ 
	    
		if(window.document.getElementById("file").value=="")
		 {
			 alert("请选择文件");
		     return false;
		 }
	 return true;
	}
	
</script>
</head>

<body background="../images/tiny_win_bg.jpg">
<?php $db_id=substr($_SERVER['QUERY_STRING'],stripos($_SERVER['QUERY_STRING'],"=")+1)+0;?>
<div class="center" >
<form name="form1" action="" method="post" onsubmit="return ensure()" > 
<table cellpadding="5" border="0">
<tr>
<td>Name:</td>
<td><input type="text" name="name" id="showname" /></td>
<td id="hint1"></td>
</tr>
<tr>
<td>Description:</td>
<td><textarea  name="des" cols="23" rows="5"/></textarea></td>
</tr>
<tr>
<td>Linkage:</td>
<td><input type="text" name="href" id="showhref" /></td>
<td id="hint2"></td>
</tr>

<td>Reference:</td>
<td><textarea name="refer" cols="23"  rows="5" /></textarea></td>
</tr>

<tr>
<td>Year:</td>
<td><input type="text" name="year" /></td>
</tr>

<tr>
<td colspan="2" align="center"><input type="submit" value="确认添加" /></td>
</tr>
</table>
</form>

<hr/>
<div class="upfile">
<form action="uploadfile.php?db_id=<?php echo $db_id;?>" method="post" enctype="multipart/form-data" onsubmit="return checkfile()">

<p>Bunchy Addition:<input type="file" name="userfile" style="padding-left:25px;"></p>

</div>
<div class="tip">
<ul>
<li>Each line in the file(.txt) corresponds to an entry </li>
<li>Each coloum value in one line is separated by separator:'\t' </li>
</ul>
</div>
<?php 
 require('../connect.php');
if($db_id==1)
  {$tablename='toolinfo';$keyname='toolnum';$name='toolname';$des='tooldes';$href='toolhref';$refer='toolrefer';$year='tool_year'; }
if($db_id==2)
  {$tablename='dbinfo';$keyname='dbnum';$name='dbname';$des='dbdes';$href='dbhref';$refer='dbrefer';$year='db_year'; }

  if(isset($_POST['name']))
  {
	     
     $newname=$_POST['name'];
     $newdes=$_POST['des'];
     $newhref=$_POST['href'];
     $newrefer=$_POST['refer'];
     $newyear=$_POST['year']; 
	 $sql='insert into '.$tablename.'('.$name.','.$des.','.$href.','.$refer.','.$year.') value("'.$newname.'","'.$newdes.'","'.$newhref.'","'.$newrefer.'",'.$newyear.')';
	
     if(mysql_query($sql) or die(mysql_error()))
	 {
		 echo '<script>alert("插入成功!");window.close();window.opener.location.href=window.opener.location.href;</script>';
		 }
	else echo '<script>alert("插入失败!"););window.close();window.opener.location.href=window.opener.location.href;</script>';
	 
	  }
?>

</body>
</html>
