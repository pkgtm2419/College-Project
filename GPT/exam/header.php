<?php
 if(!(isset($_SESSION['sprg_admin']) && $_SESSION['sprg_admin']== 1))
{
header('Location: login.php');
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" >
<head>
<link rel="stylesheet" href="css/css-8fb5d9798c9eca2280c42ec27620accf.css" type="text/css" />
<link rel="stylesheet" href="css/ui-custom/jquery-ui-1.7.2.custom.css" type="text/css" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=10"/>
<meta name="keywords" content="" />
<meta name="description" content="">
<meta name="keywords" content=""><meta name="author" content="Ankur Tandon"/>
<meta name="KeyWords" content="" />
<meta name="description" content= "" />
<meta name="keywords" content="" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<style type="text/css">
div.wrapper {
	margin: 0 auto;
	width: 979px;
	padding: 0;
}
#inset-block-left {
	width: 0px;
	padding: 0;
}
#inset-block-right {
	width: 240px;
	padding: 0;
}
#maincontent-block {
	margin-right: 240px;
	margin-left: 0px;
}
a, .contentheading, .side-mod h3 span, .grey .side-mod a, .componentheading span, .roktabs-links li.active {
	color: #0c5a74;
}
</style>
<title>Online Exam</title>
</head><body id="ff-solarsentinel" class="f-default style7 bg-white iehandle">
<div id="page-bg">
<div class="wrapper">
<div id="body-left" class="png">
<div id="body-right" class="png">
<!--Begin Top Bar-->
<div id="top-bar">
  <div class="topbar-strip">
    <div id="google_translate_element" style=" float:right;"></div>
    <div class="date-block"> <span class="date1"><?php echo date('l'); ?></span>, <span class="date2"><?php echo date('F'); ?></span> <span class="date3"><?php echo date('d'); ?></span>, <span class="date4"><?php echo date('Y'); ?></span> 		</div>	<center>Welcome <?php echo $_SESSION['user'];?>	</center>
<div id="accessibility">
							<div class="textsizer-desc"><a href="logout.php">Logout</a></div>
							</div>
				<!--a href="login.php" id="lock-button" class="login" rel="rokbox[240 210][module=login-module]"><span>Login</span></a>-->
  </div>
</div>
<!--End Top Bar--> 
<!--Begin Header-->
<div id="header-bar"> <a href="" id="logo"> <span class="logo-text" style=" font-weight:bold; padding-top:5px; font-size:11px;">Online Exam</span> </a>
  <div class="">
    <div id="searchmod-surround">
      <h3>Site Search </h3>
      <div id="searchmod">
        <div class="module">
          <form name="rokajaxsearch" id="rokajaxsearch" class="blue" action="search.php" method="get">
            <div class="rokajaxsearch">
              <input id="roksearch_search_str" name="s" type="text" class="inputbox" value="<?php echo (!isset($s) || $s == '') ? ' ' : $s; ?>" />
              <div class="clr"></div>
              <div id="roksearch_results"></div>
            </div>
            <div id="rokajaxsearch_tmp" style="visibility:hidden;display:none;"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php  ?>
<!--End Header-->