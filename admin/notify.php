<?php
/*
*
*	User notification
*	User notification will display here
*
*/

/* 	Delete notify */
if(isset($_GET['clear']) && $_GET['clear']=='true'){
	$user_id = loginuserinfo('id');
	borno_query("DELETE FROM prefix_notify WHERE user_for ={$user_id}");
	echo "<div class='alert alert-success'>Notification Cleared</div>";

}



/*
*
*notify view
*/

$notify = new notify(loginuserinfo('id'));

if(!$notify ->counter()){
	echo '<h2>You have no notification</h2>';
}
$displays =  $notify ->display();

foreach($displays as $display){
	$userpermalink = str_replace(loginuserinfo('username').'*','' ,user_profile_link(loginuserinfo('id').'*',false));
	$display[3] =  str_replace('userlink*/',$userpermalink,$display[3] );
	if($display[2] == 'commentnotify'){
		if($display[4]=='admin'){
		
			if(get_the_option('site_permalink')=='getstyle'){
				echo 'A new comment added in your post "<a href="'.the_post_link($display[1],$a=false).'&ref=notify">'.get_the_post($display[1],'title').'</a>"<br><i>"'.$display[3].'"</i><br>
				'.the_time($display[5],'h:m A -- d-m-y').'<hr>';
			}else{
				echo 'A new comment added in your post "<a href="'.the_post_link($display[1],$a=false).'?&ref=notify">'.get_the_post($display[1],'title').'</a>"<br><i>"'.$display[3].'"</i><br>
				'.the_time($display[5],'h:m A -- d-m-y').'<hr>';
			}
		}else{
			if(get_the_option('site_permalink')=='getstyle'){
			echo 'A new comment added in a post that you are comment..."<a href="'.the_post_link($display[1],$a=false).'&ref=notify">'.get_the_post($display[1],'title').'</a>"<br><i>"'.$display[3].'"</i><br>
			'.the_time($display[5],'h:m A -- d-m-y').'<hr>';
			}
			else{
				echo 'A new comment added in a post that you are comment..."<a href="'.the_post_link($display[1],$a=false).'?&ref=notify">'.get_the_post($display[1],'title').'</a>"<br><i>"'.$display[3].'"</i><br>
			'.the_time($display[5],'h:m A -- d-m-y').'<hr>';
			}
		}
	}
}


echo "<a href='?pages=notify&clear=true' class='btn btn-danger'>Clear All</a>";