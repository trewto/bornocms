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