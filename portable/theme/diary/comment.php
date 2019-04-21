<?php 
/*
*	Comment . php 
*	The file is use for diplay comment and comment form
*	Arnob Protim Roy
*
*
*/

/*
*
*	li_comment($post_id);
* 	You can get the all comment list of any post .
*	
*
*
*
*/
li_comment($post_id);

/*
*
*
*
$query = comment_query(3);
while($row = mysql_fetch_array($query)){
echo $row['id'].'<br>';
}
*
*
*/

/*
*
*
*
*
# add_comment(1,1,'test comment',1);
# add_comment($user_id,$post_id,$content,$approved)
# You can add comment by this function . 
*
*
*
*
*/

/*
*
*
*
*	Check comment permission  of any post
*	check user login or not
*	check if user can add comment
*	display the comment form
*
*

/*
*
* comment_form();
*	comment form
*

if(get_the_post($_GET['p'],'comment_permission')=='true'){

	if(user_logged_in()){
		if(user_can('add_comment')){

			comment_form();
		}
		else{
			echo 'You cant not add comment';
		}
	}
	else{
		echo 'You must be logged in to add comment in this content';
	}	
}
else{
	echo 'You can not add comment in this post';
}
*
*
*
*
*
*
*
*/
if(get_the_post($_GET['p'],'comment_permission')=='true'){

	if(user_logged_in()){
		if(user_can('add_comment')){

			comment_form();
		}
		else{
			//echo 'You cant not add comment';
		}
	}
	else{
		//echo 'You must be logged in to add comment in this content';
	}	
}
else{
	//echo 'You can not add comment in this post';
}