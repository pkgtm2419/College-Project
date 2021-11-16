<?php define('DB_INFO', 'mysql:host=aryahans.db.10615588.hostedresource.com;dbname=aryahans');define('DB_USER', 'aryahans');define('DB_PASS', 'abc!@#ABC123');
$dbhost='aryahans.db.10615588.hostedresource.com';
$dbuser='aryahans';
$dbpass='abc!@#ABC123';
$con=mysql_connect($dbhost, $dbuser, $dbpass) or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno());
mysql_select_db('aryahans') or die("Couldn't select database:<br>" . mysql_error(). "<br>" . mysql_errno());?>