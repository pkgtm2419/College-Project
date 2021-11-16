<?php
 session_start();
if(isset($_SESSION['sprg_admin']) && $_SESSION['sprg_admin']== 1)
{
if($_SERVER['REQUEST_METHOD']=='POST'
	&& !empty($_POST['code'])
	)
{
$code=trim($_POST['code']);
$uid=$_SESSION['uid'];
include_once 'db.inc.php';
$db = new PDO(DB_INFO, DB_USER, DB_PASS);
// Save the entry into the database
$sql = 	"UPDATE registration SET codestatus=?
		WHERE user_id='$uid'
		AND code='$code'
		LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->execute(
array(
1
)          );
$stmt->closeCursor();
$_SESSION['admin_notice']='You Have Successfully Subscribe The Test!Please Logout and Then Login Again!';
header('Location: ../home.php');
exit;
}
else{
$_SESSION['admin_notice']='Please Fill the Code!!!';
header('Location: buy.php');
exit;
}
}
else{
session_destroy();
header('Location: index.php');
}
?>
