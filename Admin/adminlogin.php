<?php session_start();
 error_reporting(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员登录</title>
<style>
.box {width:800px;padding:0;margin:0 auto;}
.head{ height:87px;padding:10px 5px; border-bottom:1px solid blue;}
.title{ font-size:40px;color:#036; font-weight:bold;margin:0 auto;height:87px;}
</style>
<script type="text/javascript">

function checkusr()
{ 
    var banchar =new Array('#','*','$','@','&','%','/','\\');
	var usrobj=window.document.getElementById("usr")
    var txt=usrobj.value;
	var pwd=window.document.getElementById("pwd").value;
	if(txt=="")
	{
     window.document.getElementById("hint1").innerHTML="*用户名不能为空";
	 usrobj.focus();
	 return false;
	}

	 for(var i=0,length1=txt.length;i<length1;i++)
	   {
		   var char=txt.charAt(i);
		    for (var j=0,length2=banchar.length;j<length2;j++)
			    if(char==banchar[j])
				  {
					  	
					   window.document.getElementById("hint1").innerHTML="*用户名含有非法字符";
					   return false; 
					  }
		   }
		   
		 window.document.getElementById("hint1").innerHTML="  "; 
		 return true;  
	 
	}
   

</script>
</head>

<body background="../images/admin_bg.jpg">
<div class="box">
<div calss="head">
<img src="../images/logo.png" / style="margin-top:40px;">
<span class="title">生物信息平台管理登录</span>
</div>
<form action="" method="post" onsubmit="return checkusr()">
<table width="550" border="0" cellpadding="5" style="margin:20px auto; padding:30px 20px;">
  <tr >
    <td><img  src="../images/admin_icon.gif"  width="40"/></td>
    <td width="120" style=" padding-right:0;">用户名:</td>
    <td><input id="usr" type="text" name="username" onblur="checkusr()"></td>
    <td width="500" id="hint1" style="color:red; font-size:12px"></td>
  </tr>
  <tr>
  <td><img src="../images/admin_pwd.png"  width="40" /></td>
    <td>密码:</td>
    <td><input type="password" name="pwd" id="pwd"></td>
    <td width="150" style="color:red; font-size:12px"><a href="#">忘记密码？</a></td>
  </tr>
  <tr>
  <td colspan="3" align="center">
  <span style=" padding-left:100px;"><input type="image" src="../images/demo1.png" width="100" height="40" name="login" alt="submit" /></span>
  </td> 
  </tr>
</table>

</form>
 <?php
   if(isset($_POST['username'])|| isset($_POST['pwd']))
   {
   $usr=$_POST['username'];
   $pwd=$_POST['pwd'];
   require('../connect.php');
   $sql="select * from admin_user where admin_name='$usr' and password='$pwd'";
   $result=mysql_query($sql);
   if(mysql_num_rows($result)==1)
     { 
                 $_SESSION['user']=$usr;
                 $_SESSION['pwd']=$pwd;
                 $_SESSION['login_time']=date("Y-m-d H:i");
                 
		 echo '<script>alert("登录成功！");window.location.href="list.php?db_id=1"</script>';
		
		 } 
		 else
		     if($usr!=""&&$pwd!="") 
		 {
			 echo '<script>alert("用户名或密码错误！")</script>';
	
		 }
   }
 ?>
 </div>
</body>
</html>

