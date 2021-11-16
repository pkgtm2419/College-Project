<!DOCTYPE html><html><head><script>function fn_reloadPage(type,res){window.open("testEntry.php?type="+type+"&res="+res,"_parent");}</script></head><body>
<?php
if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST["submit"]))
{
require_once 'db_inc.php';extract($_POST);
if($tname!="")
{
if($tHidden!="")
{
mysql_query("update test_master set test_name='$tname',isEvent='$isEvent',category_id='$cname',cutoff_marks='$cutoffmarks',negative_marks='$negativeMarks',test_duration='$duration' where test_id=".$tHidden) or die ('Test update failed');
mysql_query("DELETE FROM test_subject_relation_master WHERE test_id=".$tHidden) or die ('Test update failed');
for($i=1;$i<=$totalSub;$i++)
{
if(isset($chkSub[$i]))
{

mysql_query("INSERT INTO test_subject_relation_master(test_id,subject_id,cutoff_marks,negative_marks) VALUES ('$tHidden','".$chkSub[$i]."','".$cutoffmarksS[$i]."','".$negativeMarksS[$i]."')");
}
}
?><script>fn_reloadPage("new","success");</script><?php						
}
else
{
$dup2row=mysql_fetch_row(mysql_query("select count(1) from test_master where test_name='".$tname."' and category_id='".$cname."'"));
if($dup2row[0]>0){?><script>fn_reloadPage("new","er");</script><?php }
else
{
mysql_query("INSERT INTO test_master (test_name,category_id,cutoff_marks,negative_marks,test_duration,isEvent) VALUES('$tname','$cname','$cutoffmarks','$negativeMarks','$duration','$isEvent')") or die ('Test Saving Failed.'. mysql_error());
$testid=mysql_fetch_row(mysql_query("select max(test_id) from test_master"));
for($i=1;$i<=$totalSub;$i++)
{
if(isset($chkSub[$i]))
{
mysql_query("INSERT INTO test_subject_relation_master(test_id,subject_id,cutoff_marks,negative_marks) VALUES ('".$testid[0]."','".$chkSub[$i]."','".$cutoffmarksS[$i]."','".$negativeMarksS[$i]."')");
}
}
?><script>fn_reloadPage("new","success");</script><?php	
}
}
}else{?><script>fn_reloadPage("new","val");</script><?php }}?></body></html>