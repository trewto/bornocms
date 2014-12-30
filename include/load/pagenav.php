<?php
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
	/*
		$prefix = $dbconnect['DBPREFIX'];
		$prefix_contents = $prefix.'contents';
	*/	
$newget='';	
$newquery='';
#********************
//**************************
if(isset($_GET['cat'])){

$page_number=get_the_option('site_address').'/category/'.$_GET['cat'].'/';
	if(get_the_option('site_permalink')=='getstyle'){
		$page_number=get_the_option('site_address').'/?cat='.$_GET['cat'].'&page=';


	}else{
	
		if(cat_permalink($_GET['cat'])){
			$page_number=get_the_option('site_address').'/cat/'.cat_permalink($_GET['cat']).'/';
		
		}else{
			$page_number=get_the_option('site_address').'/category/'.$_GET['cat'].'/';
		}
	}
	
}/*
else if(isset($_GET['orderbyvisit'])){
if($_GET['orderbyvisit']=="ASC"){
$page_number=get_the_option('site_address').'/unpopular/';

}
else{
$page_number=get_the_option('site_address').'/popular/';
}

}*/
if(isset($_GET['profile'])){
	$get_user=$_GET['profile'];
	$query = mysqli_query($connection,"SELECT * FROM $table_user WHERE username='".mysqli_escape($get_user)."'");
	$count = mysqli_num_rows($query);

	if($count==1){
		$row = mysqli_fetch_array($query);
		$user_ide = $row['id'];
		$newquery="and $prefix_content.user_id='".mysqli_escape($user_ide)."'";
		$newget="&profile=".$row['username'];
		$n1 = 'test';
		//$url = '&profile='.$row['username'];

	}
	else{
		$newquery = "";
		$newget="";
		//echo 'no user found in this name';
		$url = '';

	}
}
//**search page
if(isset($_GET['search'])){
//echo 's';
		//$get_search=htmlentities($_GET['search']);
		$get_search=htmlspecialchars($_GET['search']);
		if(!isset($newquery)){
			$newquery='';
		}	
		$newquery="$newquery and ($prefix_content.post_status='publish' and $prefix_content.title LIKE '%".mysqli_escape($get_search)."%' or $prefix_content.content LIKE '%".mysqli_escape($get_search)."%')";
		if(get_the_option("site_permalink")=="getstyle"){
			$newget=$newget."&search=".$get_search;
		}else{
			$newget=$newget."?search=".$get_search;
		}
		
		

}
//search page end
/*else{
$newquery = "";
$newget="";
		$url = '';

}*/
#**************
if(isset($_GET['cat']) && !isset($_GET['search'])){
$cat= mysqli_escape($_GET['cat']);
 $sql ="SELECT $prefix_content.id,$prefix_content.user_id,$prefix_content.times, $prefix_content.title, $prefix_content.content, $prefix_content.post_status from $prefix_content, $prefix_catmeta  , $prefix_cat
WHERE $prefix_catmeta.post_id = $prefix_content.id and $prefix_catmeta.cat_id = '$cat' and $prefix_catmeta.cat_id =$prefix_cat.id 
$newquery";

}else if(isset($_GET['orderbyvisit'])){
	$sql ="select $prefix_content.id, $prefix_content.title, $prefix_content.content, $prefix_content.post_status, $prefix_visit.value
from $prefix_content, $prefix_visit
where $prefix_visit.post_id = $prefix_content.id 
and 
 $prefix_content.post_status = 'publish'
order by $prefix_visit.value desc";
}

	else{
	
// Now lets get all messages from your database
$sql = "SELECT * FROM $prefix_contents WHERE  post_status='publish' $newquery";
}
$query = mysqli_query($connection,$sql);
$querycount = $query ;

// Lets count all messages
$post_number = $num = mysqli_num_rows($query);
//antoher array *#<a
 //if($page<1){
//$page = $post_number+1;
//}















$int_options = array("options"=>array("min_range"=>1));

if(!filter_var($page, FILTER_VALIDATE_INT, $int_options)){
$page = $post_number+1;
}

// Lets set how many messages we want to display
//$per_page = "8";

$int_options = array("options"=>array("min_range"=>1));
	$option = get_the_option('number_of_post_display');
	if(!filter_var($option, FILTER_VALIDATE_INT, $int_options)){
		$per_page = "8";
	}
	else{
		$per_page = $option; 
	}

// Now we must calculate the last page
$last_page = ceil($num/$per_page);





// Math.. It gets us the start number of message that will be displayed
$start = ($page-1)*$per_page;

// Now lets set the limit for our query
 $limit = "LIMIT $start, $per_page";










