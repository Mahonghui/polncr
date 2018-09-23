
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../unitstyle.css">
<link rel="icon" href="../images/index.ico" type="images/x-icon" />
<title>Databases</title>
<style type="text/css"> 
   .content {width:100%;margin:0 auto; color:#006;background-color:#fff;padding:20px 0;}
   table {width:980px;border:1px solid #000;margin:0px auto;color:#006;font-size:16px;}
</style>
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
  <!--end of header-->
  <div class="menu">
      <ul>
        <li class="parent" onmouseover="displaySubMenu(this)" onmouseout="hideSubMenu(this)">
       <a href="#"><font color="#000">Knowledge</font></a>
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
         <li><a href="../Tools/index_tool.php" target="_self">Tools</a></li>
         <li style="border:none;"><a href="index_database.php">Databases</a></li>
     </ul>
     <div class="clear"></div>
  </div>
  <!--菜单结束-->
  
 <div class="content"> 
 <table  cellpadding="5" rules="all">
<caption style="font-size:20px;padding:10px 0;">Databases for lncRNA study</caption>
<tr>
<th>Index</th>
<th>Name</th>
<th>Description</th>
<th>Linkage</th>
<th>Citation</th>
<th>Year </th>
</tr>

<?php
//连接数据库
 require('../connect.php');
//分页功能
$sql = "select count(*) from dbinfo";
$result=mysql_query($sql) or die('执行失败');
$pagesize=10;//页面大小
$rows=mysql_fetch_row($result);
$recordcount=$rows[0];//获取记录总数
$pagecount=ceil($recordcount/$pagesize);//获取页面总数

$pageno=isset($_GET['pageno'])?$_GET['pageno']:1;//获取页码
if($pageno<1)$pageno=1;
if($pageno>$pagecount)$pageno=$pagecount;
$startno=($pageno-1)*$pagesize;
//获取记录
 $seq=($pageno-1)*$pagesize;
$sql = "select * from (select * from dbinfo order by db_year desc)as tmp limit $startno,$pagesize";
$result=mysql_query($sql) or die(mysql_error());
while($row=mysql_fetch_array($result))//显示信息
{
        $seq++;
	$href=$row['dbhref'];
	echo '<tr><td>'.$seq.'</td>'.'<td>'.$row['dbname'].'</td>'.'<td>'.$row['dbdes'].'</td>'.'<td><a href="'.$href.'"'.'>'.$row['dbhref'].'</a></td>'.'<td>'.($row['dbrefer']==""?'暂无':$row['dbrefer']).'</td><td>'.$row[5].'</td></tr>';
	}
mysql_close($conn);//关闭连接
?>

<!--页码-->
</table>
<table border="0" rules="all">
<tr>
<td style="font-size:20px; text-align:center;">
<a href="?pageno=<?php echo $pageno-1;?>"><<<</a>
<?php
 for($i=1;$i<=$pagecount;$i++)
 {
	echo '<a href="?pageno='.$i.'">'.$i.'</a>&nbsp;';
	 }
?>
<a href="?pageno=<?php echo $pageno+1;?>">>>></a>
</td>
</tr>
</table>

  </div><!--end of content-->
  </div><!--end of box-->
    <div class="footer">
  <div class="clear"></div>
    <p>Copyright © 2016 <a href="http://www.yzu.edu.cn">YangZhou University</a> | 
                  Designed by <a href="http://sc.chinaz.com/" target="_parent">PoLncR</a> | 
                  Validate <a href="http://validator.w3.org/check?uri=referer">XHTML</a> &amp; <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a></p>
  </div>
  <!--end of footer-->
    <div style="width:45px;height:80px;position:fixed;right:5px;bottom:50px;"><a href="#top">
    	<img src="../images/backtop.png" alt="backtotop"></a>
    </div>
    <!--回到顶部-->
</body>
</html>
