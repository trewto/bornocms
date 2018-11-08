<?php
/*
*
*	This is the comment function
*	@author: Arnob Protim Roy
*
*
*/








/*
*
*	This is the comment sql ;
*
*
*
*/
function comment_sql($post_id){

	global $prefix_comment; 


	$sql = ("SELECT * FROM $prefix_comment WHERE status='publish' and post_id=$post_id");

	return $sql;
	
}










/*
*
*
*	this is the comment query
*
*
*/
function comment_query($id){
	return borno_query(comment_sql($id));
}













/*
*
*
*	This is comment fetch array
*
*/
function comment_fetch_array($id){
	$array = mysqli_fetch_array(comment_sql($id));
	return $array;
}




/*
 *
 * Add a new comment by this function
 *
 */
function add_comment($user_id,$post_id,$content,$approved){
	
	$content = mysqli_escape($content);

	// info 
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$user_ip = $_SERVER['REMOTE_ADDR'];
	
	// get the prefix commtent 
	global $prefix_comment;
	
	//query
	borno_query("
	INSERT INTO $prefix_comment (`user_id`, `post_id`, `content`, `status`, `browser_info`, `ip`)
	VALUES 
	('$user_id', '$post_id', '$content', '$approved', '$user_agent', '$user_ip')
	");
	
	$id = borno_query("SELECT * FROM prefix_comment ORDER BY `times` DESC");
	$id = mysqli_fetch_array($id);
	return $id['id'];
}










/*
*
*
*	This is the comment form
*
*
*/

 
function comment_form(){
	
	if( user_logged_in() && user_can('add_comment') &&  get_the_post($_GET['p'],'comment_permission')=='true'){
	global $post_id;
	$sitename = get_the_option('site_address');//site-address
	echo '<form method="POST" class="commentarea" action="'.$sitename.'/comment-submit.php">';
	echo '<input type="hidden" name="post_id" value="'.$post_id.'" />';
	echo '<label for="c-t-area" class="com-l">Comment Here</label><br>';
	echo '<textarea name="content" id="c-t-area" class="form-control c-t-area" ></textarea><br>';
	echo '<input type="submit" value="Comment" name="comment" class="btn btn-success"/>';
	echo '</form>';
	
	}
}




/*
 *
 * display the comment by the post id
 *
 */
function li_comment($post_id,$avatar=true,$span_ray = true,$data=array()){
$post_user =  the_post_user( "id" , $post_id);
	$class_id = array(
						"ul_class" => "comment",
						"li_class" => "comment_li",
						"avatar_class" => "img-polaroid avatar"
				
				);

	
	foreach($data as $n=> $value){
		$class_id[$n] = $value ; 
	}
	








	$int_options = array("options"=>array("min_range"=>1));

if(filter_var($post_id, FILTER_VALIDATE_INT, $int_options)){

		//get all comment in this post from database
		global $prefix_comment;
		$sql = "SELECT * FROM $prefix_comment WHERE post_id='$post_id' and status='publish' ORDER BY `times` ";//sql
		$query = borno_query($sql); //query
		$total_comment =mysqli_num_rows($query);//total comment count
	//	echo '<div class="comment_count">'.$total_comment.' Comment Found</div>';
		

		echo '<ul class="'.$class_id['ul_class'].'" id="comment-display-'.$post_id.'">';
		//while
		while($row = mysqli_fetch_array($query)){
			$user = the_user($row['user_id'] , 'name') ; //name
			$username = the_user($row['user_id'] , 'username') ;//username
			$email = the_user($row['user_id'] , 'email') ;//username
			$site_address =get_the_option('site_address');//siteaddress
			if($user =='' or $user==' '){
				$name = $username;
			}
			else{
				$name = $user;
			}
			global $url_profile;
			global $post_GET;
			echo '<li class="'.$class_id['li_class'].'" id="comment-'.$row['id'].'">';
			echo '<div class="comment-data">';
			if($avatar){
			echo '<img class="'.$class_id['avatar_class'].'" src="'.get_gravatar( $email, 60).'" />';
			}
			
			if($span_ray) {
				echo '<div class="ray"><span class="arrow"></span><span class="arrows"></span></div>';
			}
			echo '<div class="comment-content">';
			if($post_user==$row['user_id']){
				$nclas = "admin_author";
			}else{
				$nclas = "guest_author";
			}
				echo '<a href="'.$site_address.$url_profile.$username.'" class="label label-warning '.$nclas.'">'.$name.'</a> ';
			
			//echo '<a class="comment-timex label label-warningx" href="'.$site_address.$post_GET.$post_id.'/#comment-'.$row['id'].'">';
			echo '<a class="comment-timex label label-warningx" href="'.the_post_link($row['post_id'],false).'#comment-'.$row['id'].'">';
			// echo the post h:i:A
			echo date("h:i A", strtotime($row['times'].get_the_option('timelplus')." hour")).'  at  ';
			
			//echo the post d-m-y
			echo date("d-m-y", strtotime($row['times'].get_the_option('timelplus')." hour"));
			echo '</a>';
			echo '<br>';
			echo nl2br($row['content']);
			echo '</div>';
			
			echo '</div>';
			echo '</li>';
		}
		echo '</ul>';
	}
}





/*
*	
*	Check the comment exists or not by id
*
*
*
*/
function is_exists_comment($comment_id){
	if(filter_var($comment_id, FILTER_VALIDATE_INT)){

		global $prefix_comment;
		$query = borno_query("SELECT * FROM $prefix_comment WHERE id='$comment_id'");
		$count = mysqli_num_rows($query);
		if($count==1){
			return true;
		}
		else{
			return false;
		}
	}
	else{
	return false;
	}	
}





/*
 *
 * get comment by id
 *
 */
function get_the_comment($comment_id,$data){
		if(filter_var($comment_id, FILTER_VALIDATE_INT)){

		global $prefix_comment;
		$query = borno_query("SELECT * FROM $prefix_comment WHERE id='$comment_id'");
		$count = mysqli_num_rows($query);
		if($count==1){
			$row = mysqli_fetch_array($query);
			return $row[$data];
		}
		else{
			return false;
		}
	}
	else{
	return false;
	}	
}





/*
 *
 *	update comment. This will help to update comment
 *
 *
 */
 
function update_comment($field,$value,$id){
	global $prefix_comment;
	$value = mysqli_escape($value);
	borno_query("UPDATE $prefix_comment SET `$field`='$value' WHERE id= '$id' ");
}







/*
 * This will Count the comment in the post
 */
function count_the_post_comment($post_id){
	global $prefix_comment;
	$query  = borno_query("SELECT * FROM $prefix_comment WHERE post_id ='$post_id' and status='publish'");
	return mysqli_num_rows($query);

}