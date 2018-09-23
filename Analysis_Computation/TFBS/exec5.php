<?php

error_reporting(E_ALL);
$file_path="../TFBS/test/tss_peak/";
$cmdpath2="/home/polncr/software/bio/lncRScan-SVM_v1.0.1/executable/bin/x86_64/";
$cmdpath="/home/polncr/software/bio/lncRScan-TFBS_v0.0.1_server/scripts/";

$fp=fopen("../TFBS/test/input_file/file_info.txt","r+");
$line=fgets($fp);
$line=fgets($fp);
$line=fgets($fp);
$arr=explode("\t",$line);
$flag=trim($arr[4]);
$genome_path="/home/polncr/dataset/genome/".$flag."/";


$cmd=$cmdpath."peak_bed2gtf.pl -i ".$file_path."PCT_peak.bed > ".$file_path."PCT_peak.gtf 2>&1";
exec($cmd,$output,$rc);
$cmd=$cmdpath."peak_bed2gtf.pl -i ".$file_path."LNCT_peak.bed > ".$file_path."LNCT_peak.gtf";
exec($cmd,$output,$rc);

$cmd=$cmdpath2."gffread -w ".$file_path."PCT_peak.fa -g ".$genome_path." ".$file_path."PCT_peak.gtf 2>&1";
exec($cmd,$output,$rc);
$cmd=$cmdpath2."gffread -w ".$file_path."LNCT_peak.fa -g ".$genome_path." ".$file_path."LNCT_peak.gtf 2>&1";
exec($cmd,$output,$rc);

 $zip_cmd="zip -r ../TFBS/test/tss_peak/gtf.zip ../TFBS/test/tss_peak/tss_peak_stats_out/*.gtf";
 exec($zip_cmd,$output,$rc);
 $gtf_out=array_diff(scandir("../TFBS/test/tss_peak/tss_peak_stats_out/"),array('.','..'));
 
                                 
 $download="../TFBS/test/tss_peak/gtf.zip";
 echo '<hr style="border:1 dashed color="#009966" width="90%" color="#00FF00" size="1" align="left"">';
 echo "<span style='align:left;'>Step5's Result:</span>";
 echo "<span style=' float:right;margin-top:-3px; margin-right:30px; ' ><a href=$download  >download &dArr;</a></span>";
 echo "<ul>";
 echo "<li>PCT_peak.gtf</li>";
 echo "<li>LNCT_peak.gtf</li>";
 echo "</ul>"; 


?>
       
