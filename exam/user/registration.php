<?php
session_start();
 
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
function retrieveallCategory()
 {
 global $db;
 $sql = "SELECT *
FROM  category_master";
foreach($db->query($sql) as $row) {
$batch[]= $row;
}
return $batch;
}

$db = new PDO(DB_INFO, DB_USER, DB_PASS);

$allCategory=retrieveallCategory();

mysql_connect("localhost","root","");
mysql_select_db("aryahans");
if(isset($_POST['student_name']))
{
$random=generateRandomString(8);
$query="INSERT INTO `m01_regstration`(`student_name`,`mail_id`,`password`,`address`,`gender`,`mobile_number`,`class`,`parent_id`,`status`,`code`) VALUES ('".$_POST['student_name']."','".$_POST['mail_id']."','".$_POST['password']."','".$_POST['address']."','".$_POST['gender']."','".$_POST['mobile_number']."','".$_POST['class']."','-1','1','".$random."')";
$result=mysql_query($query);

}?>
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

<div style="font-size:24px; padding-left:100px; padding-top:70px ">Student Registration</div>
<div style="padding:100px">
<form action="registration.php" method="post">
				<div class="row">
					<div class="span3">
						<label>Full Name <span class="required">* </span></label>
						<input type="text" class="span3 ie7-margin" height="30px" name="student_name" />
					</div>
					<div class="span3">
						<label>Mobile Number<span class="required">* </span></label>
						<input type="text" class="span3 ie7-margin" id="mobile_number" name="mobile_number">
					</div>
				</div>
				<div class="row">
					<div class="span3">
						<label>Email <span class="required">* </span></label>
						<input type="email" id="mail_id" name="mail_id" class="span3 ie7-margin">
					</div>
					<div class="span3">
						<label>Select a Gender</label>
						<select id="gender" name="gender" class="span3">
							<option value="Select" id="0">Select Gender</option>
							<option value="Male" id="1">Male</option>
							<option value="Female" id="2">Female</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="span3">
						<label>Password <span class="required">* </span></label>
						<input type="password" class="span3 ie7-margin" id="password" name="password">
					</div>	
<div class="span3">
						<label>Select Class</label>
				<select name="class" class="span3">
							<?php
								foreach($allCategory as $c)
								{
?>
							<option value="<?php echo $c['category_id'];?>"><?php echo $c['category_name'];?></option>
<?php

									}
?>							
						</select>	</div>					
				</div>
                <div class="row">
				<div class="span3">
						<label>Address <span class="required">*</span></label>
						<textarea rows="5" id="address" name="address" class="span6"></textarea>
				</div>
				</div>
				
				<input type="submit" value="Submit" class="button_medium">
				<hr>
			</form>
</div>