<?php
/*
*
*	This is the file of permalink function 
*
*/

function link_type(){

	return get_the_option("site_permalink");
}


function is_exists_cpermalink($cp){

	$query = borno_query("SELECT * FROM prefix_cpermalink WHERE permalink='$cp'");
	
	return mysqli_num_rows($query);
}


function content_permalink($id){
	$query = borno_query("SELECT * FROM prefix_cpermalink WHERE post_id='$id'");
	
	$row =  mysqli_fetch_array($query);

	return $row['permalink'];
}

function permalink_to_post_id($permalink){
	$query = borno_query("SELECT * FROM prefix_cpermalink WHERE permalink='$permalink'");
	
	$row =  mysqli_fetch_array($query);

	return $row['post_id'];

}







function is_exists_dpermalink($cp){

	$query = borno_query("SELECT * FROM prefix_dpermalink WHERE permalink='$cp'");
	
	return mysqli_num_rows($query);
}


function doc_permalink($id){
	$query = borno_query("SELECT * FROM prefix_dpermalink WHERE doc_id='$id'");
	
	$row =  mysqli_fetch_array($query);

	return $row['permalink'];
}

function permalink_to_doc_id($permalink){
	$query = borno_query("SELECT * FROM prefix_dpermalink WHERE permalink='$permalink'");
	
	$row =  mysqli_fetch_array($query);

	return is_null($row['doc_id']) ?  0 : $row['doc_id'];

}









function is_exists_catpermalink($cp){

	$query = borno_query("SELECT * FROM prefix_catpermalink WHERE permalink='$cp'");
	
	return mysqli_num_rows($query);
}


function cat_permalink($id){
	$query = borno_query("SELECT * FROM prefix_catpermalink WHERE cat_id='$id'");
	
	$row =  mysqli_fetch_array($query);

	return $row['permalink'];
}

function permalink_to_cat_id($permalink){
	$query = borno_query("SELECT * FROM prefix_catpermalink WHERE permalink='$permalink'");
	
	$row =  mysqli_fetch_array($query);

	return $row['cat_id'];

}












