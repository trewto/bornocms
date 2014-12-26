<?php
/*
 * Manage Doc
 *
 *
*/
if(!user_can('manage_doc')){
echo('You can not access this page');
}
if(isset($_GET['msg'])){
	if($_GET['msg']=='newdoc'){
				echo  '<div class="alert alert-block alert-warning fade in sinnup-warning">
            <strong>Congratulation ! You crate a doc</strong></div>';
	}
}
$user_id = loginuserinfo('id');;

if (isset($_GET['page'])){
$page = $_GET['page'];}
else{
$page="";
}
// If the page wasn't set, lets set $page to number 1 for the first page
if($page == ""){
	
	$page = "1";
	
}

else{
	
	// If page is set, let's get it
	$page = $_GET['page'];
	
}
//$prefix = $dbconnect['DBPREFIX'];
	//$prefix_doc
	
#********************
//**************************
$by = 'all' ;
if(isset($_GET['by'])){
	$by = $_GET['by'] ;
	if($by=='publish'){
		$nav_user_sql = "WHERE doc_status='publish'";
		$newget = "&pages=managedoc&by=publish";
		}

	else if($by=='draft'){ // doc by draft
		$by = 'draft' ;
		$nav_user_sql = "WHERE doc_status!='publish'";
		$newget = "&pages=managedoc&by=draft";
	}
	else{
		$nav_user_sql = "WHERE doc_status='publish'";
		$newget = "&pages=managedoc&by=publish";
	}

}
	else{
			$by = 'publish' ;
			$nav_user_sql = "WHERE doc_status='publish'";
			$newget = "&pages=managedoc&by=publish";
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
 $sql = "SELECT * FROM $prefix_doc $nav_user_sql";
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
echo('<div class="alert alert-warning">No Content Found in your search keyword</div>');
}
echo ('<div class="alert alert-warning">There are no content in this page</div>');
//echo();
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




echo '<table class="table table-bordered"><tbody>';
?>
	<tr>			
		<td>id</td>
		<td>Edit</td>
		<td>Title</td>
		<td>Time</td>
		<td>Status</td>
		<td>Content</td>
	</tr>
<?php 
// It's time for getting our messages
 $sql = "SELECT * FROM $prefix_doc $nav_user_sql ORDER BY `id` DESC  $limit ";
$query = borno_query($sql); $user_post_count = mysqli_num_rows($query);



while($row = mysqli_fetch_array($query)){
		echo '<tr>';
		$doc_id = $row['id'];
		echo '<td>'.$doc_id.'</td>';
		echo '<td><a href="'.admin_url().'/?pages=doceditor&editdoc='.$row['id'].'">EDIT</a></td>'; // ?pages=doceditor&editdoc=2
		echo '<td>'.$row['title'].'</td>';
		echo '<td>'.$row['times'].'</td>';
		echo '<td>'.$row['doc_status'].'</td>'; 
		
			echo '<td>'.post_excerpt($row['content'],$doc_id,0).'
		<br> <a href="'.doc_link($doc_id).'" class="btn btn-info btn-mini">Read More</a>
		</td>';
		
		
		
		
		//	echo $row['content']."<br />";
		echo '</tr>';
	
}
echo '</tbody></table>';

echo '<hr>';
echo $page1.$page2.$page3.$page4;