<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>
<?php
 error_reporting(0);
 function check_exist($type)
  {
 if(file_exists("../TFBS/test/input_file/file_info.txt"))
  {
     $fp=fopen("../TFBS/test/input_file/file_info.txt","r+");
     while(!feof($fp))
     {
       $arr=array();
       $line=fgets($fp);
       if($line!="")
    {    
       $arr=explode("\t",$line);   
       if($arr[0]!="")
        {
         if($arr[2]==$type)
         return true;
        }    
    }
   }
  }
else  file_put_contents("../TFBS/test/input_file/file_info.txt","  Name\t\t\tPath\t\t\t\t\t\tType\tFlag");
return false;
}

function is_first()
{
  $fp=fopen("../TFBS/test/input_file/file_info.txt","r+");
  $count=0;
  while(!feof($fp))
  {
     $line=fgets($fp);
     if($line!="")
         $count++;
}
if($count==2)return true;
else return false; 
  
}

$url=$_SERVER['REQUEST_URI'];
$str=explode("=",$url);
$filename=$str[1];
//echo $filename;
$file=$_FILES[$filename];
$tmp=$file['tmp_name'];
$file_path="/var/www/html/TFBS/test/input_file/".$file['name'];

if($filename=="PCTs")
{
  if(check_exist("PCTs"))
    {echo "<script>alert('you have already uploaded PCTs file');history.back(); </script>";exit();}
 else
{
   move_uploaded_file($tmp,$file_path) or die();
  $type="PCTs";
  $flag="protein coding"; 
}
}

if($filename=="LNCTs")
  {
   if(check_exist("LNCTs"))
    {echo "<script>alert('you have already uploaded LNCTs file');history.back();</script>";exit();}
 else
{
   move_uploaded_file($tmp,$file_path);
   $type="LNCTs";
   $flag="lncRNA"; 
}
}

if($filename=="TFBS_peaks")
{
    move_uploaded_file($tmp,$file_path);
    $type="TFBS_peaks";
    if($_POST['flag']!="")
      $flag=$_POST['flag'];
    else
      $flag="default flag";   
}
$name=$file['name'];
file_put_contents("../TFBS/test/input_file/file_info.txt","\n".$file['name']."\t$file_path\t$type\t$flag",FILE_APPEND);
if(is_first())
{
$content="<p>Input file:</p>";
$content.="&nbsp;&nbsp;$name<br />";
}
else $content="&nbsp;&nbsp;$name<br />";
echo "<script>
var midd=window.frames;
var top=midd.parent;
var right=top.frames['right'];
right.document.getElementById('input_file').innerHTML='hello';
</script>";

echo "<script>alert('upload successfully'); self.location.href='upload_file.html';</script>";
?>

<body>
</body>
</html>
