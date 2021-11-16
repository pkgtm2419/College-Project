<?php extract($_POST);include 'db_inc.php';
if(isset($t))
{
if($t=="hide")
{
mysql_query("Update test_master set isVisible='N' where test_id='$id'") or die ('er');
echo "s";
}
if($t=="show")
{
mysql_query("Update test_master set isVisible=null where test_id='$id'") or die ('er');
echo "s";
}
if($t=="del")
{
$qcount=mysql_fetch_array(mysql_query("select count(1) from question_master where test_id='$id'"));
if($qcount[0]==0)
{
mysql_query("Delete from test_master where test_id='$id'") or die ('er');
mysql_query("Delete from test_subject_relation_master where test_id='$id'") or die ('er');
echo "s";
}
}
}?>