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
.box1 table {margin:0px auto;padding:20px 0;width:100%;border:1px solid #blue;font-size:16px;}
.box1 table td{ text-align:center; text-indent:hanging;padding:5px;}
.box1 table .addcol { text-align:right; padding-right:20px;     }
 caption {padding-bottom:10px;font-weight:bold; } 
table a:hover{text-decoration:none;color:#9933CC;}
</style>

<script>
function add_news()
{
 var cellwidth=800;
        var left=(screen.availWidth-cellwidth)/2;
        window.open("add_news.php","_blank","width=800,height=700,top=200,left="+left+",toolbar=no,menubar=yes,status=yes");
}

function modify_news(num)
{
   var cellwidth=800;
        var left=(screen.availWidth-cellwidth)/2;
        window.open("modify_news.php?num="+num,"_blank","width=800,height=700,top=200,left="+left+",toolbar=no,menubar=yes,status=yes");

}



function delete_news(num)
{
  if(confirm("Are you sure to delete this article?"))
 { var cellwidth=800;
        var left=(screen.availWidth-cellwidth)/2;
        window.open("delete.php?db_id=4&num="+num,"_blank","width=800,height=700,top=200,left="+left+",toolbar=no,menubar=yes,status=yes");
}
}

</script>


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
                                <li><a href="knowledge_list.php?db_id=3">Knowledge</a></li>
                                 <li><a href="news_list.php">News</a></li>
                <li style="border:none;"><a href="knowledge_list.php?db_id=5">Study of lncRNA </a></li>
                </ul>
                        <div class="clear"></div>
                </div>

<div class="box1">
<table border="1" rules="all">
<caption>News Administration </caption>
<tr align="right">
<td colspan="7" class="addcol">
<img src="../images/add_icon.png" width="25"/><a href="javascript:add_news()">点击此处添加</a>
</td>
</tr>
<tr bgcolor="#339966">
<th>News_id</th>
<th>News_title</th>
<th>News_refer</th>
<th>News_time</th>
<th>Operation</th>
</tr>

<?php
require("../connect.php");

$sql="select * from news order by news_time desc";
$result=mysql_query($sql) or die(mysql_error());
$seq=1;
while($arr=mysql_fetch_array($result))
{
  $time_arr=explode(" ",$arr[4]);
  $time=$time_arr[0];
  $arr[3]=$arr[3]==''?'null':$arr[3];
  $str='<tr><td>'.$seq.'</td><td><a href="news/news_'.$arr[0].'.html">'.$arr[1].'</td><td><a href="'.$arr[3].'"/>'.$arr[3].'</a></td><td>'.$time.'</td>';
  $str=$str.'<td><a href="javascript:modify_news('.$arr[0].')">Modify</a><br/><br/><a href="javascript:delete_news('.$arr[0].')">Delete</a></td></tr>';
  echo $str;
  $seq++;
}

?>

</table>
</div>



 </div>
        <div class="footer">

                <p>Copyright © 2016 <a href="http://www.yzu.edu.cn">YangZhou University</a> |
                        Designed by <a href="http://sc.chinaz.com/" target="_parent">PoLncR</a> |
                        Validate <a href="http://validator.w3.org/check?uri=referer">XHTML</a> &amp; <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a></p>
                </div>
</body>
</html>


