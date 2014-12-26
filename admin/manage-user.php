<?php
/*
	This is manage user page
*/
if(!user_can('manage_user')){
	die('You can not access this page');
} 


// count total user
//echo $prefix_users;
// total user
$sql = borno_query("SELECT * FROM $prefix_users");
$count=$total_user= mysqli_num_rows($sql);

//total admin
$sql = borno_query("SELECT * FROM $prefix_users WHERE level='1'");
$admincount=$total_user= mysqli_num_rows($sql);

//disble user
$sql = borno_query("SELECT * FROM $prefix_users WHERE account_active ='0'");
$disblecount=$total_user= mysqli_num_rows($sql);

//enable user
$sql = borno_query("SELECT * FROM $prefix_users WHERE account_active ='1'");
$enablecount=$total_user= mysqli_num_rows($sql);

//level 2
$sql = borno_query("SELECT * FROM $prefix_users WHERE level ='2'");
$level2=$total_user= mysqli_num_rows($sql);

////level 2
$sql = borno_query("SELECT * FROM $prefix_users WHERE level ='3'");
$level3=$total_user= mysqli_num_rows($sql);


$sql = borno_query("SELECT * FROM $prefix_users WHERE level !='0' and level !='1' and level !='2' and level !='3' ");;
$otherlevel = mysqli_num_rows($sql);

//display
if(isset($_GET['viewtype'])){
$vtypes =  htmlentities($_GET['viewtype']);
}else{
$vtypes= 'all';
}

if(isset($_GET['search'])){
$search_form_value = $_GET['search'];
}
else{
$search_form_value='';
}
$the_limit = '10';
$int_options = array("options"=>array("min_range"=>1));


if(isset($_GET['limit'])){
	if(filter_var($_GET['limit'], FILTER_VALIDATE_INT, $int_options)){
	$the_limit=$_GET['limit'];
	}
	
}

if(isset($_GET['msg']) && $_GET['msg']=='delete'){

	echo "<div class='alert alert-success'>Successfully DELETED</div>";
}

?>
  <form method="get" action="index.php">
		<input value="manageuser" name="pages"  type="hidden">
		<input value="<?php echo $vtypes; ?>" name="viewtype"  type="hidden">
  	   
	   <div class="input-append">
			<input class="span3" value="<?php echo $search_form_value ; ?>"  placeholder="Email or Username" name="search" id="appendedInputButton" type="text">	
			<!--<button type="submit" class="btn">Search!</button>-->
		</div>
	 
		<div class="input-append">
			<input class="span2 hidden-phone" value="<?php echo $the_limit ;?>"  placeholder="LIMIT" name="limit" id="appendedInputButton" type="text"> 
			<button type="submit" class="btn">Submit!</button>
		</div>
    </form><br>
	<?php
echo '<a href="?pages=manageuser"><span class="label label-success"> Total USER  '.$count.'</span></a> ';

echo ' <a href="?pages=manageuser&viewtype=admin"><span class="label label-success"> Admin  '.$admincount.'</span></a>';

//echo ' <a href="?pages=manageuser&viewtype=leveltwo"><span class="label label-success"> level2  '.$level2.'</span></a>';

//echo ' <a href="?pages=manageuser&viewtype=levelzero"><span class="label label-success"> Level Zero  '.$level3.'</span></a>';

echo ' <a href="?pages=manageuser&viewtype=disble"><span class="label label-success"> Disble account  '.$disblecount.'</span></a>';

echo ' <a href="?pages=manageuser&viewtype=enable"><span class="label label-success"> Enable account  '.$enablecount.'</span></a>';

//echo ' <a href="?pages=manageuser&viewtype=otherlevel"><span class="label label-success">OTHER '.$otherlevel.'</span></a>';
echo "<br><br>";
include('user-pagenav.php');