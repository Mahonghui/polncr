<?php session_start();?>
<html>
<head>

</head>
 
<body>
<table id="log">
<caption>Login log </caption>

</table> 

<p>current user:<?php echo $_SESSION['user'];?></p>
<p>login time:<?php echo $_SESSION['login_time'];?></p>
</body>
</html>
