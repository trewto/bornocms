<?php 
/*
*
*	Contact form and registration page captcha img
*	You can displaying captcha by include this file
*	@subpackge captcha
*
*
*
*/
session_start();  
  
  if(isset($_SESSION['rand_code'])){
	$text = $_SESSION['rand_code'];
	$height  = 40;
	$width = 110;
  }
  else{
	$text = 'Borno CMS';
	$height  = 33;
	$width = 234;
  }

  
$dir = 'dir/';  
  
$image = imagecreate($width, $height);  
$white = imagecolorallocate($image, 255, 255, 255);  
  $black = imagecolorallocate($image, 0, 0, 0);  
$color = imagecolorallocate($image, 200, 100, 90); // red  

  //dag
  for ($x=1; $x<=30; $x++){
	  
	  $x1 = rand(1,100);
	  $y1 =rand(1,100);
	  $x2 =rand(1,100);
	  $y2 =rand(1,100);
	  imageline($image, $x1 , $y1 , $x2 , $y2 , $color );
  }
  
  
//imagefilledrectangle($image,0,0,399,99,$white);  
imagettftext ($image, 30, 0, 15, 30, $black, $dir."arial.ttf", $text);  
  
header("Content-type: image/png");  
imagepng($image);  
?>