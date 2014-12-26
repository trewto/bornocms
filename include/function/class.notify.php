<?php

class notify{

	/*
	*	user id 
	*/
	private $user_id ;
	
	/*
	*	Staring the class , get the user id
	*/
	public function __construct($user){
	
        $this->user_id = $user;
		
    }
	
	
	/*
	*	View the notification
	*/
	public function display(){
		$user = $this -> user_id;
		$sql = "SELECT * FROM prefix_notify WHERE user_for = $user order by times desc ";
		$query = borno_query($sql);
		$output = array();
		while(	$row	= mysqli_fetch_array($query)	){
			if(is_exists_content($row['post_for'])){
				$output[]	= array($row['user_for'],$row['post_for'],$row['type'],$row['message'],$row['other_for'],$row['times']) ;
			}
		}
		return $output;
	
	}
	
	/*
	*	count the user id 
	*/
	public function counter(){
	
		return count($this->display());
	}
	

}

//$notify = new notify(1);

//var_dump($notify->display());

//echo $notify->counter();






















//var_dump($_GET);
function comment_notification($post_id,$current_commenter,$content){

	if(strlen($content)>=20){
		$msg =	substr($content,0,20).'....'.' [by <a href="userlink*/'.the_user($current_commenter,'username').'">'.display_name($current_commenter).'</a>]';
	}else{
		$msg = $content.' [by <a href="userlink*/'.the_user($current_commenter,'username').'">'.display_name($current_commenter).'</a>]';
	}

	borno_query("DELETE FROM prefix_notify WHERE post_for=$post_id");
	
	$query  = borno_query("SELECT * FROM prefix_notify WHERE post_for=$post_id");
	$num 	= mysqli_num_rows($query);
	
	//adding a comment to the post user
		$post_user = get_the_post($post_id,'user_id');
		//deleting the previous notification
		//borno_query("DELETE FROM prefix_notify WHERE post_for=$post_id and user_for=$post_user");
		//ading
		if($current_commenter != $post_user){
			add_notify($post_user,$post_id,'admin','commentnotify',$msg);
		}
	//deleting the all notification of this post 
		borno_query("DELETE FROM prefix_notify WHERE post_for=$post_id and user_id!=$post_user");
	
	//adding comment to other post commenter
		$other_commenter_query  =	borno_query("select user_id, count(user_id) as c from prefix_comment WHERE post_id= $post_id and (user_id!=$current_commenter or user_id!= $post_user)group by user_id order by times asc");
		$comment_added = array();
		while($row = mysqli_fetch_array($other_commenter_query)){
			if($row['user_id']!=$current_commenter and $row['user_id']!=$post_user){
				if(!in_array($row['user_id'],$comment_added)){
					add_notify($row['user_id'],$post_id,'commenter','commentnotify',$msg);
					$comment_addedd[] = $row['user_id'];
				}
				
			}
		}
	
}

