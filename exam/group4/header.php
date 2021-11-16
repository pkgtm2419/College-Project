<?php 
session_start();
if((!isset($_SESSION["uid"]))||(!isset($_SESSION["uname"]))||($_SESSION["uname"]=="")||($_SESSION["uid"]==""))
	{
		session_destroy();
		header("Location:index.php");
	}
?>
<!DOCTYPE html>
<html>
<head xmlns="http://www.w3.org/1999/xhtml">
<title>Admin Login</title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<meta name="author" content=""/>
<link media="all" rel="stylesheet" type="text/css" href="css/all.css" />
<link rel="stylesheet" type="text/css" href="../css/styles.css" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
<!--[if lt IE 9]><link rel="stylesheet" type="text/css" href="css/ie.css" /><![endif]-->
</head>
<body>
	<div id="wrapper">
		<div id="content">
			<div class="c1">
				<div class="controls">
					<!--<nav class="links">
						<ul>
							<li><a href="#" class="ico1">Messages <span class="num">26</span></a></li>
							<li><a href="#" class="ico2">Alerts <span class="num">5</span></a></li>
							<li><a href="#" class="ico3">Documents <span class="num">3</span></a></li>
						</ul>
					</nav>-->
					<div class="profile-box">
						<span class="profile">
							<a href="#" class="section">
								<!--<img class="image" src="images/img1.png" alt="image description" width="26" height="26" />-->
								<span class="text-box">
									Welcome
									<strong class="name"><?php echo $_SESSION["uname"];?></strong>
								</span>
							</a>
							<a href="#" class="opener">opener</a>
						</span>
						<a href="logout.php" title="Logout" class="btn-on">On</a>
					</div>
				</div>
				<div class="tabs">