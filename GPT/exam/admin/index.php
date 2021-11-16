<?php if((isset($_COOKIE['uid']))&&(isset($_COOKIE['uname']))){session_start();$_SESSION['uid']=$_COOKIE['uid'];$_SESSION['uname']=$_COOKIE['uid'];header("Location:".$_COOKIE['redirect']);}?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Admin Login</title>
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
<script>function check_browser(){if(navigator.appName=="Microsoft Internet Explorer"){document.getElementById('errorlist').style.display='';}}</script></head>
<body id="login-bg">  
<div id="login-holder">
	<div id="logo-login">
		<a href="index.html"><!--<img src="images/shared/logo2.png" width="156" height="40" alt="" />--></a>
	</div>
<div class="clear"></div>	
	<div id="loginbox">
	<div id="login-inner">
	<form>
		<table border="0" >
		<tr>
			<th>Username</th>
			<td><input type="text" name="user_name" id="user_name" placeholder="Enter username" style="font-family:Trebuchet MS; font-size:11px;"   class="login-inp" /></td>
		</tr>
		<tr>
			<th>Password</th>
	<td><input type="password" name="password" id="password" placeholder="Enter Password" style="font-family:Trebuchet MS; font-size:11px;" class="login-inp" /></td>
		</tr>
		<tr><th></th>
		<td> <img style="border-radius:5px" src="captcha.php" alt="" id="captcha" />
		<img src="images/refresh.jpg" alt="" id="captcha_refresh" onClick="refreshcaptcha()" style="cursor:pointer;" height="35"/></td>
		</tr>
		<tr>
		<th>Verify</th>
		<td>
		<input type="text" name="captcha_input" id="captcha_input" placeholder="Enter image text" style="font-family:Trebuchet MS; font-size:11px;"   class="login-inp" />
		</td>
		</tr>
		<tr>
			<th></th>
			<td valign="top"><input type="checkbox" class="checkbox-size" name="login-check" id="login-check" /><label for="login-check">Remember me</label></td>
		</tr>
		<tr>
			<th></th>
			<td><input  name="submit" type="submit" class="submit-login"/></td>
		</tr>
		</table>		
	</div>
	<div class="clear"></div>
<div id="errorlist" style='width:500px;height:20px;vertical-align:middle;margin-left:15px; padding-left:20px;padding-top:10px; border-radius:5px;color:#CCCCCC;display:none;'><font style='color:#FF0000;'>*</font>Browser Error.&ensp;Recomended: <a href='http://www.mozilla.org/en-US/firefox/new/' style='text-decoration:underline;color:white;' target='_blank'>Mozilla Firefox</a></div>
	<script>check_browser();</script>
	<div id='errorlogin' style='display:none;width:500px;height:20px;vertical-align:middle;margin-left:15px;padding-left:20px;padding-top:10px;border-radius:5px;color:#CCCCCC;'></div>

	<a href="" class="forgot-pwd">Forgot Password?</a>
 </div>
	<div id="forgotbox">
		<div id="forgotbox-text">Please send us your email and we'll reset your password.</div>
		<div id="forgot-inner">
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th>Email address:</th>
			<td><input type="email" value="" name="mail"   class="login-inp" /></td>
		</tr>
		<tr>
			<th> </th>
			<td><input name="forgot"  type="submit" class="submit-login"  /></td>
		</tr>
		</table>
		</div>
		<div class="clear"></div>
		<a href="" class="back-login">Back to login</a>
	</div>
</div></form>
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script>$(document).ready(function(){$('#captcha_input').val("");$("form").submit(function(){$('#errorlogin').html("Please wait. Connecting...").show();$.ajax({type: "post",url: "login.php",data: 'user_name='+$('#user_name').val()+'&password='+$('#password').val()+'&captcha='+$('#captcha_input').val()+'&remember='+$('#login-check').is(":checked")+'&submit=1',success: function(response){if(response=="vf"){refreshcaptcha();$('#captcha_input').val("");$('#password').val("");$('#errorlogin').html("<font style='color:#FF0000;'>*</font>Please Enter Verification Code Correctly.").show();}else if(response=="f"){refreshcaptcha();$('#captcha_input').val("");$('#password').val("");$('#errorlogin').html("<font style='color:#FF0000;'>*</font>Invalid Username or Password.").show();}else {$('#errorlogin').html("Please wait. Redirecting...").show();location.href=response;}},error:function (XMLHttpRequest, textStatus, errorThrown){$('#errorlogin').html(textStatus).show();}});return false;});});function refreshcaptcha(){document.getElementById('captcha').src="captcha.php?rnd=" + Math.random();}</script>
</body>
</html>