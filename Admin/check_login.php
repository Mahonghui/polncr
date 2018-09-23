<?php
session_start();
if(!isset($_SESSION['user'])||empty($_SESSION['user']))
{
  echo '<script>alert("please log in first");window.location.href="adminlogin.php"</script>';
}
?>
