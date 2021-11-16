<?php 
define('DB_INFO', 'mysql:host=localhost;dbname=aryahans');
define('DB_USER', 'root');
define('DB_PASS', '');
$dbhost='localhost';
$dbuser='root';
$dbpass='';
$con=mysql_connect($dbhost, $dbuser, $dbpass) or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno());
mysql_select_db('aryahans') or die("Couldn't select database:<br>" . mysql_error(). "<br>" . mysql_errno());?>