<?php extract($_POST);require_once 'db_inc.php';if(isset($t)){if(($t=="d")&&(isset($stid))){mysql_query("Delete from sub_topic_master where sub_topic_id='$id'") or die ('er');echo "s";}else if(($t=="tp")&&(isset($sid))){$tres=mysql_query("SELECT topic_id,topic_name FROM topic_master where subject_id=".$sid) or die ('er');while($trow=mysql_fetch_array($tres)){echo "<option value='".$trow["topic_id"]."'>".$trow["topic_name"]."</option>";}}else{echo "er";}}else{echo "er";}?>