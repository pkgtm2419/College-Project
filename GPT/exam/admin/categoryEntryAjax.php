<?php extract($_POST);include 'db_inc.php';mysql_query("Delete from category_master where category_id='$id'") or die ('er');echo "s";?>