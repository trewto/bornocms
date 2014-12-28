<?php 
/*	Borno
*	Extension file 
*
*/	 





















/*
*
*
*
*
*
*/
if(is_exists_cat(1)){
	if(!get_the_cat(1,'name')=='Uncategory'){
		$cat_des = get_the_cat(1,'description');
		update_cat(1,'Uncategory' ,$cat_des);
	}
	else{
		//nothing to do
	}

}
else{
	borno_query("INSERT INTO $prefix_cat (`id`, `name`, `description`, `times`) VALUES ('1', 'Uncategory', 'This is the new cat', CURRENT_TIMESTAMP);");
}

////////////////////
//form pagenav.php





















/*
*
*
*
*
*
*/
function search_result_count($get_search){
$get_search = htmlspecialchars($get_search);
global $prefix_content;
	$newquery=" and ($prefix_content.post_status='publish' and $prefix_content.title LIKE '%".mysqli_escape($get_search)."%' or $prefix_content.content LIKE '%".mysqli_escape($get_search)."%')";
		$sql = "SELECT * FROM $prefix_content WHERE  post_status='publish' $newquery";

	$number = mysqli_num_rows(borno_query($sql));
	if(isset($_GET['search']) & !isset($_GET['cat'])){
		return $number;
	}
}
















/*
*
*
*
*
*
*/
////////////////s////////////////////////
////insert version info
////

require('version.php');
require('plugin.php');
require('header.php');
require('footer.php');
require('add_new_page.php');
require('shortcode.php');
require_once('widget-main.php');
require_once('widget-add.php');
require_once('img-function.php');
require_once('permalink.php');
/*
We can not load plugin from here.
require('load-plugin.php');


*/
//////////////////////////////////////////
//



/*
*
*	Added on version 1.0.6
*/
if(!function_exists('sent_mail')){

$sitename = strtolower( $_SERVER['SERVER_NAME'] );
	if ( substr( $sitename, 0, 4 ) == 'www.' ) {
		$sitename = substr( $sitename, 4 );
	}
$from_mail = 'noreplay@' . $sitename;



//function
function sent_mail($to , $subject , $message){
	global  $from_mail;	
	$headers  = 'From:'. $from_mail . "\r\n" .
            'Reply-To:'. $from_mail . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8' . "\r\n" ;
	if(mail($to, $subject, $message, $headers)){
		return true ;
	}
	else{
		return false;
	}


	
}

}












/*
*
*
*
*
*
*/
//include function file
/*$theme_directory = get_the_option('theme_folder_name'); 
if(is_admin()){
	if(file_exists('../include/theme/'.$theme_directory.'/functions.php')){
		include('../include/theme/'.$theme_directory.'/functions.php');//include the function file
	}

}
else{
	if(file_exists('include/theme/'.$theme_directory.'/functions.php')){
			include('include/theme/'.$theme_directory.'/functions.php');//include the function file
		}

}*/



//////////////////////////////////////////////////////////////
/*
	Plugin system policy

*/
/////////////////////////////////////////////////////////////