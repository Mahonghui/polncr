<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../unitstyle.css"/><!--引入网站统一头尾样式-->
<link rel="icon" href="../images/index.ico" type="image/x-icon" /><!--网站图标-->
<script type="text/javascript" src="../index.js"></script> <!--引入下拉菜单效果-->
<title>News</title>
<style>
.box1 {background-color:#FFEFD5;padding:10px 20px;margin:0 auto;;}
.box1 a:hover{text-decoration:none;color:red;}
h2 {margin:0; color:}
.box1 table{width:100%;margin-top:20px;border-collapse:collapse;font-size:16px;border-spacing:0;}
.box1 table td{padding:8px;}
tr {border-bottom:1px dashed #FFA500;}
.page {text-align:center; font-size:16px;padding-top:10px; }
</style>
</head>

<body>
<div class="box">
        <div class="header">
                <ul>
                        <li><a href="../index.php"><img id="headerpic" src="../images/logo.png" alt="logo" title="Homepage"/></a><!--扬大logo-->
                                <li class="title"><b>PoLncR</b>: a platform for lncRNA data/information collection, analysis and prediction
                        </li>
                </ul>
                        <div class="clear"></div>
                </div>
                <!--页首结束-->
                <div class="menu">
                        <ul>
                                <li class="parent" onmouseover="displaySubMenu(this)" onmouseout="hideSubMenu(this)">
                                      <a href="#"><font color="#000">Knowledge</font></a> <!--鼠标悬停下拉菜单-->
                                        <ul style="display:none;background:#0090FD;width:100%;border-radius:10px;">
                                                <li style="border-bottom:1px solid #CF9;"><a href="Knowledge/Basic_Knowledge.php" target="_self">Basic Concept</a></li>
                                                <li><a href="Knowledge/Well_studied_lncRNAs.html" target="_self">Well-studied lncRNAs</a></li>
                                        </ul>
                                </li>

                                <li><a href="/cgi-bin/gb2/gbrowse/yeast/" >GBrowse</a></li>
                                <li><a href="Analysis_Computation/analysis_computation.html" >Analysis&Computation </a></li>
                                <li><a href="Tools/index_tool.php">Tools</a></li>
                                <li style="border:none;"><a href="Databases/index_database.php">Databases</a></li>
                        </ul>
                        <div class="clear"></div>
                </div>
        <!--菜单栏结束-->

    <div class="box1">
      <h2>News List</h2><hr/>
      <table>
        <?php 
         require("../connect.php");
         $sql="select count(*) from news";
        $result=mysql_query($sql) or die('执行失败');
        $rows=mysql_fetch_row($result);
        $recordcount=$rows[0];//获取记录总数
        $pagesize=7; //定义页面大小
        $pagecount=ceil($recordcount/$pagesize);//计算总页数

        $pageno=isset($_GET['pageno'])?$_GET['pageno']:1;
        if($pageno<1)$pageno=1;
        if($pageno>$pagecount)$pageno=$pagecount;
        $startno=($pageno-1)*$pagesize;
         $seq=($pageno-1)*$pagesize;
        $sql="select * from (select * from news order by news_time desc) as tmp  limit $startno,$pagesize";//获取指定记录
        $result=mysql_query($sql) or die(mysql_error());
        $i=1;
         while($arr=mysql_fetch_array($result))
          {
            $time_arr=explode(" ",$arr[4]);
            $seq++; 
            if($i%2!=0)
             $str='<tr bgcolor="#F5DEB3">';
            else $str='<tr bgcolor="#E6E6FA">';
         
            $str=$str.'<td>'.$seq.'</td><td><a href="news_'.$arr[0].'.html">'.$arr[1].'</a></td>';
            $str=$str.'<td>'.$time_arr[0].'<td></tr>';
            echo $str;
            $i++;
          }
     ?>
      </table> 


   <p class="page">
   <a href="?pageno=<?php echo $pageno-1;?>" ><<<</a>
   <?php
   for($i=1;$i<=$pagecount;$i++)
   {
      echo '<a href="?pageno='.$i.'">'.$i.'</a>&nbsp;';
   }
   ?>
   <a href="?pageno=<?php echo $pageno+1?>">>>></a>
   </p>
    </div>
    
 

  </div> <!--box结束-->



        <div class="footer">

                <p>Copyright © 2016 <a href="http://www.yzu.edu.cn">YangZhou University</a> |
                        Designed by <a href="http://sc.chinaz.com/" target="_parent">PoLncR</a> |
                        Validate <a href="http://validator.w3.org/check?uri=referer">XHTML</a> &amp; <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a></p>
                </div>




</body>
</html>
