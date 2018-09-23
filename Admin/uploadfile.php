<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>批量插入</title>
</head>

<body>
  
<?php
  require('connect.php');	
  $db_id=substr($_SERVER['QUERY_STRING'],stripos($_SERVER['QUERY_STRING'],"=")+1)+0;
  if($db_id==1)
  {$tablename='toolinfo';$keyname='toolnum';$name='toolname';$des='tooldes';$href='toolhref';$refer='toolrefer';$year='tool_year'}
if($db_id==2)
  {$tablename='dbinfo';$keyname='dbnum';$name='dbname';$des='dbdes';$href='dbhref';$refer='dbrefer';$year='db_year';}
  $file=$_FILES['userfile'];
  $path=$_SERVER['DOCUMENT_ROOT']."/polncr/upload_data/".$file['name'];
  $tmp=$file['tmp_name']; 
  if(move_uploaded_file($tmp,$path))
  {
    $fp=fopen($path,"r+");
    while(!feof($fp))
    {
     $arr=array();
     $line=fgets($fp);
     $arr=explode("\t",$line);
     if($arr[0]!="")
    {
     $sql="insert into $tablename($name,$des,$href,$refer,$year) value('$arr[0]','$arr[1]','$arr[2]','$arr[3]','$arr[4]')";
     mysql_query($sql) or die(mysql_error());
   }
}
fclose($fp);
echo '<script>alert("insert successfully!");window.close();window.opener.location.href=window.opener.location.href;</script>';
}




?>
</body>
</html>
