<?php
require("check_login.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../unitstyle.css"/><!--引入网站统一头尾样式-->
<link rel="icon" href="../images/index.ico" type="image/x-icon" /><!--网站图标-->
<title>后台管理</title>
<style>
.box1 {margin:0px auto;padding:0; background-color: #FFF;padding:50px 0 0 0;}
.box1 table{margin:0px auto;padding:20px 0;width:980px;cellpadding:5px;font-size:16px; border:2px solid; color:#036;}
.box1 table td{width:150px; text-align:center; text-indent:hanging;padding:5px;}
.box1 table .addcol { text-align:right; padding-right:20px;	}

</style>

</head>

<body>

<div class="box">   
	<div class="header">
		<ul>
			<li><a href="../index.php"><img id="headerpic" src="../images/logo.png" alt="logo" title="Homepage"/></a><!--扬大logo-->
				<li class="title" >LncRNA生物信息平台管理系统
			</li>
		</ul>
			<div class="clear"></div>
		</div>
		<!--页首结束-->
		<div class="menu">
			<ul>				
				<li><a href="list.php?db_id=1">Tools</a></li>
				<li><a href="list.php?db_id=2">Databases</a></li>
                                <li><a href="knowledge_list.php?db_id=3">Basic concepts</a></li>
                                <li><a href="news_list.php">News</a></li>
                <li style="border:none;"><a href="knowledge_list.php?db_id=5">Study of lncRNAs</a></li>	
        	</ul>
			<div class="clear"></div>
		</div>
        
     <?php $db_id=substr($_SERVER['QUERY_STRING'],-1);?>
    <div class="box1" >
    <table rules="all" border="1px solid #000">
    <caption style="font:16px;padding-bottom:10px;" id="capti"></caption>
    
    <tr align="right">
    <td colspan="7" class="addcol">
    <img src="../images/add_icon.png" width="25"/>
    <a href="javascript:add()">点击此处添加</a>
    </td>
    </tr>
    <tr bgcolor="#339966">
    <th>编号</th>
    <th>名称</th>
    <th>描述</th>
    <th>下载地址</th>
    <th width="250px">参考文献</th>
    <th>year</th>  
  <th>操作</th>
    
  </tr>
   
   <?php
     $db_id=substr($_SERVER['QUERY_STRING'],-1);
	if($db_id==1)
	 { $dbname="toolinfo";$year='tool_year';}
	else
	  { $dbname="dbinfo";$year='db_year';}
     require('../connect.php');
    $sql = "select count(*) from $dbname";
    $result=mysql_query($sql) or die('执行失败');
    $pagesize=7;//页面大小
    $rows=mysql_fetch_row($result);
    $recordcount=$rows[0];//获取记录总数
    $pagecount=ceil($recordcount/$pagesize);//获取页面总数

    $pageno=isset($_GET['pageno'])?$_GET['pageno']:1;//获取页码
    if($pageno<1)$pageno=1;
    if($pageno>$pagecount)$pageno=$pagecount;
    $startno=($pageno-1)*$pagesize;

    $sql="select * from (select * from $dbname  order by $year desc)as tmp  limit $startno,$pagesize";
    $result=mysql_query($sql) or die(mysql_error());
    $seq=($pageno-1)*$pagesize;
    while($row=mysql_fetch_array($result))
    {
       $seq++;
       $href=$row[3];
       echo '<tr><td>'.$seq.'</td><td>'.$row[1].'</td><td>'.($row[2]==""?"temporal vacancy":$row[2]).'</td><td><a href="'.$href.'"'.'>'.$row[3].'</a></td><td>'.($row[4]==""?'temporal vacancy':$row[4]).'</td><td>'.($row[5]==""?2016:$row[5]).'</td><td><a href="javascript:modify('.$row[0].')">修改</a></br></br><a href="javascript:del('.$row[0].')">删除</a></td></tr>';
    }
    
    ?>  
    </table>
    
    <table border="0" rules="all">
<tr>
<td style="font-size:20px; text-align:center;">
<a href="?pageno=<?php echo $pageno-1;?>&db_id=<?php echo $db_id?>"><<<</a>
<?php
 for($i=1;$i<=$pagecount;$i++)
 {
	echo '<a href="?pageno='.$i.'&db_id='.$db_id.'">'.$i.'</a>&nbsp;';
	 }
?>
<a href="?pageno=<?php echo $pageno+1;?>&db_id=<?php echo $db_id?>">>>></a>
</td>
</tr>
</table>
   </div>
  <script type="text/javascript">
	
    function modify(num)
   {
	var cellwidth=800;
	var db_id=getargs();
	var left=(screen.availWidth-cellwidth)/2;
	window.open("modify.php?db_id="+db_id+"&num="+num,"_blank","width=800,height=700,top=200,left="+left+",toolbar=no,menubar=yes,status=yes");	
	}
	 
	 function add()
	 {
	var cellwidth=800;
	var db_id=getargs();
	var left=(screen.availWidth-cellwidth)/2;
	window.open("add.php?db_id="+db_id,"_blank","width=800,height=700,top=200,left="+left+",toolbar=no,menubar=yes,status=yes");
		 }	 
function del(num)
{
	if(confirm("您确定删除这条记录吗？"))
	{
		var db_id=getargs();
		window.open("delete.php?db_id="+db_id+"&num="+num,"_blank");	
		} 
		location.reload();
}
function getargs()
{
	var s=location.href;
	var m="db_id=";
	var index=s.indexOf(m);
	return s.charAt(index+m.length);
	
	}
function altercaption()
{
	if(getargs()==1)
	window.document.getElementById("capti").innerHTML="常用工具信息概览";
	if(getargs()==2)
	window.document.getElementById("capti").innerHTML="数据库信息概览";
	}
window.onload=altercaption;
</script>
  
 </div>
 	<div class="footer">
		
		<p>Copyright © 2016 <a href="http://www.w3school.com.cn/">Your Company Name</a> | 
			Designed by <a href="http://sc.chinaz.com/" target="_parent">PoLncR</a> | 
			Validate <a href="http://validator.w3.org/check?uri=referer">XHTML</a> &amp; <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a></p>
		</div>
</body>
</html>
