<?php require_once 'db_inc.php';extract($_POST);
if(isset($t))
{
if(($t=="get")&&(isset($tstid)))
{
$tres=mysql_query("select q.*,subject_name,topic_name,sub_topic_name,test_name from question_master q left join subject_master s on q.subject_id=s.subject_id left join topic_master tp on q.topic_id=tp.topic_id left join sub_topic_master stm on q.sub_topic_id=stm.sub_topic_id left join test_master tm on q.test_id=tm.test_id where q.test_id=".$tstid) or die ('er');$i=1;
while($row=mysql_fetch_array($tres)){
echo "<tr id='r$i'><td>$i</td><td>".$row["test_name"]."</td><td>".$row["subject_name"]."</td><td>".$row["topic_name"]."</td><td align='left'>".$row["ques"]."&ensp;<img src='uploads/questions/".$row["ques_image"]."'</td><td>".$row["marks"]."</td><td><input type='checkbox'";if($row["isVisible"]==""){echo "checked='checked'";}echo " value='".$row["test_id"]."' onclick=\"fn_display_it(this,'$i');\"/><td>";?><a onclick="fn_set('e','<?php echo $row["ques_id"];?>');">Edit</a>&ensp;<a onclick="fn_set('d','<?php echo "$i','".$row["ques_id"];?>');">Delete</a></td></tr><?php $i++;
}
}
else if(($t=="sub")&&(isset($tid)))
{
$tres=mysql_query("SELECT tsm.subject_id,subject_name FROM test_subject_relation_master tsm inner join subject_master s on tsm.subject_id=s.subject_id where test_id=".$tid) or die ('er');
while($trow=mysql_fetch_array($tres))
{
echo "<option value='".$trow["subject_id"]."'>".$trow["subject_name"]."</option>";
}
}
else if(($t=="tp")&&(isset($sid)))
{
$tres=mysql_query("SELECT topic_id,topic_name FROM topic_master where subject_id=".$sid) or die ('er');
while($trow=mysql_fetch_array($tres))
{
echo "<option value='".$trow["topic_id"]."'>".$trow["topic_name"]."</option>";
}
}
else if(($t=="stp")&&(isset($sid))&&(isset($tid)))
{
$tres=mysql_query("SELECT sub_topic_id,sub_topic_name FROM sub_topic_master where subject_id=".$sid." and topic_id=".$tid) or die ('er');
while($trow=mysql_fetch_array($tres))
{
echo "<option value='".$trow["sub_topic_id"]."'>".$trow["sub_topic_name"]."</option>";
}
}
else if(($t=="d")&&(isset($id)))
{
mysql_query("Delete from question_master where ques_id='$id'") or die ('er');
echo "s";
}
else{echo "er";}
}
else{echo "er";}?>