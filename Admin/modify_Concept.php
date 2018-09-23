
<?php 
$str=$_SERVER['QUERY_STRING'];

$end1=strpos($str,"&");
$sub1=substr($str,0,$end1);
$db_id=substr($sub1,stripos($sub1,"=")+1)+0;

$sub2=substr($str,stripos($str,"&"));
$second=stripos($sub2,"=");
$key=substr($sub2,stripos($sub2,"=")+1)+0;

if($db_id==3)
  {$tablename="concepts";}
if($db_id==5)
  {$tablename="lncRNA_study";}

require("../connect.php");
$sql="select * from $tablename  where position=$key";
$result=mysql_query($sql);
$arr=mysql_fetch_row($result);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加记录</title>
<style>
table {margin:50px auto 0;border-spacing:15px;cellpadding:10px; }
.btn {text-align:center;}
</style>
</head>

<body background="../images/tiny_win_bg.jpg">
<form id="myform" action="" method="POST" >

<table>

<tr>
<td>Index:</td>
<td><input type="number" name="position" min="1" value="<?php echo $arr[0];?>" /></td>
</tr>

<tr>
<td>Title:</td>
<td><textarea name="title"  cols="50" /><?php echo $arr[1];?></textarea></td>
</tr>

<tr>
<td>Content:</td>
<td><textarea id="content" name="content" cols="50" rows="10"/><?php echo $arr[2];?></textarea>
</td>

</tr>
<tr>
<td>Linkage:</td>
<td>
<textarea type="url" id="linkage" name="linkage"cols="50" /><?php echo $arr[3];?></textarea>
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

function adjust_Position($index,$key,$tablename)
{
  $rc=mysql_query("select *  from $tablename");
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
  $index=isset($_POST['position'])?$_POST['position']:($max_index+1);

$new_title=$_POST['title'];
$new_content=$_POST['content'];
$new_linkage=$_POST['linkage'];
if($index==$key)
{
 $update='update '.$tablename.' set title="'.$new_title.'", content="'.$new_content.'",linkage="'.$new_linkage.'" where position='.$index;
 if(mysql_query($update) or die(mysql_error()))
  echo '<script> alert("Update successfully");window.close();window.opener.location.href=window.opener.location.href;</script>';
  else echo '<script> alert("Update failure");window.close();window.opener.location.href=window.opener.location.href;</script>';
}

else
{
    adjust_Position($index,$key,$tablename);
    $insert='insert into '.$tablename.' values('.$index.',"'.$new_title.'","'.$new_content.'","'.$new_linkage.'")';
     if(mysql_query($insert) or die(mysql_error()))
    echo '<script> alert("Update successfully");window.close();window.opener.location.href=window.opener.location.href;</script>';
    else echo '<script> alert("Update failure");window.close();window.opener.location.href=window.opener.location.href;</script>';

}

}
?>


	
