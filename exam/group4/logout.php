<?php session_start();if(isset($_SESSION['user_session'])){session_destroy();mysql_close($con);header("Location:index.php");$expire=time()-60*60;setcookie("uid","",$expire);}else{header("Location:index.php");}?>