<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>
<?php

$filepath="/var/www/html/TFBS/test/input_file/";
$cmdpath="/home/polncr/software/bio/lncRScan-TFBS_v0.0.1_server/scripts/";
$file_info="../TFBS/test/sorted_file/sort_file.txt";
$fp=fopen($file_info,'r+');
$line=fgets($fp);//skip first line
$peak_file=array();
$num=0;
while(!feof($fp))
{
  $line=fgets($fp);
  if($line!="")
 {
  $arr=explode("\t",$line);
  if($arr[1]=="PCTs")
   $PCT_file=$arr[0];
  if($arr[1]=="LNCTs")
   $LNCT_file=$arr[0];
  if($arr[1]=="TFBS_peaks")
   {$peak_file[$num]=$arr[0];$num++;}
 }
}

for($i=0;$i<count($peak_file);$i++)
{
     $cmd="PERL5LIB='$'PERL5LIB:/usr/local/lib/perl5/site_perl/5.24.0/ ".$cmdpath."pre_stats.pl -c ".$peak_file[$i]." -l ".$LNCT_file." -p ".$PCT_file." 2>&1";
exec($cmd,$output);
}
$result_path="../TFBS/test/";
exec("mv pre_stats_out/ ".$result_path);
$file_arr=array();
$file_arr=scandir($result_path.'pre_stats_out/');
$zip_cmd="zip ".$result_path."pre_stats_out/pre_stats_out.zip ".$result_path."pre_stats_out/*";
exec($zip_cmd);
$download="";
$download=$result_path."/pre_stats_out/pre_stats_out.zip";

	$str='<hr style="border:1 dashed color="#009966" width="90%" color="#00FF00" size="1" align="left"">';
	$str.='<div style="padding:0;margin:0;">';
        $str.="<span style='align:left;'>Step2's Result:</span>";
        $str.="<span style=' float:right;margin-top:-3px; margin-right:30px; ' ><a href=".$download." >download &dArr;</a></span>";
	$str.='<ul><li>'.$file_arr[2].'</li><li>'.$file_arr[3].'</li><li>'.$file_arr[4].'</li><li>'.$file_arr[5].'</li></ul></div> '; 
        echo $str; 
?>
<body>

</body>
</html>
