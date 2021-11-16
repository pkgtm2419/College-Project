<?php 
$get_user_set=mysql_query("SELECT `user_id` FROM `answer_master`");
while($get_Users=mysql_fetch_array($get_user_set))
{
$get_result_set=mysql_query("SELECT q.ques_id,correct,marks,(select answer from ".$table."answer_master a where user_id='".$get_Users."' and a.ques_id=q.ques_id and a.test_id=q.test_id) as answer,tst.negative_marks,tsm.negative_marks as sub_negative_marks FROM question_master q left join subject_master s on q.subject_id=s.subject_id left join test_master tst on q.test_id=tst.test_id left join test_subject_relation_master tsm on q.test_id=tsm.test_id and q.subject_id=tsm.subject_id where q.test_id=".$_POST['testid']." order by subject_name asc");
while($get_result=mysql_fetch_array($get_result_set))
{
$total=$total+$get_result["marks"];
$tques++;
if($get_result["answer"]==$get_result["correct"])
{
$att++;
$mymarks=$mymarks+$get_result["marks"];$correct++;
}
elseif(($get_result["answer"]!=$get_result["correct"])&&($get_result["answer"]!=""))
{
$att++;
$incorrect++;
if($get_result["sub_negative_marks"]=="")
{
$mymarks=$mymarks-$get_result["negative_marks"];
}
else
{
$mymarks=$mymarks-$get_result["sub_negative_marks"];
}
}
else{$natt++;}
}
$patt=($att/$tques)*100;$pnatt=($natt/$tques)*100;
}
?>

