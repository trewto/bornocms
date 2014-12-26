<?php
/*
*	Add new category
*		
*
*/

//if user can not add cetagory then die
if(!user_can('add_category')){borno_die("Ups! You can not do that");}
	
	if(isset($_POST['submit']) && isset($_POST['catdes']) && isset($_POST['catname'])){
		$progress = true ; 
		$trimcatname  = trim($_POST['catname']);
		if(empty($trimcatname)){
			$progress = false;
			borno_die( '<span>you give empty cat name , empty cat name is not allowed</span>');
		}
		//if(!validate_name($_POST['catname'])){borno_die("You must enter a validate name");}

		#need to cheack is already exists cat in this name ;)
		if($progress==true){
			if(is_similar_cat($_POST['catname'])){
				borno_die( 'Similer category is already exists' );	
			}
			else{
				$cat_name = $_POST['catname']; $cat_des = $_POST['catdes'] ;
				$cat_slug = isset($_POST['slug']) ? $_POST['slug'] : '' ; 
				add_cat($cat_name , $cat_des,$cat_slug );
				echo '<div class="alert alert-success">New cat added</div>';
			}
		
		}
	
	}

//form 

?>
<h3>Add a new category</h3>
<form method="POST" action="">
	<label for="catname">Category Name</label>
	<input id="catname" name="catname"  type="text"/><br>
	<label for="catdes">Category Description</label>
	<textarea name="catdes" id="catdes"></textarea><br>
	
	<label for="slug">Slug</label>
	<input id="slug" name="slug"  type="text"/><br>

	<input type="submit" class="btn btn-primary" name="submit" value="Add new category"/>
</form>