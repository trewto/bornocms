<?php
/*
	* Borno CMS
	* BoRnO CmS
	Check the theme condition
5 page is necessary to load the theme 
index.php
404.php
doc.php
single.php
style.css
	
*/
	if($theme_directory=='offline'){
		borno_die_title('Site Offline','The site is currently offline . Please try another time.');
	}
	
	if(!file_exists('portable/theme/'.$theme_directory.'/index.php')){
	
		borno_die('Uncompleate theme pack. Please check the necassary item of the theme . No valid theme found.');
	}
	
	if(!file_exists('portable/theme/'.$theme_directory.'/404.php')){
	
		borno_die('Uncompleate theme pack. Please check the necassary item of the theme . No valid theme found.');
	}
	if(!defined("STOP_CHECK_DOC.PHP")){
		if(!file_exists('portable/theme/'.$theme_directory.'/doc.php')){
		
			borno_die('Uncompleate theme pack. Please check the necassary item of the theme . No valid theme found.');
		}
	}
	if(!file_exists('portable/theme/'.$theme_directory.'/single.php')){
	
		borno_die('Uncompleate theme pack. Please check the necassary item of the theme . No valid theme found.');
	}
	if(!file_exists('portable/theme/'.$theme_directory.'/style.css')){
		borno_die('you must need a style.css file on theme folder to provide style');
	}
	