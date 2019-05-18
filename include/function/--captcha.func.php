<?php
/*
*
*	Captcha	Function
*	@packge Borno CMS
*	@author Arnob protim Roy
*	@subpackge captcha
*
*/




/*
*
*	Show Captcha 
*	include text as img formet form output.php file
*	uses $text string - the text of captcha
*
*/
function show_captcha($text=''){
	/*
	*
	*	Displaying captcha form the output file
	*	Display captcha by [c] / get method
	*
	*/
	echo "<img src='".get_the_option('site_address')."/output.php?c=$text'/>";

}



/*
*	The captcha
*	generate the captcha img
*	uses $text - the captcha text to display
*	uses $height - the captcha height to display
*	uses $width -	the captcha img width
*
*/
function the_captcha($text='',$height=false,$width=false){
	if(empty($text)){
		$text=' ';
	}
	if(!$height){
	$height  = 30 ;
	}
	if(!$width){
	$width = ( 15 * strlen($text) )+8 ;
	}
	
  
$dir = 'include/function/dir/';  
  
$image = imagecreate($width, $height);  
$white = imagecolorallocate($image, 255, 255, 255);  
  $black = imagecolorallocate($image, 0, 0, 0);  
$color = imagecolorallocate($image, 200, 100, 90); // red  

  //dag
  /*
  for ($x=1; $x<=30; $x++){
	  
	  $x1 = rand(1,100);
	  $y1 =rand(1,100);
	  $x2 =rand(1,100);
	  $y2 =rand(1,100);
	  imageline($image, $x1 , $y1 , $x2 , $y2 , $color );
  }*/
  
  
//imagefilledrectangle($image,0,0,399,99,$white);  
imagettftext ($image, 20, 0, 5, 23, $color, $dir."arial.ttf", $text);  
  
header("Content-type: image/png");  
imagepng($image);  

}