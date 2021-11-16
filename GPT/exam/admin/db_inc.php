<?php 
define('DB_INFO', 'mysql:host=localhost;dbname=allenhouse');
define('DB_USER', 'root');
define('DB_PASS', 'abhi');
$dbhost='localhost';
$dbuser='root';
$dbpass='abhi';
$con=mysql_connect($dbhost, $dbuser, $dbpass) or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno());
mysql_select_db('allenhouse') or die("Couldn't select database:<br>" . mysql_error(). "<br>" . mysql_errno());?>