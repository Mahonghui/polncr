<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html> <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="../unitstyle.css"/>
  <link rel="stylesheet" type="text/css" href="knowledge.css"/>
<link rel="icon" href="../images/index.ico" type="image/x-icon" />
  <title>Well-studied lncRNAs</title>
  <script type="text/javascript">
  function displaySubMenu(li) { 
  var subMenu = li.getElementsByTagName("ul")[0]; 
  subMenu.style.display ="block";
  } 
  function hideSubMenu(li) { 
  var subMenu = li.getElementsByTagName("ul")[0]; 
  subMenu.style.display ="none"; 
  }  
  </script>
  </head>
  
  <body>
  <a name="top"></a>
   <div class="box">
     <div class="header">
       <ul>
         <li><a href="../index.php"><img id="headerpic" src="../images/logo.png" alt="logo" title="Homepage"/></a><!--扬大logo-->
         <li class="title"><b>PoLncR</b>: a platform for lncRNA data/information collection, analysis and prediction
  </li>
      </ul>
      <div class="clear"></div>
     </div>
 
  <div class="menu">
      <ul>
        <li class="parent" onmouseover="displaySubMenu(this)" onmouseout="hideSubMenu(this)">
       <a href="#"> <font color="#000">Knowledge</font></a>
        <ul style="display:none;background:#0090FD;width:100%;border-radius:10px;">
        <li style="border-bottom:1px solid #CF9;"><a href="Basic_Knowledge.php" target="_self">Basic Concept</a></li>
        <li><a href="Well_studied_lncRNAs.php" target="_self">Well-studied lncRNAs</a></li>
        </ul>           
        </li>
        
          <li class="parent" onmouseover="displaySubMenu(this)" onmouseout="hideSubMenu(this)">
                                     <a href="#"><font color="#000">Browser</font></a>
                                     <ul style="display:none;background:#0090FD;width:100%;border-radius:10px;">
                                        <li style="border-bottom:1px solid #CF9;"><a href="/cgi-bin/gb2/gbrowse/yeast/">GBrowse</a></li>
                                        <li style="border:none;"><a href="../../genomebrowser/"  target="_self">UCSC</a></li>
                                    </ul>
                                     </li>

         <li><a href="../Analysis_Computation/analysis_computation.html" >Analysis&Computation </a></li>
         <li><a href="../Tools/index_tool.php" target="_self">Tools</a></li>
         <li style="border:none;"><a href="../Databases/index_database.php">Databases</a></li>
     </ul>
     <div class="clear"></div>
</div>
<!--统一网站样式结束-->

<div class="content">
<h2>A list of well-studied lncRNAs</h2>
<div class="index">
<ul>
<?php 
require("../connect.php");
$result=mysql_query("select * from lncRNA_study order by position") or die(mysql_error());
$anchor=1;
while($arr=mysql_fetch_array($result))
{
   echo '<li><img src="../images/toleft.png.png">&nbsp;<a href="#A'.$anchor.'">'.$arr[1].'</a><li><br/>';
   $anchor++;
}

echo "</ul></div>";

$result=mysql_query("select * from lncRNA_study  order by position") or die(mysql_error());
$name=1;
while($arr1=mysql_fetch_array($result))
{
  $str='<a name="A'.$name.'"></a>';
  $name++;
  $str=$str.'<div class="box1">';
  $str=$str.'<h3>'.$arr1[1].'</h3>';
  $str=$str.'<ul>';

  $para_arr=explode("*",$arr1[2]);
  $attach_arr=explode("#",$arr1[2]);
  $linkage_arr=explode(",",$arr1[3]);



for($i=0,$len=count($para_arr);$i<$len;$i++)
{
$str=$str.'<li>';
$attach_arr=explode("#",$para_arr[$i]);

 for($j=0;$j<count($attach_arr);$j++)
 {
  if($j%2==0)
   $str=$str.$attach_arr[$j];
 else
  {
    if($j==1)
   $str=$str.'<a href="'.$linkage_arr[log($j,2)].'">'.$attach_arr[$j].'</a>';
    else
   $str=$str.'<a href="'.$linkage_arr[log($j-1,2)].'">'.$attach_arr[$j].'</a>';
 }
}
$str=$str.'</li><br/>';
}

$str=$str.'</ul></div>';
echo $str;
}
?>

<p>Reference:</p>

</div>
</div>
<!--内容结束-->

 <div class="footer">
    <p>Copyright © 2016 <a href="http://www.yzu.edu.cn">YangZhou University</a> | 
                  Designed by <a href="http://sc.chinaz.com/" target="_parent">PoLncR</a> | 
                  Validate <a href="http://validator.w3.org/check?uri=referer">XHTML</a> &amp; <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a></p>
  </div>
  <!--页脚结束-->
    <div style="width:45px;height:80px;position:fixed;right:5px;bottom:50px;"><a href="#top">
    <img src="../images/backtop.png" alt="backtotop"></a></div>
   <!--回到顶部-->
</body>
</html>