// It's time for getting our messages
if(isset($_GET['cat']) && !isset($_GET['search'])){
	 	$sqls = "SELECT $prefix_content.id,$prefix_content.user_id,$prefix_content.times, $prefix_content.title, $prefix_content.content, $prefix_content.post_status from $prefix_content, $prefix_catmeta  , $prefix_cat
WHERE $prefix_catmeta.post_id = $prefix_content.id and $prefix_catmeta.cat_id = $cat and $prefix_catmeta.cat_id =$prefix_cat.id 
and post_status='publish'
$newquery ORDER BY $prefix_content.id DESC  $limit";
$sql= $sql." $limit";

}/*
else if(isset($_GET['orderbyvisit'])){

		if($_GET['orderbyvisit']=="ASC"){
			$sql ="select $prefix_content.id,$prefix_content.user_id,$prefix_content.times, $prefix_content.title, $prefix_content.content, $prefix_content.post_status, $prefix_visit.value
from $prefix_content, $prefix_visit
where $prefix_visit.post_id = $prefix_content.id 
and 
 $prefix_content.post_status = 'publish'
order by $prefix_visit.value ASC  $limit";
		
		
		} else{
	$sql ="select $prefix_content.id,$prefix_content.user_id,$prefix_content.times, $prefix_content.title, $prefix_content.content, $prefix_content.post_status, $prefix_visit.value
from $prefix_content, $prefix_visit
where $prefix_visit.post_id = $prefix_content.id 
and 
 $prefix_content.post_status = 'publish'
order by $prefix_visit.value desc  $limit";
	}

}*/
else{
$sql = "SELECT * FROM $prefix_contents WHERE  post_status='publish' $newquery ORDER BY `id` DESC  $limit";

}
$query = mysqli_query($connection,$sql);
if(isset($n1)){
		$newget="?profile=".$row['username'];

//$user_post_count = mysqli_num_rows($querycount);
//echo '<a class="btn btn-primary" href="'.get_the_option('site_address').'/profile/'.htmlspecialchars($_GET['profile']).'">'.$user_post_count.' Content</a> ';
//echo '<a class="btn btn-primary" href="'.get_the_option('site_address').$url_profile.htmlspecialchars($_GET['profile']).'">Visit Profile</a>';


//$Url_profile;

if(get_the_option('site_permalink')!='getstyle'){
$page_number=get_the_option('site_address').'/profile/'.$_GET['profile'].'/';

}
else{
$page_number=get_the_option('site_address').'/?profile='.$_GET['profile'].'&page=';
}
$newget='';
}







if ($last_page<$page){
if(!isset($_GET['search'])){

//echo ('<b>There are no content in this page</b>');
}

if(isset($_GET['search'])){

$msg_search= 'There are no content in this search page . If you are not in search first page go to the search first page or try to the another keyword';
}

}
// And set the first page
$first_page = "1";
// And lets display our messages
//while($row = mysqli_fetch_array($query) or die(mysql_error())){

//echo '<br><br>';
// Here we are making the "First page" link
   $page1 = "<a class='firstpage next' href='".$page_number.$first_page.$newget."'>&larr;&larr;First page</a> ";

// If page is 1 then remove link from "Previous" word
if($page == $first_page){
	
 $page2 = "<span class='previous disabled'><a>Previous</a></span> ";
 //$page2 = " ";
	
}else{
	
	if(!isset($page)){
		
		  $page2 =  "<span  class='previous  disabled'><a>Previous</a></span> ";
		  //$page2 =  " ";
		
	}else{
		
		// But if page is set and it's not 1.. Lets add link to previous word to take us back by one page
		$previous = $page-1;
		if ($last_page<$page){// use <= 
		$page2 =  "<span  class='previous disabled' ><a>Previous</a></span> ";
		}
		else{
		 $page2 =  "<a class='previous' href='".$page_number.$previous.$newget."'>&larr;Previous</a> ";
		 $p_link = $previous;
		}
	}
	
}

// If the page is last page.. lets remove "Next" link
if($page == $last_page){
	
	$page3 =  "<span class='next disabled'><a>Next</a> </span> ";	
	// $page3 =  " ";	
	
}else{
	
	// If page is not set or it is set and it's not the last page.. lets add link to this word so we can go to the next page
	if(!isset($page)){
		
		$next = $first_page+1;
		 $page3 =   "<a class='next' href='".$page_number.$next."'>Next&rarr;</a> ";
		
	}else{
	
		$next = $page+1;
		if ($last_page<$page){
		$page3 =  "<span class='  disabled'><a>Next</a> </span> ";	
		}
		else{
		 // $page3 =  "<a class='btn' href='?page=".$next."'>Next</a> ";
		  $page3 =  "<a class='next' href='".$page_number.$next.$newget."'>Next&rarr;</a> ";
		  $n_link = $next;
		}
	}
	
}

// And now lets add the "Last page" link
 $page4 =  "<a class='next' href='".$page_number.$last_page.$newget."'>Last page&rarr;&rarr;</a>";


/*
if(isset($_GET['search'])){
//echo $post_number.' Result Found ( Keyword : '.htmlentities($_GET['search']).' )';
echo $post_number.' Result Found ( Keyword : '.htmlspecialchars($_GET['search']).' )';
echo '<div class="border"></div>';

	if(isset($msg_search)){
		echo $msg_search;
		echo '<div class="border"></div>';

	}

}
*/



