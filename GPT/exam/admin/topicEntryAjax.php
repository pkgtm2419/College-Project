<?php extract($_POST);include 'db_inc.php';mysql_query("Delete from topic_master where topic_id='$id'") or die ('er');echo "s";?>