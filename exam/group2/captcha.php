<?php session_start();
$string='';
for($i=0;$i<5;$i++)
{
	$string.=chr(rand(97,122));
}
	$_SESSION['random_number']=$string;
	$dir='fonts/';
	$image=imagecreatetruecolor(125,33);
	$font="Molot.otf";
	$num2=rand(1,2);
		if($num2==1)
		{
			$color=imagecolorallocate($image,113,193,217);
		}
		else
		{
			$color=imagecolorallocate($image,163,197,82);
		}
	$white=imagecolorallocate($image,56,56,56);
	imagefilledrectangle($image,0,0,399,99,$white);
	imagettftext($image,20,0,10,30,$color,$dir.$font,$_SESSION['random_number']);
	header("Content-type: image/png");
	imagepng($image);
	?>