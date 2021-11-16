<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'
&& !empty($_POST['login_id'])
&& !empty($_POST['password']))
	{
// Include database credentials and connect to the database
include_once 'db.inc.php';
$db = new PDO(DB_INFO, DB_USER, DB_PASS);
$expires = time()+2*60;
$uname = htmlentities($_POST['login_id']);
setcookie('username', $uname, $expires, '/');


$sql = "SELECT COUNT(*) AS num_users
FROM  registration
WHERE mail_id=?
AND status=?";
$stmt = $db->prepare($sql);
$stmt->execute(array($_POST['login_id'],1));
$response = $stmt->fetch();
if($response['num_users'] > 0)
{

$sql = "SELECT COUNT(*) AS num_users
FROM  registration
WHERE password=?";
$stmt = $db->prepare($sql);
$stmt->execute(array($_POST['password']));
$response1 = $stmt->fetch();
if($response1['num_users'] > 0)
{

$sql = "SELECT COUNT(*) AS num_users
FROM  registration
WHERE mail_id=?
AND password=?";
$stmt = $db->prepare($sql);
$stmt->execute(array($_POST['login_id'], $_POST['password']));
$response2 = $stmt->fetch();
if($response2['num_users'] > 0)
{
$sql = "SELECT *
FROM registration
WHERE mail_id=?
AND password=?";
$stmt = $db->prepare($sql);
$stmt->execute(array($_POST['login_id'], $_POST['password']));
$result = $stmt->fetch();
$_SESSION['sprg_admin'] = 1;
$_SESSION['uid'] = $result['user_id'];
$_SESSION['user'] = $result['student_name'];
$_SESSION['mob'] = $result['mobile_number'];
$_SESSION['class'] = $result['class'];
$_SESSION['paid'] = $result['codestatus'];
$_SESSION['email'] = $_POST['login_id'];
$_SESSION['mail_id'] = $_POST['login_id'];
$notice=NULL;
header('Location: ../home.php');
}
else
{
$_SESSION['sprg_admin'] = NULL;
$_SESSION['admin_notice']= 'Please Try Again';
header('Location: ../login.php');
}

}
else
{
$_SESSION['admin_notice']='wrong password';

header('Location: ../login.php');
}

}
else{
$_SESSION['admin_notice']='wrong username';
header('Location: ../login.php');
}

exit;
	}
else{
$_SESSION['admin_notice']='Please Try Again';
header('Location: ../login.php');
}