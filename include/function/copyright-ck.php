<?php 
/*
*	Copyright function 
*/



if(!defined(decode14($ck))){
	borno_die(decode14($mgk_1));
}
if(defined(decode14($ck))){
	 $decode  = decode14(COPYRIGHT_KEY);
	
	if(json_decode($decode)){
		$keys = json_decode($decode);
		global $lck; 
		$lck  =  $keys;
	
	}else{
		borno_die(decode14($mgk_2));
	}
}


if($lck->FEED!=1){
	if(!empty($_SERVER['SCRIPT_FILENAME']) && 'feed.php' == basename($_SERVER['SCRIPT_FILENAME'])){
		borno_die(decode14($mgk_3));
	}
}
if($lck->PHOTO!=1){
	if(!empty($_SERVER['SCRIPT_FILENAME']) && 'img.gal.php' == basename($_SERVER['SCRIPT_FILENAME'])){
		borno_die(decode14($mgk_3));
	}
	if(!empty($_SERVER['SCRIPT_FILENAME']) && 'img_upload.php' == basename($_SERVER['SCRIPT_FILENAME'])){
		borno_die(decode14($mgk_3));
	}
}
