<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>
<?php
 echo $_SESSION['ip'];
 error_reporting(E_ALL);
/* function check_exist($type)
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
*/



$TFBS_count=$_POST['TFBS_count'];

$filename="PCTs";
$file=$_FILES[$filename];
$file_path="/var/www/html/TFBS/test/input_file/".$file['name'];
$tmp=$file['tmp_name'];

move_uploaded_file($tmp,$file_path) or die();
$type="PCTs";
$flag=(isset($_POST['PCT_flag'])?$_POST['PCT_flag']:"protein coding");

file_put_contents("../TFBS/test/input_file/file_info.txt",$file['name']."\t$file_path\t$type\t$flag\t".$_POST['species']."\n",FILE_APPEND);

$filename="LNCTs";
$file=$_FILES[$filename];
$file_path="/var/www/html/TFBS/test/input_file/".$file['name'];
$tmp=$file['tmp_name'];

move_uploaded_file($tmp,$file_path) or die();
$type="LNCTs";
$flag=(isset($_POST['LNCT_flag'])?$_POST['LNCT_flag']:"lncRNA");

file_put_contents("../TFBS/test/input_file/file_info.txt",$file['name']."\t$file_path\t$type\t$flag\t".$_POST['species']."\n",FILE_APPEND);



for($i=1;$i<$TFBS_count+1;$i++)
{
 $filename='TFBS_peaks'.$i;
 $file=$_FILES[$filename];
 $tmp=$file['tmp_name'];
 $file_path="/var/www/html/TFBS/test/input_file/".$file['name'];

    move_uploaded_file($tmp,$file_path);
    $type="TFBS_peaks";
    $flag=(isset($_POST['TFBS_flag'.$i])?$_POST['TFBS_flag'.$i]: "TFBS");   


file_put_contents("../TFBS/test/input_file/file_info.txt",$file['name']."\t$file_path\t$type\t$flag\t".$_POST['species']."\n",FILE_APPEND);

}

//file_put_contents("../TFBS/test/input_file/file_info.txt","\n".$_POST['species'],FILE_APPEND);

$file_arr=array_diff(scandir("../TFBS/test/input_file/"),array('.','..'));
$content="<div><span style='align:left;'>Uploaded Files:</span>";
$content.='<ul><li>'.$file_arr[2].'</li><li>'.$file_arr[3].'</li><li>'.$file_arr[5].'</li><li>Species:'.$_POST['species'].'</li></ul></div>';
echo "<script>var midd=window.frames;var top=midd.parent;
var right=top.frames['right'];
right.document.getElementById('input_file').innerHTML=$content;</script>";
//echo "<script>alert('upload successfully'); self.location.href='upload_file.html';</script>";
?>

<body>
</body>
</html>
