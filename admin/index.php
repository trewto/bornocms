<?php
/*
*
*	This is the index file of the admin panel , this file decide what file is to include
*
*
*/
//error_reporting(1);
ob_start();
include('admin-functions.php');
// $include= header php
// body page
if(!isset($_GET['pages'])){
	if(isset($_GET['welcome']) && count($_GET)==1){
		$include=('theme/home.php');
			$title = 'Admin Home';
	}else

	if(!req_get_count()==0){
		borno_die('You enter a wrong page');
	}
	
	$include=('theme/home.php');
				$title = 'Home';

}
else if(isset($_GET['pages'])){
	$action = $_GET['pages'];
	if($action=='profilesetting'){
		$include=('user-setting.php');
		$title = 'Change Profile ';
	}
	else if($action=='editor'){
		$include=('post-editor.php');
			$title = 'Add New Content';
			if(isset($_GET['edit_id'])){
			
				$title = 'Edit Content';
			}
	}
	else if($action=='changesocial'){
		$include=('changesocial.php');
			$title = 'Change Social';
	}
	//else if($action=='backup'){
		//$include=('back-up.php');
			//$title = 'Backup Your site';
	//}
	else if($action=='managepost'){
		$include=('manage-post.php');
			$title = 'Manage Post';
	}
	else if($action=='changepassword'){
		$include=('passwordchange.php');
			$title = 'Change Password';
	}
	else if($action=='manageuser'){
		$include=('manage-user.php');
			$title = 'Manage User';
	}
	else if($action=='sitesetting'){
		$include=('site-setting.php');
			$title = 'Site Setting';
	}
	else if($action=='edituser'){
		$include=('edit-user.php');
			$title = 'Edit User Profile';
	}
	else if($action=='add-user'){
		$include=('add_user.php');
			$title = 'Add new user';
	}
	else if($action=='notify'){
		$include=('notify.php');
			$title = 'Your Notification';
	}
	else if($action=='doceditor'){
		$include=('doc-editor.php');
			$title = 'Edit Doc';
	}
	else if($action=='managedoc'){
		$include=('managedoc.php');
			$title = 'Manage Doc';
	}
	else if($action=='manage-comment'){
		$include=('manage-comment.php');
			$title = 'Manage Comment';
	}
	else if($action=='catlist'){
		$include=('category-page.php');
			$title = 'Manage Your Category';
	}
	else if($action=='addcat'){
		$include=('add-new-category.php');
			$title = 'Manage Your Category';
	}
	else if($action=='edit_cat'){
		$include=('edit-category.php');
			$title = 'Manage Your Category';
	}
	else if(anp_the_page_exists($action,1)){
		$include=  ('custom_user_page_fun.php');
		$title =  anp_get_the_page($action , 1);
	}
	else if(!req_get_count()==0){
		borno_die('You enter a wrong page');
	}
	
	else{
		$include=('theme/home.php');
			$title = 'Admin Home';
	}	


}
$theme = 'jsc_admin';
include('theme/'.$theme.'/header.php');
//include($include);
//footer php 
include('theme/'.$theme.'/home.php');
include('theme/'.$theme.'/footer.php');