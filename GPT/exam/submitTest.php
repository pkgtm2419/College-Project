<?php require_once 'admin/db_inc.php';if(isset($_POST["submit"])){session_start();$total=0;$correct=0;$incorrect=0;$att=0;$natt=0;$tques=0;$mymarks=0;$isEvent=$_POST["examType"];
$table="";if($isEvent=="true"){$rnd=$_SESSION["uid"];$table="event_";$userDetail=mysql_fetch_array(mysql_query("select email from event_user_registration where user_id=".$rnd));?><script>function fn_return_event(){window.opener.location="results.php?event=<?php echo $isEvent;?>";window.opener.focus();window.close();}</script><?php }else{$rnd=rand(2,5000);$table="";$_SESSION["uid"]=$rnd;}
for($i=1;$i<=$_POST["qtotal"];$i++){if($_POST['answered_'.$i]!=""){mysql_query("INSERT INTO ".$table."answer_master(ques_id,test_id,subject_id,user_id,answer,answer_datetime) VALUES('".$_POST['qchanged_'.$i]."','".$_POST['testid']."','".$_POST['schanged_'.$i]."','".$rnd."','".$_POST['answered_'.$i]."',NOW())") or die('Saving Failed.'.mysql_error());}}
if($isEvent=="true"){?><script>fn_return_event();</script><?php die();}
$get_result_set=mysql_query("SELECT q.ques_id,correct,marks,(select answer from ".$table."answer_master a where user_id='".$rnd."' and a.ques_id=q.ques_id and a.test_id=q.test_id) as answer,tst.negative_marks,tsm.negative_marks as sub_negative_marks FROM question_master q left join subject_master s on q.subject_id=s.subject_id left join test_master tst on q.test_id=tst.test_id left join test_subject_relation_master tsm on q.test_id=tsm.test_id and q.subject_id=tsm.subject_id where q.test_id=".$_POST['testid']." order by subject_name asc");
while($get_result=mysql_fetch_array($get_result_set))
{
$total=$total+$get_result["marks"];$tques++;
if($get_result["answer"]==$get_result["correct"]){$att++;$mymarks=$mymarks+$get_result["marks"];$correct++;}
elseif(($get_result["answer"]!=$get_result["correct"])&&($get_result["answer"]!=""))
{
$att++;$incorrect++;if($get_result["sub_negative_marks"]==""){$mymarks=$mymarks-$get_result["negative_marks"];}else{$mymarks=$mymarks-$get_result["sub_negative_marks"];}
}
else{$natt++;}
}
$msg='Dear Student Your Online Exam Report is,
Marks: '.$mymarks.' out of '.$total.'
Correct Ans: '.$correct.' out of '.$tques.'
Regards AEI Kanpur';
$msg=urlencode($msg);


	$url = 'http://sms.todaybiz.in/SendSMS/sendmsg.php?uname=aeiknp&pass=webcure&send=AEIKNP&dest='.$_SESSION['mob'].'&msg='.$msg;
    
  $ch = curl_init();
// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
// grab URL and pass it to the browser
$result= curl_exec($ch);
// close cURL resource, and free up system resources
curl_close($ch);
$patt=($att/$tques)*100;$pnatt=($natt/$tques)*100;
$message='<html><head></head><body><div style="background:url(images/header/green/header-bg.png) repeat-x scroll 0 0 #96AC20;border-top:3px solid #F6F6E9;overflow:hidden;padding: 15px;" id="header-bar"><a style="background-image:url(http://aryahans.com/img/logo.png);float:left;background-repeat:no-repeat;height:80px;width:285px;" href=""><span style="color:#FFFFFF;font-size:12px;font-weight:bold;"><br><br><br><br><br>onlineexamonline</span></a></div><div style="font-size:17px;font-weight:bold;">Total Assesment of Test:-<br/><br/></div><table width="450px"><tr><td width="250px">Student Name</td><td><b><span id="mymarks">'.$_SESSION['user'].'</span></b> </td></tr><tr><td width="250px">Student Email Id</td><td><b><span id="mymarks">'.$_SESSION['email'].'</span></b> </td></tr><tr><td width="250px">My Marks</td><td><b><span id="mymarks">'.$mymarks.'</span></b> out of <b><span id="totmarks">'.$total.'</span></b></td></tr><tr><td>My Correct Ans</td><td><b><span id="qcorrect">'.$correct.'</span></b> out of <b><span id="qtotal1">'.$tques.'</span></b> questions</td></tr><tr style="height:35px;"><td>Incorrect Ans</td><td><b><span id="qincorrect">'.$incorrect.'</span></b> out of <b><span id="qtotal2"></span>'.$tques.'</b> questions</td></tr><tr><td class="showPercent">% Attempted</td><td>'.$patt.'%</td></tr><tr><td>% Not Attempted</td><td class="showPercent">'.$pnatt.'%</td></tr></table><div><a href="results.php?event'.$isEvent.'&tid='.$_POST['testid'].'&uid='.$rnd.'">Click here to view Detail Report annd Analysis of your Exam.</a></div></body></html>';$headers="From:".$_SESSION['email']."\r\n";$headers .='MIME-Version: 1.0'."\r\n".'Content-type: text/html; charset=iso-8859-1'."\r\n";$to="aeionlineexam@gmail.com,".$userDetail[0];mail($to,"Exam Reports",$message,$headers);mail($_SESSION['email'],"Exam Reports",$message,$headers)?><script>function fn_return(){window.opener.location="results.php?event=<?php echo $isEvent;?>&tid=<?php echo $_POST['testid'];?>";window.opener.focus();window.close();}fn_return();</script><?php }?>