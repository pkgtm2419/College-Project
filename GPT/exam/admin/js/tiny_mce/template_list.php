<?php
ob_start();
$output = ''; 
$delimiter = "\n";

$output .= 'var tinyMCEImageList = new Array(';

$directory = "edu_templates";

$abspath = preg_replace('~^/?(.*)/[^/]+$~', '/$1', $_SERVER['SCRIPT_NAME']);

if (is_dir($directory)) 
{
	$direc = opendir($directory);
	while ($file = readdir($direc)) 
	{
		if ($file != '.' && $file != '..' && $file != '' && is_file("$directory/$file"))
		{
			$output .= $delimiter
							 . '["'
							 . utf8_encode($file)
							 . '", "'
							 . utf8_encode("$abspath/$directory/$file")
							 . '"],';
		 }
	}

	$output = substr($output, 0, -1);
	$output .= $delimiter;

	closedir($direc);
}

$output .= ');';

header('Content-type: text/javascript'); 

header('pragma: no-cache');
header('expires: 0'); 

echo $output;
?>