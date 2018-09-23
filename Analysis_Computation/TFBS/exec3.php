<?php
error_reporting(E_ALL);
$file_info="../TFBS/test/input_file/file_info.txt";
$fp=fopen($file_info,"r+");
$line=fgets($fp);
$peak_file=array();
$num=0;
while(!feof($fp))
{
  $line=fgets($fp);
  if($line!="")
 {
  $arr=explode("\t",$line);  
  if($arr[2]=="PCTs")$PCT_file=$arr[1];
  if($arr[2]=="LNCTs")$LNCT_file=$arr[1];
  if($arr[2]=="TFBS_peaks")
    {$peak_file[$num]=$arr[1];$num++; }  
 }
}

if(!file_exists("../TFBS/test/tss_peak/"))
 { exec("mkdir ../TFBS/test/tss_peak/"); }

$cmdpath="/home/polncr/software/bio/lncRScan-TFBS_v0.0.1_server/scripts/";
for($i=0;$i<count($peak_file);$i++)
{
   $cmd=$cmdpath."tss_peak_distance.pl -g $LNCT_file -c ".$peak_file[$i]." -m min_dis -u 5000 -o  ../TFBS/test/tss_peak/LNCT_peak 2>&1";
   exec($cmd,$output,$rc);
 $cmd=$cmdpath."tss_peak_distance.pl -g $PCT_file -c ".$peak_file[$i]." -m min_dis -u 5000 -o  ../TFBS/test/tss_peak/PCT_peak";
   exec($cmd);
}
/* $cmd=$cmdpath."tss_peak_stats.pl -l ../TFBS/test/tss_peak/LNCT_peak.table -p ../TFBS/test/tss_peak/PCT_peak.table 2>&1";//step 4
 exec($cmd,$output,$rc);
 exec("mv tss_peak_stats_out/ ../TFBS/test/tss_peak/ 2>&1",$output,$rc);
 exec("rm -rf tss_peak_stats_out/");*/
 $tss_peak=array_diff(scandir("../TFBS/test/tss_peak/"),array('.','..'));
// $stats_out=array_diff(scandir("../TFBS/test/tss_peak/tss_peak_stats_out/"),array('.','..'));

$zip_cmd="zip -r ../TFBS/test/tss_peak/tss_peak.zip ../TFBS/test/tss_peak/*";
exec($zip_cmd,$output,$rc);

 $download="../TFBS/test/tss_peak/tss_peak_stats_out.zip";
 echo '<hr style="border:1 dashed color="#009966" width="90%" color="#00FF00" size="1" align="left"">';
 echo "<span style='align:left;'>Step3's Result:</span>";
 echo "<span style=' float:right;margin-top:-3px; margin-right:30px; ' ><a href=$download  >download &dArr;</a></span>";
 
 echo "<ul>
<li>".$tss_peak[2]." </li>
<li>".$tss_peak[3]." </li>
<li>".$tss_peak[4]." </li>
<li>".$tss_peak[5]." </li>
</ul></div>";

?>




