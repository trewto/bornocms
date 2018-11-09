<?php
/*
*	This is the category page
*	Editor Can See all of the category in this page
*/
if(!user_can('edit_category')){borno_die("Your Can not access this");}


//the query
$query = borno_query("SELECT * FROM $prefix_category");

//count the table 
$count  = mysqli_num_rows($query);
$i = true;
if(isset($_GET['msg']) && $_GET['msg']=='delete'){

	echo "<div class='alert alert-success'>Successfully DELETED</div>";
}


if($count==0){
	
		echo 'There are no Category .  Please create a new category';
		$i = false;
}



if($i==true){
	echo '<ul class="admincatpage">';
	while($row = mysqli_fetch_array($query)){
		echo '<li>';
		echo '<a href="'.the_cat_link($row['id']).'">';
		echo htmlspecialchars($row['name']);
		echo '</a> ';
		if($row['id']!=1){
		echo '[ <a href="?pages=edit_cat&id='.$row['id'].'">Edit this</a> ]';
		}
		echo '</li> ';
	}
	echo '</ul>';
}

?>