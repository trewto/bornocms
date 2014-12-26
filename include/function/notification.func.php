<?php
/*
*	Notifcation Functions
*
*
*
*
*/



















/*
*
*
*	Adding a notification
*
*
*/
function add_notify($user_for,$post_for,$other_for,$type,$msg){
	//get the prefix commtent 
	 global $prefix_notify;
	$msg  = mysqli_escape($msg);
	$other_for  = mysqli_escape($other_for);
	$post_for  = mysqli_escape($post_for);
	$type  = mysqli_escape($type);
	//query
	borno_query("
	INSERT INTO $prefix_notify (`user_for`, `post_for`, `other_for`, `type`, `message`, `times`) VALUES ( '$user_for', '$post_for', '$other_for', '$type', '$msg', CURRENT_TIMESTAMP)");
}























/*
*
*
*
*
*
*/

function notify_delete($ref){
	global $prefix_notify;
	if($ref=='notify'){
		//get the user
		if(user_logged_in()){
		//user id
		$x_user= loginuserinfo('id');
		//post id
		$post = $_GET['p'];
		//query
		$x_query =borno_query("SELECT * FROM $prefix_notify WHERE user_for='$x_user' and post_for='$post' and type='commentnotify'");
		//count
			$x_count = mysqli_num_rows($x_query);
			if(!$x_count==0){
				//delete query
			borno_query("DELETE FROM $prefix_notify WHERE user_for='$x_user' and post_for='$post' and type='commentnotify'");
			}
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


function notify_user_count($notification_user){
	$noti = new notify($notification_user);
	return $noti->counter();

}