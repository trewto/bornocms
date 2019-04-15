<?php
$user_id = loginuserinfo('id');;

if (isset($_GET['page'])){
		$page = $_GET['page'];
	}
else{
		$page = "1";
	}



//$prefix = $dbconnect['DBPREFIX'];
	//$prefix_contents
	
#********************
//**************************
$by = 'all' ;
if(isset($_GET['by'])){
	$by = $_GET['by'] ;
	if($by=='all'){
	
		if(user_can('edit_all_post')){

		//	$nav_user_sql = "WHERE post_status!='trash'";
			$nav_user_sql = "WHERE id!='0' and post_status!='trash' ";
			$newget = "&pages=managepost&by=all";
		}
		else{
		//	echo 'You can not access this page';
			$nav_user_sql = "WHERE user_id='$user_id' and post_status!='trash'";
			$newget = "&pages=managepost&by=user";
		}
	}
	else if($by=='userpending'){
		$nav_user_sql = "WHERE post_status='pending' and user_id='$user_id'";
		$newget = "&pages=managepost&by=userpending";
	}
	else if($by=='userdraft'){
		$nav_user_sql = "WHERE post_status='draft' and user_id='$user_id'";
		$newget = "&pages=managepost&by=userdraft";
	}
	else if($by=='user'){
	
		$nav_user_sql = "WHERE user_id='$user_id' and post_status!='trash'";
		$newget = "&pages=managepost&by=user";
	}
	else if($by=='trash'){
	
		$nav_user_sql = "WHERE post_status='trash'";
		$newget = "&pages=managepost&by=trash";
	}
	else if($by=='totalpending'){
		if(user_can('edit_all_post')){
			$nav_user_sql = "WHERE post_status='pending'";
			$newget = "&pages=managepost&by=totalpending";
		}
		else{
			echo 'You can not access this page';
			$nav_user_sql = "WHERE user_id='$user_id'";
			$newget = "&pages=managepost&by=user";
		}
	}
	else if($by=='totaldraft'){
			if(user_can('edit_all_post')){

		$nav_user_sql = "WHERE post_status='draft'";
		$newget = "&pages=managepost&by=totaldraft";
		}
		else{
			echo 'You can not access this page';
			$nav_user_sql = "WHERE user_id='$user_id'";
			$newget = "&pages=managepost&by=user";
		}
	}
	else{
			$by = 'user' ;
			$nav_user_sql = "WHERE user_id='$user_id'";
			$newget = "&pages=managepost&by=user";
	}
}
else {
	$by = 'user' ;
	$nav_user_sql = "WHERE user_id='$user_id' and post_status!='trash'";
	$newget = "&pages=managepost&by=user";
}


/*
*search
*
*/
if(isset($_GET['search']) && !empty($_GET['search'])){
//	$get_search=htmlentities($_GET['search']);
	$get_search=($_GET['search']);
		
		$add_nav_user_sql="and title LIKE'%".mysqli_escape($get_search)."%' or content LIKE'%".mysqli_escape($get_search)."%'";
		$newget=$newget."&search=".$get_search;
		if(!empty($nav_user_sql)){
			$nav_user_sql = $nav_user_sql.$add_nav_user_sql;
		}
		else{
			$nav_user_sql = "and title LIKE'%".mysqli_escape($get_search)."%' or content LIKE'%".mysqli_escape($get_search)."%'";
		}

}


#**************
	
	
// Now lets get all messages from your database
$sql = "SELECT * FROM $prefix_contents $nav_user_sql";
$query = borno_query($sql);

// Lets count all messages
$post_number = $num = mysqli_num_rows($query);


$int_options = array("options"=>array("min_range"=>1));

if(!filter_var($page, FILTER_VALIDATE_INT, $int_options)){
$page = $post_number+1;
}

// Lets set how many messages we want to display
//$per_page = "10";
$per_page = "10";
$limit_url= '';
if(isset($_GET['limit'])){
	if(filter_var($_GET['limit'], FILTER_VALIDATE_INT, $int_options)){
	$per_page = $_GET['limit'];
	$limit_url= '&limit='.$_GET['limit'];
	$newget = $newget.$limit_url;
	}
}
// Now we must calculate the last page
$last_page = ceil($num/$per_page);

if ($last_page<$page){

	if(isset($_GET['search']) && !empty($_GET['search'])){
		echo '';
		echo('<div class="alert alert-warning">No content found according to your keyword</div>');
	}
	
	echo ('<div class="alert alert-warning">There are no content in this page</div>');

}
// And set the first page
$first_page = "1";
// And lets display our messages
//while($row = mysqli_fetch_array($query) or echo(mysql_error())){

