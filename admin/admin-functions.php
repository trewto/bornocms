<?php
include('../functions.php');
if(!user_logged_in()){
	header('Location:../sign-in.php?back='.urlencode(current_url()));
	borno_die('You can not access this page');
}
$page_number=admin_url().'/?page=';
###########################################################



/**
**Time Zone funcitons
**
***/ 
function tz_list() {
	$zones_array = array();
	$timestamp = time();
	foreach(timezone_identifiers_list() as $key => $zone) {
		date_default_timezone_set($zone);
		$zones_array[$key]['zone'] = $zone;
		$zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
	}
	return $zones_array;
}



















/////////////////////////////////////////////////////

if(!function_exists('is_home')){
	function is_home(){
			return false;
	}
}
if(!function_exists('is_404')){
	function is_404(){
			return false;
	}
}
if(!function_exists('is_orderbyvisit')){
	function is_orderbyvisit(){
			return false;
	}
}


if(!function_exists('is_cat')){
	function is_cat(){
			return false;
	}
}


if(!function_exists('is_single')){
	function is_single(){
			return false;
	}
}

if(!function_exists('is_single')){
	function is_single(){
			return false;
	}
}
if(!function_exists('is_doc')){
	function is_doc(){
			return false;
	}
}

if(!function_exists('is_search')){
	function is_search(){
			return false;
	}
}


if(!function_exists('is_profile')){
	function is_profile(){
			return false;
	}
}


if(!function_exists('previous_page_link')){
	function previous_page_link(){
			return false;
	}
}


if(!function_exists('next_page_link')){
	function next_page_link(){
			return false;
	}
}

if(!function_exists('have_post')){
	function have_post(){
			return false;
	}
}if(!function_exists('the_nav')){
	function the_nav(){
			return false;
	}
}


require_once('../include/function/load-plugin.php');
