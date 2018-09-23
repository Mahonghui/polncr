<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加记录</title>
<style>
table {margin:50px auto 0;border-spacing:15px;cellpadding:10px; }
.btn {text-align:center;}
</style>

<script>
function on_focus(str)
{
if(!strcmp(str,"Each paragraph is divided by '*' and the field you want to attach an url should be  marked by '##',such as #baidu#"))

document.getElementById("content").value='';

if(str=="If you want to attach more than one url,please separate it with comma marker: ','")

document.getElementById("linkage").value='';

}

function on_blur_1(str)
{
 if(str=='')
 {
  document.getElementById("content").value="Each paragraph is divided by '*' and the field you want to attach an url should be  marked by ##,such as #baidu#";
  document.getElementById("content").style.color="crimson"; 
}
}

function on_blur_2(str)
{
 if(str=='')
 {
 document.getElementById("linkage").value="If you want to attach more than one url,please separate it with comma marker: ','";
 document.getElementById("linkage").style.color="crimson";
}
}
</script>

</head>

<body background="../images/tiny_win_bg.jpg">
<form id="myform" action="" method="POST" >

<table>

<tr>
<td>Index:</td>
<td><input type="number" name="position" min="1" /></td>
</tr>

<tr>
<td>Title:</td>
<td><textarea name="title" cols="50" /></textarea></td>
</tr>

<tr>
<td>Content:</td>
<td><textarea id="content" name="content" cols="50" rows="10" />Each paragraph is divided by '*' and the field you want to attach an url should be  marked by ##,such as #baidu#</textarea>
</td>

</tr>
<tr>
<td>Linkage:</td>
<td>
<textarea type="url" id="linkage" name="linkage"cols="50" />
If you want to attach more than one url,please separate it with comma marker: ','
</textarea>
</td>
</tr>
<tr>
<td class="btn"><input type="reset" value="Reset" /></td>
<td class="btn"><input type="submit" value="Submit" /></td>
</tr>
</table>
</form>

</body>
</html>

<?php
require("../connect.php");
 $db_id=substr($_SERVER['QUERY_STRING'],-1);
        if($db_id==3)
         { $tablename="concepts";}
        if($db_id==5)
          { $tablename="lncRNA_study";}

function adjust_Position($index,$tablename)
{
  $rc=mysql_query("select position from $tablename");
  $i=0;
  while($arr=mysql_fetch_array($rc))
  {
    if($index==$arr[0])
    {
      $delete='delete from '.$tablename.' where position='.$key;
     mysql_query($delete) or die(mysql_error());
     $update="update $tablename set position=position+1 where position >=$index and position <$key";
     mysql_query($update) or die(mysql_error());
 }
}
}

$rc1=mysql_query("select * from $tablename order by position desc limit 1");
$arr1=(mysql_fetch_array($rc1));
$max_index=$arr1[0];


if(isset($_POST['title']))
{
  if(isset($_POST['position']))
  {
    $index=$_POST['position'];
    if($index<$max_index || $index==$max_index)
     adjust_Position($index,$tablename);
}
  else $index=$max_index+1;

  $title=$_POST['title'];
  $content=$_POST['content'];
  $linkage=$_POST['linkage'];
 
  $sql='insert into '.$tablename.' values('.$index.',"'.$title.'","'.$content.'","'.$linkage.'")';
 if( mysql_query($sql) or  die(mysql_error()))
   echo '<script>alert("insert successfully");window.close();window.opener.location.href=window.opener.location.href;</script>';
 else  echo '<script>alert("插入失败!"););window.close();window.opener.location.href=window.opener.location.href;</script>';

}

?>



