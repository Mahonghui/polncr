<?php
error_reporting(E_ERROR);

$query_string=$_SERVER['QUERY_STRING'];
$end=strpos($query_string,'=');
$key=substr($query_string,$end+1)+0;

require("../connect.php");
$sql="select * from news where news_id=$key";
$result=mysql_query($sql);
$arr=mysql_fetch_row($result);

$time_arr=explode("-",$arr[4]);
$expel=explode(" ",$time_arr[2]);
$day=$expel[0];
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加记录</title>
<style>
table {margin:50px auto 0;border-spacing:15px;cellpadding:10px; }
.btn {text-align:center;}
.time {width:40px;}
</style>
</head>

<body background="../images/tiny_win_bg.jpg">
<form id="myform" action="" method="POST" >

<table>

<tr>
<td>News_id:</td>
<td><input type="number" name="news_id" readonly="readonly" value="<?php echo $arr[0];?>" /></td>
</tr>

<tr>
<td>Title:</td>
<td><textarea  name="news_title" cols="50" ><?php echo $arr[1];?></textarea></td>
</tr>

<tr>
<td>Content:</td>
<td><textarea id="content" name="news_content" cols="50" rows="15"/><?php echo $arr[2];?></textarea>
</td>

</tr>
<tr>
<td>Reference:</td>
<td><textarea  name="news_refer" cols="50" ><?php echo $arr[3];?></textarea></td>
</tr>
<tr>
<td>News time:</td>
<td><input type="text" name="year" class="time" value="<?php echo $time_arr[0];?>"/> year <input type="text" name="month" class="time" value="<?php echo $time_arr[1];?>" /> month <input type="text" name="day" class="time" value="<?php echo $day;?>" /> day </td>
</tr>
<tr>
<td class="btn"><input type="reset" value="Reset" /></td>
<td class="btn"><input type="submit" value="Submit" /></td>
</tr>
</table>
</form>
</body>
</html>

<?php
if(isset($_POST['news_title']))
{
 $title=$_POST['news_title'];
 $content=$_POST['news_content'];
 $reference=(isset($_POST['news_refer']))?($_POST['news_refer']):'';
 $time=$_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
 $edit_time=date("Y-m-d H:m:s");
 $time_arr=explode(" ",$edit_time);
 $Time=$time_arr[0];
  $top='<html>
       <head>
          <link rel="stylesheet" type="text/css" href="../unitstyle.css"/>
          <link rel="icon" href="../images/index.ico" type="image/x-icon" />
          <link rel="stylesheet" type="text/css" href="../news.css"/>
           <script type="text/javascript" src="../index.js"></script>
           <title>'.$title.'</title>
       </head>
       <body>
        <div class="box">
        <div class="header">
                <ul>
                        <li><a href="../index.php"><img id="headerpic" src="../images/logo.png" alt="logo" title="Homepage"/></a>
                                <li class="title"><b>PoLncR</b>: a platform for lncRNA data/information collection, analysis and prediction
                        </li>
                </ul>
                        <div class="clear"></div>
                </div>
            <div class="menu">
                        <ul>
                                <li class="parent" onmouseover="displaySubMenu(this)" onmouseout="hideSubMenu(this)">
                                        <font color="#000">Knowledge</font> <!--鼠标悬停下拉菜单-->
                                        <ul style="display:none;background:#0090FD;width:100%;border-radius:10px;">
                                                <li style="border-bottom:1px solid #CF9;"><a href="../Knowledge/Basic_Knowledge.php" target="_self">Basic Concept</a></li>
                                                <li><a href="../Knowledge/Well_studied_lncRNAs.php" target="_self">Well-studied lncRNAs</a></li>
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
                                <li><a href="../Tools/index_tool.php">Tools</a></li>
                                <li style="border:none;"><a href="../Databases/index_database.php">Databases</a></li>
                        </ul>
                        <div class="clear"></div>
                </div>';
 
             $bottom='</div> <div class="footer"> <p>Copyright © 2016 <a href="http://www.yzu.edu.cn">YangZhou University</a> |
                        Designed by <a href="http://sc.chinaz.com/" target="_parent">PoLncR</a> |
                        Validate <a href="http://validator.w3.org/check?uri=referer">XHTML</a> &amp; <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a></p>
                </div>
                </body>
                </html>';

     $write_contents=$top.'<div class="box1"><p class="title">'.$title.'</p><br /><p class="sub_title">last edit: '.$Time.'</p><div class="content">';

$para_arr=explode("*",$content);
for($i=0,$len=count($para_arr);$i<$len;$i++)
  $write_contents=$write_contents.'<p>'.$para_arr[$i].'</p>';

if($reference!='')
  $write_contents=$write_contents.'<p>This article is cited from <a href="'.$reference.'"/>'.$reference.'</a></p>';


$write_contents=$write_contents.'</div><p class="print"><input type="button" value="print" onclick="javascript:window.print();" /><input type="button" value="close" onclick="javascript:window.close();" /> </p></div>'.$bottom;

  file_put_contents("news/news_$key.html",$write_contents);
 
  $update='update news set news_title="'.$title.'", news_content="'.$content.'",news_refer="'.$reference.'",news_time="'.$time.'" ,edit_time="'.$edit_time.'" where news_id='.$key;
  if(mysql_query($update) or die(mysql_error()))
      echo '<script>alert("update successfully");window.close();window.opener.location.href=window.opener.location.href;</script>';
  else echo '<script>alert("update failed");window.close();window.opener.location.href=window.opener.location.href;</script>';


  

}


?>







