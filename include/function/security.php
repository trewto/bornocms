<?php
   /*
	*	@Borno CMS
	*	This is the security function of this cms
	*   Security Page
	*
	*
	*
	*/

	
   /*
    *	Denied the access if user want to try the page load directly
	*
	*
	*
	*/
		// functions.php
		if(!empty($_SERVER['SCRIPT_FILENAME']) && 'functions.php' == basename($_SERVER['SCRIPT_FILENAME'])){
			borno_die('Please do not load this page directly!');
		}
        // back-up.php
		if(!empty($_SERVER['SCRIPT_FILENAME']) && 'back-up.php' == basename($_SERVER['SCRIPT_FILENAME'])){
			borno_die('Please do not load this page directly!');
		}
		//mail-manager.php
		if(!empty($_SERVER['SCRIPT_FILENAME']) && 'mail-manager.php' == basename($_SERVER['SCRIPT_FILENAME'])){
			borno_die('Please do not load this page directly!');
		}
		// security.php
		if(!empty($_SERVER['SCRIPT_FILENAME']) && 'security.php' == basename($_SERVER['SCRIPT_FILENAME'])){
			borno_die('Please do not load this page directly!');
		}
		// site-install.php
		if(!empty($_SERVER['SCRIPT_FILENAME']) && 'site-install.php' == basename($_SERVER['SCRIPT_FILENAME'])){
			borno_die('Please do not load this page directly!');
		} 
		// admin-functions.php
		if(!empty($_SERVER['SCRIPT_FILENAME']) && 'admin-functions.php' == basename($_SERVER['SCRIPT_FILENAME'])){
			borno_die('Please do not load this page directly!');
		}
		// config.php
		if(!empty($_SERVER['SCRIPT_FILENAME']) && 'config.php' == basename($_SERVER['SCRIPT_FILENAME'])){
			borno_die('Please do not load this page directly!');
		}
		// function.php
		if(!empty($_SERVER['SCRIPT_FILENAME']) && 'function.php' == basename($_SERVER['SCRIPT_FILENAME'])){
			borno_die('Please do not load this page directly!');
		}
		// load.php
		if(!empty($_SERVER['SCRIPT_FILENAME']) && 'load.php' == basename($_SERVER['SCRIPT_FILENAME'])){
			borno_die('Please do not load this page directly!');
		}
		// progress.php
		if(!empty($_SERVER['SCRIPT_FILENAME']) && 'progress.php' == basename($_SERVER['SCRIPT_FILENAME'])){
			if(isset($_SERVER['HTTP_REFERER'])){
				if($_SERVER['HTTP_REFERER']=='' or empty($_SERVER['HTTP_REFERER'])){
					borno_die('Please do not load the Page!');
				}
			}
			else{
				if(!isset($_GET['key']) and !isset($_GET['active_account'])){
					borno_die('Please do not load the page');
				}
			}
		}
		
		
		/*
		 *
		 *
		 *	borno_die();
		 *	defult die function of this cms
		 *
		 *
		 */
		 
	function borno_die($reason,$title='Error'){
		ob_end_clean();
		$die = "<!DOCTYPE html><head><title>$title</title></head><style>.borno_die{padding:8px;margin:0 auto;margin-top:45px;width:800px;background:white;border-radius:5px;} body{background:#f1f1f1;font-family:Arial;};</style>";
		$die .= '<div class="borno_die">';
		$die .= $reason;
		$die .= '</div>';
		die($die);
		exit();
	}
	
	
	
	function borno_die_title($title,$reason){
		ob_end_clean();
		$die = "<!DOCTYPE html><head><title> $title</title></head><style>.borno_die{padding:8px;margin:0 auto;margin-top:45px;width:800px;background:white} body{background:#f1f1f1;font-family:Arial;}</style>";
		$die .= '<div class="borno_die">';
		$die .= $reason;
		$die .= '</div>';
		die($die);
		exit();
	}
	


	//copyright key 
	$ck  =  "p4k3m3y3r3g3p4e33524u4m4w3";
	//no key found
	$mgk_1 = "05g4a2r3a4a4n5l4z5l4g5x5c4s5e482k4e4v4h284w536i464c2";////msg 1
	//invalid key 
	$mgk_2 = "v4f4o464h4c4i5a2q58446";
	//need proc_close
	$mgk_3 = "b5g4n4d2j484j564n3j4x5s5b2z554i4s4i4l4n4a216x5c23464j5d4m4x5l3a406";

	
		