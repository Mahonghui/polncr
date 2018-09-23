<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../unitstyle.css"/>
<link rel="icon" href="../images/index.ico" type="image/x-icon" />
<title>Tool</title>
<style type="text/css">
.content {width:100%;margin:0 auto; color:#006;background-color:#fff;padding:20px 0;}
table {width:980px;border:1px solid #000;margin:0px auto;font-size:16px;}
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
			<li><a href="../index.php"><img id="headerpic" src="../images/logo.png" alt="logo" title="Homepage" /></a>
				<li class="title"><b>PoLncR</b>: a platform for lncRNA data/information collection, analysis and prediction
				</li>
			</ul>
			<div class="clear"></div>
		</div>
		<!--页首结束-->
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
				<li><a href="index_tool.php">Tools</a></li>
				<li style="border:none;"><a href="../Databases/index_database.php">Databases</a></li>
			</ul>
			<div class="clear"></div>
		</div>
        <!--菜单结束-->
   <div class="content">
   <table cellpadding="5" rules="all">
   <caption style="font-size:20px;padding:10px 0;">Computational tools for lncRNA study</caption>
   <tr>
   <th>Index</th>
   <th>Name</th>
   <th>Description</th>
   <th>Linkage</th>
   <th>Citation</th>     
   <th>Year</th>
   </tr>
   
   <?php
    require('../connect.php');
	 //分页功能
	$sql="select count(*) from toolinfo";
	$result=mysql_query($sql) or die('执行失败');
	$rows=mysql_fetch_row($result);
	$recordcount=$rows[0];//获取记录总数
	$pagesize=10; //定义页面大小
	$pagecount=ceil($recordcount/$pagesize);//计算总页数
	
	$pageno=isset($_GET['pageno'])?$_GET['pageno']:1;
	if($pageno<1)$pageno=1;
	if($pageno>$pagecount)$pageno=$pagecount;
	$startno=($pageno-1)*$pagesize;
	 $seq=($pageno-1)*$pagesize;
	$sql="select * from (select * from toolinfo order by tool_year desc) as tmp  limit $startno,$pagesize";//获取指定记录
	$result=mysql_query($sql) or die(mysql_error());
	while($row=mysql_fetch_array($result))//显示结果
	{
                $seq++;
		$href=$row['toolhref'];
		echo '<tr><td>'.$seq.'</td><td>'.$row['toolname'].'</td><td>'.$row['tooldes'].'</td><td><a href="'.$href.'"'.'>'.$row['toolhref'].'</a>'.'</td><td>'.$row['toolrefer'].'</td><td>'.$row['tool_year'].'</td></tr>';
		}
		mysql_close($conn);
   ?>
   </table>
   
   <!--页码-->
   <table border="0" rules="all">
   <tr>
   <td style="font-size:20px; text-align:center;">
   <a href="?pageno=<?php echo $pageno-1;?>" ><<<</a>
   <?php
   for($i=1;$i<=$pagecount;$i++)
   {
      echo '<a href="?pageno='.$i.'">'.$i.'</a>&nbsp;';
   }
   ?>
   <a href="?pageno=<?php echo $pageno+1?>">>>></a>
   </td>
   </tr>
   </table>
   
   </div>
<!--end of content-->
      
       </div> 
     <div class="footer">
		
		<p>Copyright &copy; 2016 <a href="http://www.yzu.edu.cn">YangZhou University</a> | 
			Designed by <a href="http://sc.chinaz.com/" target="_parent">PoLncR</a> | 
			Validate <a href="http://validator.w3.org/check?uri=referer">XHTML</a> &amp; <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a></p>
		</div>
        <!--end of footer-->
		<div style="width:45px;height:80px;position:fixed;right:5px;bottom:50px;"><a href="#top">
			<img src="../images/backtop.png" alt="backtotop"></a></div>
            <!--回到顶部-->   
</body>
</html>
