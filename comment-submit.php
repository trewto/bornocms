<?php 
/*
 *	Comment submit
 *	Submit comment progress , submit comment and
 * 	redirect to post
 *	
 *	Borno CMS
 *
 *
 */

	
	/*
	*	include the function file
	*/
	require('functions.php');
	require_once('include/function/load-plugin.php');


	/*
	*	Check http referer
	*/
	if(!isset($_SERVER['HTTP_REFERER'])){
		borno_die('Why are you trying this? You have invalid refer.'); //die
	}

	
	
	
	/*
	*
	*	if not isset $_POST[comment,content,post_id] than die()
	*
	*/
	 
	if(!isset($_POST['comment']) or !isset ($_POST['content']) or !isset($_POST['post_id']) or empty($_POST['content'])){
		borno_die('You can not submit a blank comment');//die
	}
	
	
	
	
	
	/*
	 *
	 *
	 *	if isset invalid post_number than die()
	 *	
	 *	
	 *	@see : http://bd1.php.net/manual/en/function.filter-var.php
	 */

	$int_options = array("options"=>array("min_range"=>1));//option of min range for that user not insert -1,-2... post number

	if(!filter_var($_POST['post_id'], FILTER_VALIDATE_INT, $int_options)){
		borno_die('Oh, the system think you have changed the post id.');//die
	}

	
	

	
	
	
	
	/*
	 *
	 *
	 *	check if the content exists in that id
	 *	is_exists_content()
	 */
	if(!is_exists_content($_POST['post_id'])){
		borno_die('No content exists on this id number. Invalid action.');//die
	}

	
	
	
	
	
	/*
	 *
	 *
	 *	make sure that comment is open on that post
	 *	get_the_post($post_id,$thefieldthatyouwanttoget) 
	 */
	if(!get_the_post($_POST['post_id'],'comment_permission')=='true'){
		borno_die('You can not comment here.');//die
	}
	
	
	
	
	
	/*
	 *
	 *	user_can(); //check user role
	 *	if user can not add comment than die();
	 *
	 *
	 *
	 *
	 */
	if(!user_can('add_comment')){
		borno_die('You can not add any comment');//die
	}

	
	/*
	*	Check big ammount comment
	*
	*/
	if(isset($_SESSION['cmntcnt']) and isset($_SESSION['cmnttme'])){
		if($_SESSION['cmntcnt']<10){
			$_SESSION['cmntcnt'] ++;
		}else{
			if((time()-$_SESSION['cmnttme'])>60){
				unset($_SESSION['cmnttme']);
				unset($_SESSION['cmntcnt']);
			}else{

			
				borno_die('You can do only ten comment in a minute.');
			}
		}
	}else{
		$_SESSION['cmntcnt'] = 1;
		$_SESSION['cmnttme'] = time();
	}
	/*
	 *
	 *
	 *	adding comment
	 *	@packge	: Borno CMS
	 *	add_comment($user_id,$post_id,$content,$approved)
	 */
	 
		/*
		 *
		 *	@variables
		 *
		 */
		 
		$approved='publish';//for this time approve is true
		$content =htmlspecialchars($_POST['content']);// content
		$post_id =$_POST['post_id'];//post id
		$user_id =loginuserinfo('id');//user id
		
		
		/*
		 *	check content is not empty
		 *
		 *
		 *
		 */
		 $c_content = trim($content);
		 if(empty($c_content)){
			borno_die("You can not add a blank comment");//die();
		 }
		 
		 /*
		 //currently disable , if need please enable it 
		 //it stop duplicate comment 
		 $query = borno_query("SELECT * FROM prefix_comment WHERE post_id=$post_id and content = '$content' and status='publish'");
		 if(mysqli_num_rows($query)!=0){
			borno_die('You can not do a duplicate comment');
		 }
		*/ 
		 
		 
		
		/*
		 *	add comment
		 *	add_comment()
		 */
		$add_c =add_comment($user_id,$post_id,$content,$approved);//add comment
		if($add_c){
			$c_id = $add_c;
		}
	

		
		/*
		*
		*
		*	Comment notification progress
		*
		*/
		comment_notification($post_id,$user_id,$content);
	
	
	
	header("Location:".the_post_link($post_id,false)."#comment-$c_id"); // redirect to post page
	