//echo '<br><br>';
// Here we are making the "First page" link
   $page1 = "<a class='firstpage btn btn-inverse btn-mini' href='".$page_number.$first_page.$newget."'>First page</a> ";

// If page is 1 then remove link from "Previous" word
if($page == $first_page){
	
 $page2 = "<span class='btn  disabled btn-mini'>Previous</span> ";
 //$page2 = " ";
	
}else{
	
	if(!isset($page)){
		
		  $page2 =  "<span  class='btn  disabled btn-mini' >Previous</span> ";
		  //$page2 =  " ";
		
	}else{
		
		// But if page is set and it's not 1.. Lets add link to previous word to take us back by one page
		$previous = $page-1;
		if ($last_page<$page){// use <= 
		$page2 =  "<span  class='btn  disabled btn-mini' >Previous</span> ";
		}
		else{
		 $page2 =  "<a class='btn btn-mini' href='".$page_number.$previous.$newget."'>Previous</a> ";
		}
	}
	
}

// If the page is last page.. lets remove "Next" link
if($page == $last_page){
	
	$page3 =  "<span class='btn  disabled btn-mini'>Next </span> ";	
	// $page3 =  " ";	
	
}else{
	
	// If page is not set or it is set and it's not the last page.. lets add link to this word so we can go to the next page
	if(!isset($page)){
		
		$next = $first_page+1;
		 $page3 =   "<a class='btn btn-mini' href='".$page_number.$next."'>Next</a> ";
		
	}else{
	
		$next = $page+1;
		if ($last_page<$page){
		$page3 =  "<span class='btn  disabled btn-mini'>Next </span> ";	
		}
		else{
		 // $page3 =  "<a class='btn' href='?page=".$next."'>Next</a> ";
		  $page3 =  "<a class='btn btn-mini' href='".$page_number.$next.$newget."'>Next</a> ";
		}
	}
	
}

// And now lets add the "Last page" link
 $page4 =  "<a class='btn btn-inverse btn-mini' href='".$page_number.$last_page.$newget."'>Last page</a>";

// Math.. It gets us the start number of message that will be displayed
$start = ($page-1)*$per_page;

// Now lets set the limit for our query
$limit = "LIMIT $start, $per_page";

/////count result
if(isset($_GET['search']) && !empty($_GET['search']) && !$post_number==0){
echo '<div class="alert alert-success">'.$post_number.' result found</div>';
}




echo '<table class="table table-bordered"><tbody>';
?>
	<tr>			
			<td>id</td>
		<td>Edit</td>
		<td>Title</td>
		<td>writer</td>
		<td>Time</td>
		<td>Status</td>
		<td>Content</td>
	</tr>
<?php 
// It's time for getting our messages
 $sql = "SELECT * FROM $prefix_contents $nav_user_sql ORDER BY `id` DESC  $limit ";
$query = borno_query($sql); $user_post_count = mysqli_num_rows($query);

?>

	<script type='text/javascript'>
		function confirm_to_del(){
			var myTextField = document.getElementById('appendedInputButtons');

			var answer= confirm("Are you sure to delete this ? By delete you can not restore it ! please be carefull");
			
			if(answer){
				
			}else{
				myTextField.focus();
				return false;
			}
		}
		
		
	
	
	</script> 

	<?php

	
/*
*
*	This is the main table content
*
*
*/
while($row = mysqli_fetch_array($query)){
		echo '<tr>';
		
		$post_id = $row['id'];
		
		echo '<td>'.$post_id.'</td>';//display content id 
		
		
		//checking content status
		if($row['post_status']=='trash'){
			echo '<td><a class="btn btn-danger" onclick="return confirm_to_del();" href="del.php?type=post&id='.$row['id'].'&CSRFToken='.loginuserinfo('active_key').'">Delete</a> <a class="btn btn-success" href="trash.php?restoretype=post&id='.$post_id .'">Restore</a></td>';
		}
		else{	
			echo '<td><a href="'.admin_url().'/?pages=editor&edit_id='.$row['id'].'">EDIT</a></td>';
		}
		
		
		//title
		$title = $row['title'];
		echo '<td><a href="'.the_post_link($row['id'],false).'">'.$title.'</a></td>';
		
		
		
		
		$user = display_name($row['user_id']);
		
		echo '<td>'.$user.'</td>';//display user name
		
		echo '<td>'.$row['times'].'</td>';//display the time of the content 
		
		echo '<td>'.$row['post_status'].'</td>';//display the content status
		
		
		
		//display the content excerpt
		echo '<td>'.post_excerpt($row['content'],$post_id,0).'</td>';

	
		echo '</tr>';
	
}
echo '</tbody></table>';

echo '<hr>';
echo $page1.$page2.$page3.$page4;