<?php





function doc_dd_widget(){
		global $prefix_doc ; 
		$query = borno_query("SELECT id,title FROM $prefix_doc WHERE doc_status='publish'");

		
		$output ='<ul>';

		while($row=mysqli_fetch_array($query)){
			
			
			$output .= '<li><a href="'.doc_link($row['id']).'">'.$row['title'].'</a></li>';
			
		}
			if(get_the_option('contactfrom')==='true'){

				$output .= '<li><a href="'.doc_link('contact').'">Contact</a></li>';
				
			}
		
		
		$output .= '</ul>';
		
		$count = mysqli_num_rows($query);
		if($count==0){
			return 'No document available ';
		}
		echo  $output;


}














/*
*
*	Login widget
*
*
*
*/
function login_widget(){
$site_address = get_the_option('site_address');
	if(!user_logged_in()){
		echo "
		<form method='post' action='$site_address/sign-in.php' class='sign_in_widget'>
		<!--<label for='email'>Email</label><br>
		-->	<input type='text' placeholder='Email' name='email' id='email' class=' form-control'/><br>
			<!--<label for='password'>Password</label><br>-->	
			<input type='password' placeholder='password' name='password' id='password' class=' form-control'/><br>".'<input type="checkbox" name="remember" id="remember" class=""><span>Remember me</span><br>'."
			<input type='submit' name='submit' class='btn btn-success' value='Log in'/><br>
			
		";
		echo '';

		$siteUrl = 'http://';
		$siteUrl .= $_SERVER['HTTP_HOST'];
		$siteUrl .= $_SERVER['REQUEST_URI'];
		echo '<input type="hidden" name="back" value="'.$siteUrl.'"/>';
		echo '<br> <a class="" href="'.$site_address.'/sign-in.php?forget=true">Forget Password </a>';

		if(get_the_option('user_can_signup')==true){

echo ' <a class="" href="'.$site_address.'/sign-up.php">Register</a>';

}
	echo '</form>';
	}
	else{
	
		// if user logged in t hen show the form
	echo '<div class="loggedinwidget">';
	echo '<img class="loggedinavatar" src="'.get_gravatar(loginuserinfo('email') , 60).'"/>';
	echo '<p class="loggedinwidgettext">';
	echo display_name(loginuserinfo('id'));
	echo '<br><i>';
	echo site_count(loginuserinfo('id'),'user_total_post').' Post';
	echo '</i><br>';
	echo ' <a href="'.admin_url().'" class="">Admin</a> ';
	echo ' <a class="" href="';
	echo admin_url().'/?pages=changepassword">Change Password</a> ';
	echo '<i class="">'.login_back_url();
	echo '</i></p>';
	echo '</div>';
	
	}
}

































/*
*
*
*	Widget of lasted content
*
*
*/
function lasted_content($total){
	$start=0;
	$limit = "LIMIT $start, $total";
	// It's time for getting our messages
	global $prefix_contents;
	$sql = borno_query("SELECT * FROM $prefix_contents WHERE  post_status='publish' ORDER BY `id` DESC  $limit ");
	echo '<ul>';
	while($row = mysqli_fetch_array($sql)){
	echo	"<li>";
	echo 	the_post_link($row['id']);
	echo	"";
	echo	'<p class="widget_op">';
	echo	the_excerpt($row['content'],20);
	//echo 	'<a href="#">Read More</a>';
	echo	'</p>';
	echo 	'</li>';
	}
	echo '</ul>';
}




/*
*
*
*	Widget of lasted content
*
*
*/
function lasted_content_with_out_text($total=5){
	$start=0;
	$limit = "LIMIT $start, $total";
	// It's time for getting our messages
	global $prefix_contents;
	$sql = borno_query("SELECT * FROM $prefix_contents WHERE  post_status='publish' ORDER BY `id` DESC  $limit ");
	echo '<ul>';
	while($row = mysqli_fetch_array($sql)){
	echo	"<li>";
	echo 	the_post_link($row['id']);
	echo	"";
	echo 	'</li>';
	}
	echo '</ul>';
}














/*
*
*
*	lasted content list
*
*
*/
function lasted_content_list($total,$li=true){
	$start=0;
	$limit = "LIMIT $start, $total";
	// It's time for getting our messages
	global $prefix_contents;
	$sql = borno_query("SELECT * FROM $prefix_contents WHERE  post_status='publish' ORDER BY `id` DESC  $limit ");
	if($li==true){
		echo '<ul>';
		}
	
	while($row = mysqli_fetch_array($sql)){
		if($li==true){
			echo '<li>';
		}
	echo 	the_post_link($row['id']).'<br>';
	//echo	"</b>";
	//echo	'<p class="widget_op">';
	//echo	the_excerpt($row['content'],20);
	//echo 	'<a href="#">Read More</a>';
	//echo	'</p>';
		if($li==true){
			echo '</li>';
		}
	}
	if($li==true){
		echo '</ul>';
		}
}




















