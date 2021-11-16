<?php
function retrievebyId($id,$name)
{
global $db;
$sql="Select *
FROM $name
WHERE id='$id'
LIMIT 1";
$stmt=$db->prepare($sql);
$stmt->execute();
$news=$stmt->fetch();
return $news;
}

function retrieveallInfo($name,$no)
 {
global $db;
$sql = "SELECT *
FROM $name
LIMIT $no";
foreach($db->query($sql) as $row) {
$batch[]= $row;
}
return $batch;
}
function exeSql($sql)
 {
global $db;
$sql ="SELECT * FROM expense WHERE salary=1 AND sessionId='$sessionId'";
foreach($db->query($sql) as $row) {
$batch[]= $row;
}
return $batch;
}
function retrieveallinfobyKey($key,$id,$name,$no)
 {
 global $db;
 $sql = "SELECT *
FROM $name
WHERE $key='$id'
LIMIT $no";
foreach($db->query($sql) as $row) {
$batch[]= $row;
}
return $batch;
}

function delete($id,$table)
{
global $db;
$sql = "DELETE FROM $table
WHERE id=?
LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->execute(array($id));
return true;
}
?>