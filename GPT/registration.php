  <?php
  session_start();
 
/*mysql_connect("aryahans.db.10615588.hostedresource.com","aryahans","abc!@#ABC123");
mysql_select_db("aryahans");
define('DB_INFO', 'mysql:host=aryahans.db.10615588.hostedresource.com;dbname=aryahans');
define('DB_USER', 'aryahans');
define('DB_PASS', 'abc!@#ABC123');
*/

include 'db_inc.php';
include 'functions.inc.php';
function generateRandomString($length = 10) {
    $characters = '01TUV23wx6789abcdefgFGHIJhijklmno45uvyzABCDEKLMpqrstNOPQRSWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}


mysql_connect("localhost","root","abhi");
mysql_select_db("allenhouse");
if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['roll_no']))
{
$random=generateRandomString(8);
$query="INSERT INTO registration (`roll_no`,`student_name`,`dob`,`mail_id`,`password`,`address`,`gender`,`mobile_number`,`course`,`branch`,`semester`,`parent_id`,`status`,`code`) VALUES ('".$_POST['roll_no']."','".$_POST['student_name']."','".$_POST['dob']."','".$_POST['mail_id']."','".$_POST['password']."','".$_POST['address']."','".$_POST['gender']."','".$_POST['mobile_number']."','".$_POST['class']."','".$_POST['branch']."','".$_POST['semester']."','-1','1','".$random."')";
if (mysql_query($query))  
	 {
    echo "New record created successfully";
     }
	else 
	 {
    echo "Error: " . $query . "<br>" ;
     }/*
print_r($_POST['mail_id']);
$mail_id=$_POST['mail_id'];

$to      = 'ankur10don@gmail.com';
$subject = 'Enquiry from Website ';

$headers = 'From: ' . $email . "\r\n" .
    'Reply-To: ' . $email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
$message = 'name-------->'.$name.''.$msg;
mail($to, $subject, $message, $headers);
header("location:index.php");*/
}

?>
<head>

<!-- Basic Page Needs -->
<meta charset="utf-8">
<title>User Registration</title>
<meta name="keywords" content="" />
<meta name="description" content="">
<meta name="author" content="">

<!-- Favicons-->
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.php">
<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

<!-- Mobile Specific Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- CSS -->
<link href="frontdesign/css/bootstrap.css" rel="stylesheet">
<link href="frontdesign/css/bootstrap-responsive.css" rel="stylesheet">
<link href="frontdesign/css/megamenu.css" rel="stylesheet">
<link href="frontdesign/css/style.css" rel="stylesheet">
<link href="frontdesign/font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="frontdesign/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="frontdesign/js/fancybox/source/jquery.fancybox63b9.css?v=2.1.4">

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Jquery -->
<script src="frontdesign/js/jquery.js"></script>

<!-- Support media queries for IE8 -->
<script src="frontdesign/js/respond.min.js"></script>

<!-- HTML5 and CSS3-in older browsers-->
<script src="frontdesign/js/modernizr.custom.17475.php"></script>

<!--[if IE 7]>
  <link rel="stylesheet" href="font-awesome/css/font-awesome-ie7.min.css">
<![endif]-->

<!-- Style switcher-->
<link rel="stylesheet" type="text/css" media="screen,projection" href="src/jquery-sticklr-1.4-light-color.css" >	
<!-- Fonts-->
<link rel="alternate stylesheet" type="text/css" href="frontdesign/src/css/helvetica.css" title="helvetica" media="all">
<link rel="alternate stylesheet" type="text/css" href="frontdesign/src/css/cabin.css" title="cabin" media="all">
<link rel="alternate stylesheet" type="text/css" href="frontdesign/src/css/droid.css" title="droid" media="all">
<link rel="alternate stylesheet" type="text/css" href="frontdesign/src/css/lato.css" title="lato" media="all">
<link rel="alternate stylesheet" type="text/css" href="frontdesign/src/css/montserrat.css" title="montserrat" media="all">
<link rel="alternate stylesheet" type="text/css" href="frontdesign/src/css/opensans.css" title="opensans" media="all">
<link rel="alternate stylesheet" type="text/css" href="frontdesign/src/css/quattrocento.css" title="quattrocento" media="all">
<link rel="alternate stylesheet" type="text/css" href="frontdesign/src/css/roboto.css" title="roboto" media="all">
<link rel="alternate stylesheet" type="text/css" href="frontdesign/src/css/robotoslab.css" title="robotoslab" media="all">
</head>
<body>
<!--[if !IE]><!--><script>if(/*@cc_on!@*/false){document.documentElement.className+=' ie10';}</script><!--<![endif]--> <!-- Border radius fixed IE10-->
<header>
	<div class="container">
   	  <div class="row">
    	
        <div class="span12">
        </div><!-- End span8-->
        </div><!-- End row-->
    </div><!-- End container-->
</header><!-- End Header-->

<nav>
<div class="megamenu_wrapper megamenu_container">
	<!-- Begin Mega Menu Container -->
	<ul class="megamenu">
	<li><span class="drop"><a href="index.php">Home</a></span></li>
	</ul>
	</div>
</nav>

