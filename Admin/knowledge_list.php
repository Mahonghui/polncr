<?php require("check_login.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../unitstyle.css"/><!--引入网站统一头尾样式-->
<link rel="icon" href="../images/index.ico" type="image/x-icon" /><!--网站图标-->
<title>后台管理</title>
<style>
.box1 {margin:0px auto;padding:0; background-color: #FFF;padding:50px 0 0 0;}
.box1 table {margin:0px auto;padding:20px 0;width:980px;cellpadding:5px;font-size:16px; color:#036; border-collapse:collapse;}
.box1 table td{width:150px; text-align:center; text-indent:hanging;padding:5px;}
.box1 table .addcol { text-align:right; padding-right:20px;}
caption {padding-bottom:10px;font-weight:bold; }
.box1 ul{list-style:circle;} 
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
                <li style="border:none;"><a href="knowledge_list.php?db_id=5">Study of lncRNA</a></li>
                </ul>
                        <div class="clear"></div>
                </div>

<?php 
$db_id=substr($_SERVER['QUERY_STRING'],-1);
if($db_id==3){$tablename='concepts';$caption='Knowledge Administration'; }
if($db_id==5){$tablename='lncRNA_study';$caption='Study of lncRNAs';}
require("../connect.php");
$result=mysql_query("select *  from $tablename order by position") or die(mysql_error());
echo '<div class="box1"><table border="1">';
echo '<caption>'.$caption.'</caption>';
echo '<tr align="right">
      <td colspan="7" class="addcol">
      <img src="../images/add_icon.png" width="25"/>
      <a href="javascript:add()">点击此处添加</a>
      </td>
      </tr>';
echo '<tr bgcolor="#339966">';
echo '<th width="10%">Index</th>';
echo '<th width="10%">Title</th>';
echo '<th width="55%">Content</th>';
echo '<th width="15%">Linkage</th>';
echo '<th width="10%">Operation</th></tr>';
while($arr=mysql_fetch_array($result))
{
 $para_arr=explode("*",$arr[2]);
 $attach_arr=explode("#",$arr[2]);
 $linkage_arr=explode(",",$arr[3]);  

 $str='<tr><td>'.$arr[0].'</td>';
$str=$str.'<td>'.$arr[1].'</td><td><ul>';


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

$str=$str.'</ul></td><td>';

for($i=0;$i<count($linkage_arr);$i++)
{
$str=$str.'<a href="'.$linkage_arr[$i].'"/>'.$linkage_arr[$i].'</a><br/><br/>';
}
$str=$str.'</td><td><a href="javascript:modify_Concept('.$arr[0].')">Modify</a><br><br><a  href="javascript:delete_Concept('.$arr[0].')">Delete</a></td></tr>';
echo $str;
}
echo '</table></div>';
?>

<script type="text/javascript">

function getargs()
{
        var s=location.href;
        var m="db_id=";
        var index=s.indexOf(m);
        return s.charAt(index+m.length);

        }



function modify_Concept(index){

        var cellwidth=800;
        var db_id=getargs();
        var left=(screen.availWidth-cellwidth)/2;
        window.open("modify_Concept.php?db_id="+db_id+"&num="+index,"_blank","width=800,height=700,top=200,left="+left+",toolbar=no,menubar=yes,status=yes")        
}

function delete_Concept(index){
    var db_id=getargs();
 if(confirm("Are you sure to delete this chronicle?"))
  window.open("delete.php?db_id="+db_id+"&num="+index,"__blank");

location.reload();
}

 function add()
         {
         var db_id=getargs();
        var cellwidth=800;
        var left=(screen.availWidth-cellwidth)/2;
        window.open("add_Concept.php?db_id="+db_id,"_blank","width=800,height=700,top=200,left="+left+",toolbar=no,menubar=yes,status=yes");
                 }

</script>


</div>
        <div class="footer">

                <p>Copyright © 2016 <a href="http://www.w3school.com.cn/">Your Company Name</a> |
                        Designed by <a href="http://sc.chinaz.com/" target="_parent">PoLncR</a> |
                        Validate <a href="http://validator.w3.org/check?uri=referer">XHTML</a> &amp; <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a></p>
                </div>
</body>
</html>

