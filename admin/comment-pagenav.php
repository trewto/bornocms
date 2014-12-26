<?php
/****
	*@Lorem Ipsum
	*
	*  
****/

?>
<script>
function a(){
	var b =confirm('Are You want to trash this comment ?');
	if(b){
	return ;
	}
	else{
	return false;
	}
}
</script>
<?php
//1st step
if (isset($_GET['page'])){ // if isset page number
	$page = $_GET['page']; //than get the post number
}
else{//if not isset page number 
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

$int_options = array("options"=>array("min_range"=>1));

if(!filter_var($page, FILTER_VALIDATE_INT, $int_options)){
$page = $post_number+1;
}


//2nd step
//current user info
$user_id =loginuserinfo('id');	
//check the view type
if(isset($_GET['viewtype'])){
	$viewtype=$_GET['viewtype'];
	if($_GET['viewtype']=='allcomment'){
		$thesql="WHERE $prefix_comment.status='publish' and $prefix_comment.post_id=$prefix_content.id and $prefix_content.post_status='publish'";
		$newget = "&pages=manage-comment&viewtype=allcomment";

	}
	else if($_GET['viewtype']=='alltrash'){
		$thesql="WHERE $prefix_comment.status='trash'  and $prefix_comment.post_id=$prefix_content.id and $prefix_content.post_status='publish'";
		$newget = "&pages=manage-comment&viewtype=alltrash";

	}
	else if($_GET['viewtype']=='mytrash'){
		$viewtype='mytrash';
		$thesql = "WHERE $prefix_comment.status='trash'  and $prefix_comment.user_id ='$user_id' and $prefix_comment.post_id=$prefix_content.id and $prefix_content.post_status='publish'";
		$newget = "&pages=manage-comment&viewtype=mytrash";

	}
	else{
		$viewtype='mycomment';
		$thesql = "WHERE $prefix_comment.status='publish'  and $prefix_comment.user_id ='$user_id' and $prefix_comment.post_id=$prefix_content.id and $prefix_content.post_status='publish'";
		$newget = "&pages=manage-comment&viewtype=mycomment";

	}

}
else{
	$viewtype='mycomment';
	$thesql = "WHERE $prefix_comment.status='publish' and $prefix_comment.user_id ='$user_id' and $prefix_comment.post_id=$prefix_content.id and $prefix_content.post_status='publish'";
	$newget = "&pages=manage-comment&viewtype=mycomment";


}
//////////////////
/*
SELECT $prefix_comment.status , $prefix_comment.post_id , $prefix_comment.id , $prefix_comment.status ,$prefix_comment.user_id ,$prefix_comment.content ,$prefix_content.post_status  FROM $prefix_comment,$prefix_content WHERE  $prefix_comment.status='publish' and $prefix_comment.post_id=$prefix_content.id and $prefix_content.post_status='publish' and $prefix_comment.user_id='$user_id'

*/
//3rd step
  $sql = "SELECT * FROM $prefix_comment,$prefix_content ".$thesql;
 $query = borno_query($sql);
 $count_post = mysqli_num_rows($query);
if($count_post==0){
//echo ('No content Found');
}
//4th step 
if(isset($_GET['limit'])){
			if(filter_var($_GET['limit'], FILTER_VALIDATE_INT)){
				$per_page = $_GET['limit'];

			}
			else{
			$per_page = 5;

			}
	}
	else{
			$per_page = 5;

	}
	
$limit_url= '';
$last_page = ceil($count_post/$per_page);

//limit url
$limit_url= '';
if(isset($_GET['limit'])){
	if(filter_var($_GET['limit'], FILTER_VALIDATE_INT, $int_options)){
	$per_page = $_GET['limit'];
	$limit_url= '&limit='.$_GET['limit'];
	$newget = $newget.$limit_url;
	}
}

// And set the first page
$first_page = "1";
// And lets display our messages
//while($row = mysqli_fetch_array($query) or die(mysql_error())){

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

 		if ($last_page<$page){
	//	echo ('No Content Found');
		}

 
// Math.. It gets us the start number of message that will be displayed
$start = ($page-1)*$per_page;

// Now lets set the limit for our query
$limit = "LIMIT $start, $per_page";

/////count result
if(isset($_GET['search']) && !empty($_GET['search']) && !$post_number==0){
echo '<br>'.$post_number.' Result found';
}



echo '<br><br><table class="table table-bordered"><tbody>';
?>
	<tr>			
		<td>ID</td>
		<td>By</td>
		<td>Comment</td>
		<td>Time</td>
		<td>Trash</td>

	</tr>
<?php 
// It's time for getting our messages
$sql = "SELECT $prefix_comment.id , $prefix_comment.user_id , $prefix_comment.post_id , $prefix_comment.content , $prefix_comment.status , $prefix_comment.times  FROM $prefix_comment , $prefix_content $thesql ORDER BY $prefix_comment.times DESC  $limit ";
$query = borno_query($sql); $user_post_count = mysqli_num_rows($query);



while($row = mysqli_fetch_array($query)){
		echo '<tr>';
		echo '<td>'.$row['id'].'</td>';
		echo '<td>';
			$user = the_user($row['user_id'] , 'name') ; //name
			$username = the_user($row['user_id'] , 'username') ;//username
			$email = the_user($row['user_id'] , 'email') ;//username
			$site_address =get_the_option('site_address');//siteaddress
			
		echo user_profile_link($row['user_id'],true).'<br>' ;
		echo $email;
		echo '</td>';
		//$url =$row['post_id'].'#comment-'.$row['id'];
		//echo '<td>'.post_excerpt($row['content'],$url,0);
		echo '<td>'.$row['content'];
		echo "<br><a  target='_blank' href='".the_post_link($row['post_id'],false).'#comment-'.$row['id']."' class='btn btn-info btn-mini'>Read More</a>";
		echo '</td>';
		echo '<td>'.$row['times'].'</td>';
		if($row['status']=='publish'){
			
				if(user_can('trash_all_comment')){
				echo '<td> <a class="btn btn-danger" onclick="return a()" href="trash.php?trashtype=comment&id='.$row['id'].'">Trash This</a></td>';

				}
				else  if(loginuserinfo('id')==$row['user_id']){
					echo '<td> <a class="btn btn-danger" onclick="return a()" href="trash.php?trashtype=comment&id='.$row['id'].'">Trash This</a></td>';
				}
				else{
				echo '<td></td>';
				}
		}
		else if($row['status']=='trash'){
			if(user_can('restore_comment')){
				echo '<td> <a class="btn btn-success" href="trash.php?restoretype=comment&id='.$row['id'].'">Restore This</a>
				
								<a class="btn btn-danger" href="del.php?type=comment&id='.$row['id'].'">Delete this</a>

				</td>';		
			}
			else{
			echo '<td></td>';
			}
		}
		else{
		echo '<td></td>';
		}
		echo '</tr>';
	
}
echo '</tbody></table>';

echo '<hr>';
echo $page1.$page2.$page3.$page4;

