<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="unitstyle.css"/><!--引入网站统一头尾样式-->
<link rel="icon" href="images/index.ico" type="image/x-icon" /><!--网站图标-->
<script type="text/javascript" src="index.js"></script> <!--引入下拉菜单效果-->
<script type="text/javascript" src="jquery.js"></script>

<title>PoLncR</title>
<style type="text/css">

	.left{width:468px;float:left;margin:10px;}
	.left .left_1{width:100%;padding:10px 10px;margin-top:20px;border-radius:10px;background-color:#fff;}
	.left h1{padding:10px 20px;color:#0192ff;font-style:italic;border-bottom:1px solid #000;}
	.left_1 p{font-size:1.7em;color:#636;padding:10px 10px;text-indent: hanging;font-family:Arial;}
	.left .left_2{width:100%;margin:10px 0;padding:10px 10px;border-radius:10px;background-color:#fff;}
	
	.right{width:650px;float:right;margin:10px 30px;}
	.right .right_1{width:100%;background-color:#fff;margin-top:20px;padding:10px 10px;border-radius:10px;}
	.right h1{padding:10px 20px;color:#0192ff;font-style:italic;border-bottom:1px solid #000;}
	.right .right_2{width:100%;background-color:#fff;margin:20px 0;padding:10px 10px;border-radius:10px;}
	.domebox {width:420px;height:270px; background:#fff;float:right;margin:30px 10px;border-radius:10px;}
   #dome {width:420px;height:200px;background-color:#FFF;overflow:hidden;border-radius:10px;margin-top:20px;}
   #dome ul{list-style:none;padding:0 20px;}
   #dome li{padding:4px 0;font-size:14px;border-bottom:1px dashed #006;}
   #dome1 {width:100%;height:250px;}
   #dome a:link,a:visited{color:#000;}
   #dome a:hover{color:#F00;text-decoration:none;}
   .news_title{padding:10px 20px 0;font-size:1.5em;}
   .more {padding-left:165px;color:blue;font-size:1.3em; }
   .more a:hover{text-decoration:none;}
   #ScrollImg {width:650px;height:250px;float:left;padding:4px 5px;margin:30px 20px; }
	.headertext {font-size:14px;background-color:inherit; vertical-align:central;padding-right:10px; font-family: "Times New Roman", Times, serif;}
</style>
</head>

<body>
<a name="top"></a><!--回到顶部位置-->
<div style="text-align:right;padding-right:80px;" >
    <span id="showdate" class="headertext"></span><!--显示日期-->

  <!--  <iframe width="250" scrolling="no" height="20" frameborder="0" allowtransparency="true" src=    "http://i.tianqi.com/index.php?c=code&id=1&color=%23&icon=1&wind=1&num=1"></iframe><!--显示� ��-->
</div>

<div class="box">   
	<div class="header">
		<ul>
			<li><a href="index.php"><img id="headerpic" src="images/logo.png" alt="logo" title="Homepage"/></a><!--扬大logo-->
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
						<li><a href="Knowledge/Well_studied_lncRNAs.php" target="_self">Well-studied lncRNAs</a></li>
					</ul>           
				</li>
				
				<li class="parent" onmouseover="displaySubMenu(this)" onmouseout="hideSubMenu(this)">
                                     <a href="#"><font color="#000">Browser</font></a>
                                     <ul style="display:none;background:#0090FD;width:100%;border-radius:10px;">
                                        <li style="border-bottom:1px solid #CF9;"><a href="/cgi-bin/gb2/gbrowse/yeast/">GBrowse</a></li>
                                        <li style="border:none;"><a href="../genomebrowser/"  target="_self">UCSC</a></li>
                                    </ul>
                                     </li>

				<li><a href="Analysis_Computation/analysis_computation.html" >Analysis&Computation </a></li>
				<li><a href="Tools/index_tool.php">Tools</a></li>
				<li style="border:none;"><a href="Databases/index_database.php">Databases</a></li>
			</ul>
			<div class="clear"></div>
		</div>
        <!--菜单栏结束-->
        

        <a href="#"><img style="border-radius:10px;"id="ScrollImg" src="images/scroimg01.jpg" title="logo" ></a>
        
        <!--图片轮播结束-->
        
        <div class="domebox"> 
     <span class="news_title">Academic news</span><span class="more"><a href="news/more_news.php">more</a></span><hr>
    
    <div id="dome" >
     <div id="dome1" >
          <ul>
             <?php 
             require("connect.php");
             $sql="select * from news order by news_time desc limit 4";
             $result=mysql_query($sql) or die(mysql_error());
             while($arr=mysql_fetch_array($result))
             {
               $str='<li><a href="news/news_'.$arr[0].'.html" target="_new">'.$arr[1].'</a></li>';
               echo $str;
            }
          ?>
           </ul>
      </div>
      <div id="dome2"></div>
   </div>
 </div>
    <div class="clear"></div>
    <!--新闻动态结束-->
    
		<div class="left">
			<div class="left_1">
				<h1>Abstract</h1>
				<p>The long non-coding RNAs (lncRNAs) is a category of genomic products ( >200nt ) that could not have protein-coding potential. Here we present a platform named PoLncR (Platform of long non-coding RNAs) for lncRNA data/information collection, analysis and prediction. On PoLncR, users can learn current knowledge about lncRNAs, visualizing lncRNA data by GBrowse, and conducting analysis and computation for studying the lncRNAs.
				</p>
				<img src="images/RNA_catalogue.png">
			</div>
            <!--左1结束-->  
			<div class="left_2">
				<h1>Trend of lncRNA studies in the past 10 years searched on PubMed </h1>
				<img src="images/Trend.png">
			</div>
			<div class="left_2">
				<h1>Functional models of lncRNA</h1>
				<img src="images/lncRNA models.png" >
			</div>
            <!--左2结束-->
		</div>
        <!--左版结束-->
		
		<div class="right">
			<div class="right_1">
				<h1>Anatomy of lncRNA loci </h1>
				<img src="images/Anatomy of lncRNA loci.png" style="padding:10px;">
			</div>
			<div class="right_2">
				<h1>Domain system of lncRNA sub-structure</h1>
				<img src="images/Domain.png">
			</div> 
		</div><!--右版结束-->
		<div class="clear"></div>
	</div> <!--box结束-->
  
   
	<div class="footer">
		
		<p>Copyright © 2016 <a href="http://www.yzu.edu.cn">YangZhou University</a> | 
			Designed by <a href="http://sc.chinaz.com/" target="_parent">PoLncR</a> | 


		<div style="width:45px;height:80px;position:fixed;right:5px;bottom:50px;"><a href="#top">
			<img src="images/backtop.png" alt="backtotop"></a></div>
            <!--回到顶部-->
		</body>
		</html>
