<?php
	/****************
	* @Lorem Ipsum
	* @manage comment
	*****************
	*********************/

	
/*
*	Messages
*
*/
	if(isset($_GET['msg'])){
		switch ($_GET['msg']){
		
		
			case 'restore':
				echo "<div class='alert alert-success'>Comment Successfully Restore</div>";
			
			break;
			case 'trash':
				echo "<div class='alert alert-success'>Comment Successfully Trash</div>";
			
			break;
			case 'delete':
				echo "<div class='alert alert-success'>Comment Successfully DELETED</div>";
			break;
		

			
		
		
		}
	
	
	}
?>
<!--form-->
    <form method="get" action="<?php echo get_the_option('site_address');?>/admin/">
	       <input name="pages" value="manage-comment" type="hidden">
			<?php 
			if(isset($_GET['viewtype'])){
			
			echo '<input name="viewtype" value="'.htmlentities(($_GET['viewtype'])).'" type="hidden">';
			}
			
			?>

	   <div class="input-append">
    <input class="span2 hidden-phone" name="limit"  placeholder="keyword" id="" value="<?php 
	
	if(isset($_GET['limit'])){
			if(filter_var($_GET['limit'], FILTER_VALIDATE_INT)){
				echo $_GET['limit'];
			}
			else{
			echo '10';
			}
	}
	else{
			echo '10';
	}
	?>" type="text">
		<button class="btn" type="submit">Submit!</button>
    </div>
	</form>
<?php
#############link
$user_id = loginuserinfo('id');
//$thesql = borno_query("SELECT * FROM $prefix_comment WHERE     $prefix_comment.status='publish' and $prefix_comment.user_id ='$user_id'");
$thesql =  borno_query("SELECT $prefix_comment.status , $prefix_comment.post_id , $prefix_comment.id , $prefix_comment.status ,$prefix_comment.user_id ,$prefix_comment.content ,$prefix_content.post_status  FROM $prefix_comment,$prefix_content WHERE  $prefix_comment.status='publish' and $prefix_comment.post_id=$prefix_content.id and $prefix_content.post_status='publish' and $prefix_comment.user_id='$user_id'");
$count  = mysqli_num_rows($thesql);
echo '<a href="?pages=manage-comment&viewtype=mycomment"><span class="label label-success">You give '.$count.' Comment</span></a> ';

if(user_can('restore_comment') or  user_can('delete_comment')){

//$thesql = borno_query("SELECT * FROM $prefix_comment WHERE     $prefix_comment.user_id ='$user_id' and $prefix_comment.status='trash'");
$thesql = borno_query("SELECT $prefix_comment.status , $prefix_comment.post_id , $prefix_comment.id , $prefix_comment.status ,$prefix_comment.user_id ,$prefix_comment.content ,$prefix_content.post_status  FROM $prefix_comment,$prefix_content WHERE  $prefix_comment.status='trash' and $prefix_comment.post_id=$prefix_content.id and $prefix_content.post_status='publish' and $prefix_comment.user_id='$user_id'");
$count  = mysqli_num_rows($thesql);
echo ' <a href="?pages=manage-comment&viewtype=mytrash"><span class="label label-danger">You have '.$count.' trash</span></a>';
}
if(user_can('restore_comment') or  user_can('delete_comment')){

#############link
//$thesql = borno_query("SELECT * FROM $prefix_comment WHERE     $prefix_comment.status='publish'");
$thesql = borno_query("SELECT $prefix_comment.status , $prefix_comment.post_id , $prefix_comment.id , $prefix_comment.status ,$prefix_comment.user_id ,$prefix_comment.content ,$prefix_content.post_status  FROM $prefix_comment,$prefix_content WHERE  $prefix_comment.status='publish' and $prefix_comment.post_id=$prefix_content.id and $prefix_content.post_status='publish'");
$count  = mysqli_num_rows($thesql);
echo ' <a href="?pages=manage-comment&viewtype=allcomment"><span class="label label-success">All : '.$count.' Comment</span></a>';



//$thesql = borno_query("SELECT * FROM $prefix_comment WHERE     $prefix_comment.status='trash'");
$thesql = borno_query("SELECT $prefix_comment.status , $prefix_comment.post_id , $prefix_comment.id , $prefix_comment.status ,$prefix_comment.user_id ,$prefix_comment.content ,$prefix_content.post_status  FROM $prefix_comment,$prefix_content WHERE  $prefix_comment.status='trash' and $prefix_comment.post_id=$prefix_content.id and $prefix_content.post_status='publish'");
$count  = mysqli_num_rows($thesql);
echo ' <a href="?pages=manage-comment&viewtype=alltrash"><span class="label label-danger">Total: '.$count.' trash</span></a>';

}
echo '<br>';
###############user have -_- comment
$user_id = loginuserinfo('id');
$query	 = borno_query("SELECT $prefix_comment.status , $prefix_comment.post_id , $prefix_comment.id , $prefix_comment.status ,$prefix_comment.user_id ,$prefix_comment.content ,$prefix_content.post_status  FROM $prefix_comment,$prefix_content WHERE  $prefix_comment.post_id=$prefix_content.id and $prefix_content.post_status='publish' and $prefix_comment.user_id='$user_id'");
$user_comment_count= mysqli_num_rows($query);
if($user_comment_count==0){
	//die('No comment Found');
}
if(!$user_comment_count==0){
	include('comment-pagenav.php');
}
