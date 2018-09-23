<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>
<?php
$test_dir="/var/www/html/TFBS/test";
$input_dir=$test_dir."/input_file/";
$file_arr=scandir($input_dir);

$fp=fopen($input_dir."file_info.txt","r+");
$line=fgets($fp);
while(!feof($fp))
{
  $line=fgets($fp);
  if($line!="")
  {
    $arr=explode("\t",$line);
    if($arr[2]=="LNCTs")
    {
      $cmd="sort ".$arr[1]."> /var/www/html/TFBS/test/sorted_file/".$arr[0].".sorted";
      exec($cmd);
      $type="LNCTs";
    }  

   if($arr[2]=="PCTs")
   {
      $cmd="sort ".$arr[1]."> /var/www/html/TFBS/test/sorted_file/".$arr[0].".sorted";
      exec($cmd);
      $type="PCTs";
   }
    if($arr[2]=="TFBS_peaks")
    {
      $cmd="sort -k1,1 -k2n ".$arr[1]."> /var/www/html/TFBS/test/sorted_file/".$arr[0].".sorted";
      exec($cmd);
      $type="TFBS_peaks";    
    }
  file_put_contents("../TFBS/test/sorted_file/sort_file.txt","/var/www/html/TFBS/test/sorted_file/".$arr[0].".sorted\t$type\n",FILE_APPEND); 
}

}
exec("rm ../TFBS/test/sorted_file/*.bed");





/*
$cmd1="sort ".$input_dir.$file_arr[2]."> /var/www/html/TFBS/test/sorted_file/".$file_arr[2];
$cmd2="sort ".$input_dir.$file_arr[3]."> /var/www/html/TFBS/test/sorted_file/".$file_arr[3];
$cmd3="sort -k1,1 -k2n ".$input_dir.$file_arr[4]."> /var/www/html/TFBS/test/sorted_file/".$file_arr[4];

exec($cmd1);
exec($cmd2);
exec($cmd3);
*/


$sort_dir=$test_dir."/sorted_file/";
$sorted_file_arr=scandir($sort_dir);
$zip_cmd="zip ".$sort_dir."test_sorted.zip"." ".$sort_dir."*";
exec($zip_cmd);
$download="../TFBS/test/sorted_file/test_sorted.zip";

echo '<hr style="border:1 dashed color="#009966" width="90%" color="#00FF00" size="1" align="left"">';
echo "<div style='padding:0;margin:0; ' >";
echo "<span style='align:left;'>Step1's Result:</span>";

echo "<span style=' float:right;margin-top:-3px; margin-right:30px; ' ><a href=$download  >download &dArr;</a></span>";

echo "<ul>
<li>".$sorted_file_arr[3]." </li>
<li>".$sorted_file_arr[4]." </li>
<li>".$sorted_file_arr[5]." </li>
</ul></div>
";

?>
<body>
</body>
</html>