<div class="container">
	
	<div class="row">
		
        <!-- =========================Start Col left section ============================= -->
		<aside class="span4">
		<div class="col-left">
			<h3>Address</h3>
			<hr>

		</div>
		<p>
			
		</p>
		</aside>
        
        <!-- =========================Start Col right section ============================= -->
		<section class="span8 ">
		<div class="col-right">
			
			
			<h4>User Registration</h4>
            <hr>
			
			<form action="registration.php" method="post">
				<div class="row">
				<div class="span3">
						<label>Roll No. <span class="required">* </span></label>
						<input type="text" class="span3 ie7-margin" height="30px" name="roll_no" />
					</div>
					<div class="span3">
						<label>Full Name <span class="required">* </span></label>
						<input type="text" class="span3 ie7-margin" height="30px" name="student_name" />
					</div>
					<div class="span3">
						<label>Date Of Birth <span class="required">* </span></label>
						<input type="date" class="span3 ie7-margin" height="30px" name="dob" />
					</div>
					<div class="span3">
						<label>Email <span class="required">* </span></label>
						<input type="email" id="mail_id" name="mail_id" class="span3 ie7-margin">
				</div>
				<div class="span3">
						<label>Password <span class="required">* </span></label>
						<input type="password" class="span3 ie7-margin" id="password" name="password">
					</div>
					</div>
					<div class="row">
				<div class="span3">
						<label>Address <span class="required">*</span></label>
						<textarea rows="5" id="address" name="address" class="span6"></textarea>
				</div>
				</div>
					
				
				<div class="row">
					
					<div class="span3">
						<label>Select a Gender</label>
						<select id="gender" name="gender" class="span3">
							<option value="Select" id="0">Select Gender</option>
							<option value="Male" id="1">Male</option>
							<option value="Female" id="2">Female</option>
						</select>
					</div>
					<div class="span3">
						<label>Mobile Number<span class="required">* </span></label>
						<input type="text" class="span3 ie7-margin" id="mobile_number" name="mobile_number">
					</div>
				</div>
				<div class="row">
						
<div class="span3">
						<label>Select Course</label>
						<select name="class" class="span3">
						<option>Select Course</option>
							<?php $tres=mysql_query("select * from category_master");
								while($trow=mysql_fetch_array($tres)){echo "<option value='".$trow["category_id"]."'>".$trow["category_name"]."</option>";}?>
						</select>
					</div>					
				
				 <div class="span3">
						<label>Branch <span class="required">* </span></label>
						<select name="branch" class="dropdown">
						<option>Select Branch</option>
							<option value="c.s">Computer Science And Engineering</option>
							<option value="c.e">Civil Engineering</option>
							<option value="m.e">Mechanical Engineering</option>
							<option value="e.c">Electronics And Communication Engineering</option>
							<option value="e.n">Electrical And Electronics Engineering</option>
						</select>
					</div>	
</div>
<div class="row">					
<div class="span3">
						<label>Semester<span class="required">* </span></label>
						<input type="number" class="span3 ie7-margin" id="semester" name="semester" min="1" max="8">
					</div>					

					</div>
                
				
				<input type="submit" value="Submit" class="button_medium">
				<hr>
			</form>
                      

		</div><!-- end col right-->
		</section>
	</div><!-- end row-->
</div><!-- end container-->
  
<footer>
  <div class="container">
  	<div class="row">
    	<div class="span4" id="brand-footer">
           </div>
        <div class="span4" id="contacts-footer" style="padding-top:40px;">
        	<h4>Contacts</h4>
            <hr>
        
            <div id="message-newsletter"></div>
              
        	</div>
        <div class="span4" id="quick-links" style="padding-top:40px;">
        	<h4>Quick links</h4>
            <hr>
           
        </div>
        
    </div>
  </div>
  </footer>
  <!-- End footer-->
 <div id="toTop">Back to Top</div>

<!-- DATEPICKER -->        
<script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
      $('#datetimepicker').datetimepicker({
        format: 'dd/MM/yyyy hh:mm',
		pick12HourFormat: false,   // enables the 12-hour format time picker
  		pickSeconds: false, 
        language: 'en'
      });
</script>
<!-- MEGAMENU -->    
<script src="frontdesign/js/jquery.easing.js"></script><!-- jQuery Easing effects -->
<script src="frontdesign/js/megamenu_plugins.js"></script><!-- Mega Menu Plugins (scroller, form, hoverIntent) -->
<script src="frontdesign/js/megamenu.js"></script><!-- Mega Menu Script -->

<!-- OTHER JS -->    
<script src="frontdesign/js/bootstrap.js"></script>
<script src="frontdesign/js/functions.js"></script> 
<script src="frontdesign/assets/validate.js"></script>

 <!-- FANCYBOX -->
<script  src="frontdesign/js/fancybox/source/jquery.fancybox.pack63b9.js?v=2.1.4" type="text/javascript"></script> 
<script src="frontdesign/js/fancybox/source/helpers/jquery.fancybox-media3447.js?v=1.0.5" type="text/javascript"></script> 
<script src="frontdesign/js/fancy_func.js" type="text/javascript"></script> 

<!-- STYLE SWITCHER -->
<script type="text/javascript" src="frontdesign/src/jquery-sticklr-1.4.min.js"></script>
	<script type="text/javascript">
	    $(document).ready(function(){
	        $('#example-1').sticklr({
                animate         : true,
                showOn		    : 'hover'
			});
	    });
	</script>
<script type="text/javascript" src="frontdesign/src/fswit.js"></script>

</body>
</html>