/*
*	
*
*	lasted comement widget
*
*
*/
/**widget comment*/


function lasted_comment($total){
	$start=0;
	$limit = "LIMIT $start, $total";
	// It's time for getting our messages
	global $prefix_comment;
	global $prefix_content;
	$sql = borno_query("SELECT $prefix_comment.status , $prefix_comment.post_id , $prefix_comment.id , $prefix_comment.status ,$prefix_comment.user_id ,$prefix_comment.content ,$prefix_content.post_status , $prefix_content.title FROM $prefix_comment,$prefix_content WHERE  $prefix_comment.status='publish' and $prefix_comment.post_id=$prefix_content.id and $prefix_content.post_status='publish' ORDER BY $prefix_comment.`id` DESC  $limit");
	echo '<ul>';
	while($row = mysqli_fetch_array($sql)){
		echo '<li>'.user_profile_link($row['user_id']).' Comment in  <a href="'.the_post_link($row['post_id'],false).'#comment-'.$row['id'].'">'.$row['title'].'</a>'; 
		echo '<p class="widget_op"><i>'.the_excerpt($row['content'],20).'</i></p></li>';

	}
	echo '</ul>';
}


































/*
*
*
*
*	popular post widget
*
*/
/* porpular*/
function popularpost($total){
global $prefix_visit;
global $prefix_content;
/*
select 925_contents.id, 925_contents.title, 925_contents.content, 925_contents.post_status, 925_visit.value
from 925_contents, 925_visit
where 925_visit.post_id = 925_contents.id
order by 925_visit.value desc
*/
	$start=0;
	$limit = "LIMIT $start, $total";
$sql = "select $prefix_content.id, $prefix_content.title, $prefix_content.content, $prefix_content.post_status, $prefix_visit.value
from $prefix_content, $prefix_visit
where $prefix_visit.post_id = $prefix_content.id 
and 
 $prefix_content.post_status = 'publish'
order by $prefix_visit.value desc $limit";
$query = borno_query($sql);


	echo '<ul>';
	while($row = mysqli_fetch_array($query)){
		echo '<li>';
		echo the_post_link($row['id']);;
		echo '<br><span class="widget_op">'.$row['value'].' Times-</span>'; 
		echo '<p class="widget_op">'.the_excerpt($row['content'],20).'</p></li>';

	}
	echo '</ul>';
}











function popularpost_without_text($total=5){
global $prefix_visit;
global $prefix_content;
/*
select 925_contents.id, 925_contents.title, 925_contents.content, 925_contents.post_status, 925_visit.value
from 925_contents, 925_visit
where 925_visit.post_id = 925_contents.id
order by 925_visit.value desc
*/
	$start=0;
	$limit = "LIMIT $start, $total";
$sql = "select $prefix_content.id, $prefix_content.title, $prefix_content.content, $prefix_content.post_status, $prefix_visit.value
from $prefix_content, $prefix_visit
where $prefix_visit.post_id = $prefix_content.id 
and 
 $prefix_content.post_status = 'publish'
order by $prefix_visit.value desc $limit";
$query = borno_query($sql);


	echo '<ul>';
	while($row = mysqli_fetch_array($query)){
		echo '<li>';
		echo the_post_link($row['id']);;
		echo '</li>';

	}
	echo '</ul>';
}














/*
*
*
*	popular post
*
*
*/

function popularpost_list($total,$list_allowed,$visit_display_allowed,$ul_class='',$li_class=''){
global $prefix_visit;
global $prefix_content;
/*
select 925_contents.id, 925_contents.title, 925_contents.content, 925_contents.post_status, 925_visit.value
from 925_contents, 925_visit
where 925_visit.post_id = 925_contents.id
order by 925_visit.value desc
*/
	$start=0;
	$limit = "LIMIT $start, $total";
$sql = "select $prefix_content.id, $prefix_content.title, $prefix_content.content, $prefix_content.post_status, $prefix_visit.value
from $prefix_content, $prefix_visit
where $prefix_visit.post_id = $prefix_content.id 
and 
 $prefix_content.post_status = 'publish'
order by $prefix_visit.value desc $limit";
$query = borno_query($sql);




if($list_allowed==true){
	echo '<ul class="'.$ul_class.'">';
	}
	while($row = mysqli_fetch_array($query)){
	if($list_allowed==true){
	echo '<li  class="'.$li_class.'">';
}	
		echo the_post_link($row['id']);;
		if($visit_display_allowed==true){
		
		echo '<br><span class="widget_op">'.$row['value'].' Times</span>';
		
		}

if($list_allowed==true){
	echo '</li>';
}		

	}
	echo '</ul>';
}



