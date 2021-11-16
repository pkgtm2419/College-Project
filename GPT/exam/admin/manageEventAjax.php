<?php extract($_GET);require_once 'db_inc.php';
if($type=="view")
{
$tres=mysql_query("select user_id,first_name,last_name,email from event_user_registration where test_id=".$tid) or die ('er1');
$i=1;$mymarks=0;while($trow=mysql_fetch_array($tres)){
echo "<tr><td>$i</td><td>".$trow["first_name"]." ".$trow["last_name"]."</td><td>".$trow["email"]."</td><td>";
$get_result_set=mysql_query("SELECT q.ques_id,correct,marks,(select answer from event_answer_master a where user_id='".$trow["user_id"]."' and a.ques_id=q.ques_id and a.test_id=q.test_id) as answer,tst.negative_marks,tsm.negative_marks as sub_negative_marks FROM question_master q left join subject_master s on q.subject_id=s.subject_id left join test_master tst on q.test_id=tst.test_id left join test_subject_relation_master tsm on q.test_id=tsm.test_id and q.subject_id=tsm.subject_id where q.test_id=".$tid." order by subject_name asc");
while($get_result=mysql_fetch_array($get_result_set))
{
if($get_result["answer"]==$get_result["correct"])
{
$mymarks=$mymarks+$get_result["marks"];
}
elseif(($get_result["answer"]!=$get_result["correct"])&&($get_result["answer"]!=""))
{
if($get_result["sub_negative_marks"]==""){$mymarks=$mymarks-$get_result["negative_marks"];}else{$mymarks=$mymarks-$get_result["sub_negative_marks"];}
}
}
echo $mymarks."</td></tr>";$mymarks=0;$i++;}
}
else if($type=="sendmail")
{
$tres=mysql_query("select user_id,first_name,last_name,email from event_user_registration where test_id=".$tid) or die ('er1');
$i=1;$mymarks=0;while($trow=mysql_fetch_array($tres)){$get_result_set=mysql_query("SELECT q.ques_id,correct,marks,(select answer from event_answer_master a where user_id='".$trow["user_id"]."' and a.ques_id=q.ques_id and a.test_id=q.test_id) as answer,tst.negative_marks,tsm.negative_marks as sub_negative_marks FROM question_master q left join subject_master s on q.subject_id=s.subject_id left join test_master tst on q.test_id=tst.test_id left join test_subject_relation_master tsm on q.test_id=tsm.test_id and q.subject_id=tsm.subject_id where q.test_id=".$_POST['testid']." order by subject_name asc");
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
$patt=($att/$tques)*100;$pnatt=($natt/$tques)*100;
$message='<html><head></head><body><div style="background:url(images/header/green/header-bg.png) repeat-x scroll 0 0 #96AC20;border-top:3px solid #F6F6E9;overflow:hidden;padding: 15px;" id="header-bar"><a style="background-image:url(images/header/green/logo.png);float:left;background-repeat:no-repeat;height:80px;width:285px;" href=""><span style="color:#FFFFFF;font-size:12px;font-weight:bold;"><br><br><br><br><br>Online Exam</span></a></div><div style="font-size:17px;font-weight:bold;">Hi '.$trow["first_name"].' '.$trow["last_name"].'</div><div style="font-size:17px;font-weight:bold;">Total Assesment of Test:-<br/><br/></div><table width="450px"><tr><td width="250px">My Marks</td><td><b><span id="mymarks">'.$mymarks.'</span></b> out of <b><span id="totmarks">'.$total.'</span></b></td></tr><tr><td>My Correct Ans</td><td><b><span id="qcorrect">'.$correct.'</span></b> out of <b><span id="qtotal1">'.$tques.'</span></b> questions</td></tr><tr style="height:35px;"><td>Incorrect Ans</td><td><b><span id="qincorrect">'.$incorrect.'</span></b> out of <b><span id="qtotal2"></span>'.$tques.'</b> questions</td></tr><tr><td class="showPercent">% Attempted</td><td>'.$patt.'%</td></tr><tr><td>% Not Attempted</td><td class="showPercent">'.$pnatt.'%</td></tr></table><div><a href="results.php?event'.$isEvent.'&tid='.$_POST['testid'].'&uid='.$rnd.'">Click here to view Detail Report annd Analysis of your Exam.</a></div></body></html>';$headers="From:info@onlineexamonline.in\r\n";$headers .='MIME-Version: 1.0'."\r\n".'Content-type: text/html; charset=iso-8859-1'."\r\n";$to="ankur10don@gmail.com,info@onlineexamonline.com,".$trow["email"];mail($to,"OnlineExamOnline.com Exam Reports",$message,$headers);
	
}
//$tres=mysql_query("update event_user_registration set event_status='stop' where test_id=".$tid) or die ('er');
echo "s";
}
?>