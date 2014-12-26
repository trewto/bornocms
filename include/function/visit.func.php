<?php
/*
*
*	content visit system
*
*
*
*/


















/*
*
*	visit_count_progress
*
*
*
*/
function visit_count_progress ($id){
	if(filter_var($id, FILTER_VALIDATE_INT)){

	global $prefix_visit;
	$query = borno_query("SELECT * FROM $prefix_visit WHERE post_id='$id'");
	$count = mysqli_num_rows($query);
	if($count==1){
		$row = mysqli_fetch_array($query);
		$visit = $row['value']+1;
		borno_query("UPDATE $prefix_visit SET `value` = '$visit'  WHERE `post_id` =$id and type='visitpost'");
	}
	else if($count==0){
	
		borno_query("INSERT INTO $prefix_visit (`post_id`, `type`, `value`) VALUES ($id,  'visitpost', '1');");
	
	}
	else{
		borno_query("DELETE FROM $prefix_visit WHERE `post_id` = $id");
		borno_query("INSERT INTO $prefix_visit (`post_id`, `type`, `value`) VALUES ($id,  'visitpost', '1');");
	}
	}
	else{
		return false;
	}
}























/*
*
*
*	post_visit_count
*
*
*/
function post_visit_count($id){

	if(filter_var($id, FILTER_VALIDATE_INT)){

	global $prefix_visit;
	$query = borno_query("SELECT * FROM $prefix_visit WHERE post_id='$id'");
	$count = mysqli_num_rows($query);
	if($count==1){
		$row = mysqli_fetch_array($query);
		return $row['value'];
	}
	else{
	return false;
	}
	}
	else{
	
	return false;
	}


}