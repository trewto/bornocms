<?php
/*
	* Borno CMS
	* BoRnO CmS
	Check the theme condition
5 pages are necessary to be loaded 
index.php
404.php
doc.php
single.php
style.css
	
*/
	if($theme_directory=='offline'){
		borno_die_title('Site Offline','The site is currently off-line.');
	}
	
	if(!file_exists('portable/theme/'.$theme_directory.'/index.php')){
	
		borno_die('Uncompleted theme package. Please check the necessary items of the theme.');
	}
	
	if(!file_exists('portable/theme/'.$theme_directory.'/404.php')){
	
		borno_die('Uncompleted theme package. Please check the necessary items of the theme.');
	}
	if(!defined("STOP_CHECK_DOC.PHP")){
		if(!file_exists('portable/theme/'.$theme_directory.'/doc.php')){
		
			borno_die('Uncompleted theme package. Please check the necessary items of the theme.');
		}
	}
	if(!file_exists('portable/theme/'.$theme_directory.'/single.php')){
	
		borno_die('Uncompleted theme package. Please check the necessary items of the theme.');
	}
	if(!file_exists('portable/theme/'.$theme_directory.'/style.css')){
		borno_die('Style.css file is not founded.');
	}
	