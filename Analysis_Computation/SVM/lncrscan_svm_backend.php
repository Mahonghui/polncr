<?php
error_reporting(E_ALL);
$file=$_FILES['upload'];
$path=$_SERVER['DOCUMENT_ROOT']."/upload_data/SVM_upload_data/".$file['name'];
$tmp=$file['tmp_name'];

$outdir='/var/www/html/output/SVM_output/';

if(move_uploaded_file($tmp,$path))
{
  $confpath='/home/polncr/software/bio/lncRScan-SVM_v1.0.1/conf/';
  $species=$_POST['Species'];
  $version=$_POST['Version'];

  if($species=='hg19')
    $confname="hg19.conf";
  if($species=="mm10")
    $confname="mm10.conf";

    $result=array();
    system('sh /home/polncr/start.sh',$rc1);
    if(!$rc1)
    {
    $cmd='/home/polncr/software/bio/lncRScan-SVM_v1.0.1/executable/script/lncRScan-SVM-predict.py -c '.$confpath.$confname.' -g '.$path.' -o '.$outdir; 
    exec($cmd,$output,$rc2);
    $rcpath= $outdir.basename($path,".gtf").'.prediction.result';
    echo '<pre>'.file_get_contents($rcpath).'</pre>';
 }
  else exit("fail to run start.sh"); 
}
else
  exit("upload failure!");
?>
