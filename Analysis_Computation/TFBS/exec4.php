<?php
$cmdpath="/home/polncr/software/bio/lncRScan-TFBS_v0.0.1_server/scripts/";
$cmd=$cmdpath."tss_peak_stats.pl -l ../TFBS/test/tss_peak/LNCT_peak.table -p ../TFBS/test/tss_peak/PCT_peak.table 2>&1";//step 4
 exec($cmd,$output,$rc);
 exec("mv tss_peak_stats_out/ ../TFBS/test/tss_peak/ 2>&1",$output,$rc);
 exec("rm -rf tss_peak_stats_out/");
 
 $zip_cmd="zip -r ../TFBS/test/tss_peak/tss_peak_stats_out.zip ../TFBS/test/tss_peak/tss_peak_stats_out/*";
 exec($zip_cmd,$output,$rc);
 $stats_out=array_diff(scandir("../TFBS/test/tss_peak/tss_peak_stats_out/"),array('.','..'));

 $download="../TFBS/test/tss_peak/tss_peak_stats_out.zip";
 echo '<hr style="border:1 dashed color="#009966" width="90%" color="#00FF00" size="1" align="left"">';
 echo "<span style='align:left;'>Step4's Result:</span>";
 echo "<span style=' float:right;margin-top:-3px; margin-right:30px; ' ><a href=$download  >download &dArr;</a></span>";
 echo "<ul>";
 for($i=2;$i<count($stats_out)+2;$i++)
  {
     echo "<li>".$stats_out[$i]."</li>";
}
echo "<ul>";

?>
