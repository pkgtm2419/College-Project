<?php
 include_once 'db_inc.php';
if(isset($_POST['submit']))
{
	session_start();
if($_SESSION['random_number']!=strtolower($_POST['captcha'])){echo "vf";die();}$result=mysql_query("SELECT user_id FROM user_master u where user_name='".$_POST['user_name']."' and user_password='".$_POST['password']."'",$con);if(mysql_num_rows($result)>0){$expire=time()+60*60*24*30;$usrrow=mysql_fetch_row($result);$_SESSION['uid']=$usrrow[0];$_SESSION['uname']=$_POST['user_name'];if($_POST['remember']=='true'){setcookie("uid",$usrrow[0],$expire);setcookie("uname",$_POST['user_name'],$expire);setcookie("redirect","home.php",$expire);}echo "home.php";}else{unset($_SESSION['uid']);echo "f";}}
if(isset($_POST['forgot'])){$new_pass=substr(md5(rand(0,5)),0,8);/*$retvalue = mysql_query("UPDATE user_access SET password='".$new_pass ."' WHERE login_name=".$_POST['user_name'].")", $conn );*/$to = $_POST['mail'];$subject = "Forgot password";$message = "<b>Your new Password is :</b>&nbsp;&nbsp;&nbsp;&nbsp;".$new_pass;$from = "ankur10don@gmail.com";$headers = "From:" . $from;/*mail($to,$subject,$message,$headers);*/header("location:index.php");}?>