if(isset($_GET['p']) and content_check($_GET['p'])){
	$post_sql = "SELECT * FROM $prefix_content WHERE id='$post_id'";
	$post_query= mysqli_query($connection,$post_sql);
	function the_nav(){
		global $post_query;
		return mysqli_fetch_array($post_query);
	}
	$is = 'p';



}
else if(isset($_GET['doc']) and is_exists_doc($_GET['doc'])){

	$doc_id = mysqli_escape($_GET['doc']);
	$doc_sql = "SELECT * FROM $prefix_doc WHERE id='$doc_id'";
	$doc_query= mysqli_query($connection,$doc_sql);
	function the_nav(){
		global $doc_query;
		return mysqli_fetch_array($doc_query);
	}
	$is ='doc';


}
else{

	function the_nav(){
		global $query;
		return mysqli_fetch_array($query);
	}

	$is = 'other';


}

function have_post(){
		global $query;
	$num  = mysqli_num_rows($query);
	if ($num==0){
		return false;
	}
	else{
		return true;
	}

}
/*
function search_result_count($get_search){
$get_search = htmlspecialchars($get_search);
global $prefix_content;
	$newquery=" and ($prefix_content.post_status='publish' and $prefix_content.title LIKE '%".mysqli_escape($get_search)."%' or $prefix_content.content LIKE '%".mysqli_escape($get_search)."%')";
		$sql = "SELECT * FROM $prefix_content WHERE  post_status='publish' $newquery";

	$number = mysqli_num_rows(mysqli_query($connection,$sql));
	if(isset($_GET['search']) & !isset($_GET['cat'])){
		return $number;
	}
}
*/
/*
while($row = mysqli_fetch_array($query)){
	$post_id = $row['id'];
	echo '<div id="post" class="postarea">
					<div class="title">
						<h4>';
						
	if(isset($_GET['search'])){
	$searchword= htmlentities($_GET['search']);
	$title = str_replace( $searchword, '<span style="color:green">'.$searchword.'</span>', $row['title'] );
	echo '<a href="?p='.$post_id.'">'.$title."</a>";
	}
	else{
	
		echo '<a href="'.get_the_option('site_address').'/content/'.$post_id.'">'.$row['title']."</a>";
	}
	echo '</h4></div>';
	
	
	
	if(user_by_postid($row['id'],'name')==''){
		$user = user_by_postid($row['id'],'username');
	}
	else{
		$user = user_by_postid($row['id'],'name');}
		
		
		echo '<span class="meta-info">';
		echo '<i>Write By '.$user.'</i> , Time: ';
		//echo date("d.m.Y", strtotime(get_the_post($post_id,'times'))).' at '.date("h:i A", strtotime(get_the_post($post_id,'times'))) ;
		echo date("d-m-y", strtotime(get_the_post($post_id,'times').get_the_option('timelplus')." hour"));
		echo ' at '.date("h:i A", strtotime(get_the_post($post_id,'times').get_the_option('timelplus')." hour"));
		echo '</span>';
	
		echo '<br>';

	// 	 str_replace( $searchword, '<span style="color:red">'.$searchword.'</span>', $htfolderurl );
	echo '<div class="main-content">';
	if(isset($_GET['search'])){
	$content = post_excerpt($row['content'],$post_id,0);


	$searchword= htmlentities($_GET['search']);
	echo str_replace( $searchword, '<span style="color:green">'.$searchword.'</span>', $content );
		echo "<a href='".get_the_option('site_address')."/content/".$post_id."' class='btn btn-mini'>Read More</a>";
	}
	else{
		echo post_excerpt($row['content'],$post_id,0);
		echo "<a href='".get_the_option('site_address')."/content/".$post_id."' class='btn '>Read More</a>";
	}
	echo '</div>';
	echo '<br>';
	echo '<br>';
	echo '</div>';
}

*/
//echo $page1.$page2.$page3.$page4;

if(!isset($p_link)){
	$p_link='nothing';

}
if(!isset($n_link)){
	$n_link='nothing';
}
//echo 	$page_number.$n_link;
//var_dump( $newget);
function previous_page_link($class=''){
	global $page_number;
	global $newget;
	global $p_link;
	if($p_link==='nothing'){
	
		
	}
	else{
		$site_name = get_the_option('site_address');
		echo '<a class="'.$class.'" href="'.$page_number.$p_link."".$newget.'">Previous</a>';
	}
}
function next_page_link($class=''){
	global $n_link;
	global $page_number;
	global $newget;
	if($n_link==='nothing'){
	
		
	}
	else{
		$site_name = get_the_option('site_address');
		echo '<a class="'.$class.'" href="'.$page_number.$n_link."".$newget.'">Next</a>';
	}
}
/*
	old style pagenav 
	<ul class="pager">
			<li class="previous">
				<?php echo  $page2.$page1 ;?>
			</li>
			<li class="next">
				<?php echo  $page3.$page4;?>
			</li>
		</ul>	
*/
?>