<?php
if(isset($_GET['coming'])){
	if($_GET['coming']=='newpost'){
	echo  '<div class="alert alert-block alert-success fade in sinnup-warning">
            <strong>Congratulation! You have written a new article.</strong></div>';
	}
}
$user_id = loginuserinfo('id');;

$prefix = $dbconnect['DBPREFIX'];
$prefix_contents = $prefix.'contents';
// Now lets get all messages from your database
$sql = "SELECT * FROM $prefix_contents WHERE user_id='$user_id' and post_status!='trash'";
$query = borno_query($sql);
// Lets count all messages
$post_number = $num = mysqli_num_rows($query);	

//total post
//$sql = "SELECT * FROM $prefix_contents WHERE post_status!='trash'";
$sql = "SELECT * FROM $prefix_contents WHERE user_id!='0'";
$query = borno_query($sql);
$total_post_number  = mysqli_num_rows($query);

//total pending post
$sql = "SELECT * FROM $prefix_contents WHERE post_status='pending'";
$query = borno_query($sql);
$total_pending_number  = mysqli_num_rows($query);

//total pending post by user
$sql = "SELECT * FROM $prefix_contents WHERE post_status='pending' and user_id='$user_id'";
$query = borno_query($sql);
$total_pending_number_by_user  = mysqli_num_rows($query);

////total draft post
$sql = "SELECT * FROM $prefix_contents WHERE post_status='draft'";
$query = borno_query($sql);
$total_draft_number  = mysqli_num_rows($query);

	
//total draft post by user	

$sql = "SELECT * FROM $prefix_contents WHERE post_status='draft' and user_id='$user_id'";
$query = borno_query($sql);
$total_draft_number_by_user  = mysqli_num_rows($query);

//total trash post
$sql = "SELECT * FROM $prefix_contents WHERE post_status='trash'";
$query = borno_query($sql);
$total_trash  = mysqli_num_rows($query);
?>


<?php
/*
*	Messages
*
*/
	if(isset($_GET['msg'])){
		switch ($_GET['msg']){
		
		
			case 'restore':
				echo "<div class='alert alert-success'>Content successfully restored</div>";
			
			break;
			case 'trash':
				echo "<div class='alert alert-success'>Content successfully trashed</div>";
			
			break;
			case 'delete':
				echo "<div class='alert alert-success'>Content successfully deleted</div>";
			
			break;
		

			
		
		
		}
	
	
	}
?>

     <form method="get" action="<?php echo get_the_option('site_address');?>/admin/">
	    <div class="input-append">
    <input name="pages" value="managepost" type="hidden">
    <input name="by" value="<?php 
	if(isset($_GET['by'])){
		echo $_GET['by'];
	}
	else{
	echo 'user';
	}
	?>" type="hidden">
    <input class="span3" name="search"  placeholder="keyword" id="appendedInputButtons" value="<?php if(isset($_GET['search'])){echo htmlspecialchars($_GET['search']);}?>" type="text">
   <!-- <button class="btn" type="submit">Search!</button> -->
    </div>

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
		
//loginuserinfo('name');
//echo'<a class="label label-success" href="?pages=managepost&by=all">ALL</a> ';
echo'<a class="label label-success" href="?pages=managepost&by=user">By You '.$post_number.'</a> ';
echo'<a class="label label-success" href="?pages=managepost&by=userpending">Pending By You '.$total_pending_number_by_user.'</a> ';
echo'<a class="label label-success" href="?pages=managepost&by=userdraft">Draft By You '.$total_draft_number_by_user.'</a> ';
if(user_can('edit_all_post')){
echo'<a class="label label-success" href="?pages=managepost&by=all">Total '.$total_post_number.'</a> ';
echo'<a class="label label-success" href="?pages=managepost&by=totalpending">Total Pending '.$total_pending_number.'</a> ';
echo'<a class="label label-success" href="?pages=managepost&by=totaldraft">Total draft '.$total_draft_number.'</a> ';

echo'<a class="label label-success" href="?pages=managepost&by=trash">Total Trash '.$total_trash.'</a> ';
}
echo "<br><br>";
include('manage-post-nav.php');//post nav . post that made by user