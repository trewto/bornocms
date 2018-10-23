<?php
/*
*	The nav of user
*
*/

// If the page wasn't set, lets set $page to number 1 for the first page
if (isset($_GET['page'])){
	$page = $_GET['page'];}//page id
else{
	$page = "1";//page id
}


//get the table id 
$prefix = $dbconnect['DBPREFIX'];
$prefix_users = $prefix.'users';//user table
	

	
$viewtype = 'all' ;//user view type , default all
//view type
if(isset($_GET['viewtype'])){
	$viewtype = $_GET['viewtype'] ;
	if($viewtype=='admin'){
		$nav_user_sql = "WHERE level='1'";
		$newget = "&pages=manageuser&viewtype=admin";
	}
	else if($viewtype=='disble'){
		$nav_user_sql = "WHERE account_active ='0'";
		$newget = "&pages=manageuser&viewtype=disble";
	}
	else if($viewtype=='enable'){
		$nav_user_sql = "WHERE account_active ='1'";
		$newget = "&pages=manageuser&viewtype=enable";
	}
	else if($viewtype=='leveltwo'){
		$nav_user_sql = "WHERE level='2'";
		$newget = "&pages=manageuser&viewtype=leveltwo";
	}else if($viewtype=='otherlevel'){
		$nav_user_sql = "WHERE level !='0' and level !='1' and level !='2' and level !='3'";
		$newget = "&pages=manageuser&viewtype=otherlevel";
	}
	else if($viewtype=='levelzero'){
		$nav_user_sql = "WHERE level='3'";
		$newget = "&pages=manageuser&viewtype=levelzero";
	}
	else{
		$nav_user_sql = "";
		$newget = "&pages=manageuser";
	}
}
else {
	$viewtype = 'all' ;
	$nav_user_sql = "";
	$newget = "&pages=manageuser";
}



/*
*	Search Nav
*
*/
if(isset($_GET['search']) && !empty($_GET['search'])){

		$get_search=($_GET['search']);//search keyword
		
		//sql
		$add_nav_user_sql="and email LIKE'%".mysqli_escape($get_search)."%' or username LIKE'%".mysqli_escape($get_search)."%' or name LIKE'%".mysqli_escape($get_search)."%'";
		$newget=$newget."&search=".$get_search;
		
		//main sql
		if(!empty($nav_user_sql)){
			$nav_user_sql = $nav_user_sql.$add_nav_user_sql;
		}
		else{
			$nav_user_sql = "WHERE email LIKE'%".mysqli_escape($get_search)."%' or username LIKE'%".mysqli_escape($get_search)."%' or name LIKE'%".mysqli_escape($get_search)."%'";
		}

}


#**************
	
	
// Now lets get all messages from your database
$sql = "SELECT * FROM $prefix_users $nav_user_sql";
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
echo('<div class="alert alert-warning">No user is found in according to keyword</div>');
}
echo ('<div class="alert alert-warning">There is no content in this page</div>');

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
echo '<div class="alert alert-success">'.$post_number.' Result found</div>';
}


/*
*	The table and map
*/

echo '<table class="table table-bordered"><tbody>';

if($post_number){
?>
	<tr>			
		<td>ID</td>
		<td>Edit</td>
		<td>Username</td>
		<td>Email</td>
		<td>Name</td>
		<td>Level</td>
	</tr>
<?php 
}
// It's time for getting our messages
 $sql = "SELECT * FROM $prefix_users $nav_user_sql ORDER BY `id` DESC  $limit ";
$query = borno_query($sql); $user_post_count = mysqli_num_rows($query);



while($row = mysqli_fetch_array($query)){
		echo '<tr>';
		echo '<td>'.$row['id'].'</td>';
		echo '<td> <a href="?pages=edituser&edituser='.$row['id'].'">Edit User</a></td>';
		echo '<td>'.$row['username'].'</td>';
		echo '<td>'.$row['email'].'</td>';
		echo '<td>'.$row['name'].'</td>';
		echo '<td>'.$row['level'].'</td>';
		echo '<tr>';
	
}
echo '</tbody></table>';

echo '<hr>';
echo $page1.$page2.$page3.$page4;