<?php session_start();if((!isset($_SESSION["uid"]))||(!isset($_SESSION["uname"]))||($_SESSION["uname"]=="")||($_SESSION["uid"]=="")){session_destroy();header("Location:index.php");}
function generateRandomString($length = 10) {
    $characters = '01TUV23wx6789abcdefgFGHIJhijklmno45uvyzABCDEKLMpqrstNOPQRSWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
if(empty($_POST['check']))

{

$_SESSION['admin_notice']='<font size="6" color="red">Please Select the Student</font>';

header('Location: ../student_show.php');

exit;

}

$i=0;

include '../db_inc.php';

foreach($_POST['check'] as $check)

{

if($_POST['submit']=='Active')

{

//here upating process will be done

  $query="UPDATE m01_regstration SET status = 1 WHERE user_id = $check";

 $result = mysql_query($query);

 

}

elseif($_POST['submit']=='Deactive')

{

//here upating process will be done

$query="UPDATE `m01_regstration` SET status=0 WHERE user_id=$check";

$result = mysql_query($query);

}
elseif($_POST['submit']=='Refresh')

{
$random=generateRandomString(8);
//here upating process will be done

$query="UPDATE `m01_regstration` SET code='$random',codestatus=0 WHERE user_id=$check";

$result = mysql_query($query);

}

elseif($_POST['submit']=='Delete')

{

//here upating process will be done

$query="DELETE FROM `m01_regstration`
WHERE user_id=$check
LIMIT 1";

$result = mysql_query($query);

}

$i++;

}

$_SESSION['admin_notice']='<font size="6" color="green">'.$i.' students have been updated</font>';

header('Location: ../student_show.php');

exit;

?>

