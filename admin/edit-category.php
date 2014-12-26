<?php 
/*
*Edit category page
*/

//is_exists_cat
if(!isset($_GET['id'])){
	borno_die('Invalid entry');
}
if(!user_can('edit_category')){
	borno_die('You can not access this page');
}
if(!filter_var($_GET['id'], FILTER_VALIDATE_INT)){
	borno_die('invalid url');
}
if(!is_exists_cat($_GET['id'])){
	borno_die ('the cat is not exists');
}
else{
	///saved action ()
	if(isset($_POST['submit']) & isset($_POST['catname']) & isset($_POST['catdes']) & isset($_POST['thecatid'])){
		if(is_exists_cat($_POST['thecatid'])){
			if(!empty($_POST['catname'])){
				$catname= $_POST['catname'];
				$tcatname= trim($_POST['catname']);
				$query = borno_query("SELECT * FROM $prefix_cat	WHERE name='".mysqli_escape($catname)."'");
				$query2 = borno_query("SELECT * FROM $prefix_cat WHERE name='".mysqli_escape($tcatname)."'");
				$count = mysqli_num_rows($query);
				$count2 = mysqli_num_rows($query2);
				$the_name = get_the_cat($_POST['thecatid'],'name');
				//////////validate
				if(!validate_name($_POST['catname'])){borno_die("You must enter a validate name");}
				
				//////////////////
				if($count==0 or $count2==0 or $catname==$the_name){
					if($_POST['thecatid']!=1){
					
					$cat_slug = isset($_POST['slug']) ? $_POST['slug'] : '' ; 
					
					update_cat($_POST['thecatid'],$_POST['catname'] ,$_POST['catdes'],$cat_slug);
					echo '<div class="alert alert-success">Updated</div>';
					}
					else{
						borno_die ('You can not change category' );
					}
				}
				else{
					borno_die ('one category of this name already exists');
				}
			}
			else{
			
				borno_die ('You can not filled empty this name');
			}
		
		
		}
		else{
			borno_die ('the cat is not exists');
		
		}
	
	}
	
	
?>

<h3>Edit the category</h3>
<form method="POST" action="">
	<input type="hidden" name="thecatid" value="<?php echo $_GET['id']; ?>"/>
	<label for="catname">Category Name</label>
	<input id="catname" name="catname"  type="text" value="<?php echo get_the_cat($_GET['id'],'name');?>" /><br>
	<label for="catdes">Category Description</label>
	<textarea name="catdes" id="catdes"><?php echo get_the_cat($_GET['id'],'description');?></textarea><br>
	
	<label for="slug">Slug</label>
	<input id="slug" name="slug"  type="text" value="<?php echo cat_permalink($_GET['id']); ?>" /><br>
	
	
	<input type="submit" class="btn btn-primary" name="submit" value="Save Change"/>
	<?php if(user_can('delete_category')  and $_GET['id']!=1){ ?>
	<a href="#deletethis" role="button" class="btn btn-danger" data-toggle="modal">Delete this cetagory</a>
	<?php }?>
</form>
<?php /*

<!-- the hidden div -->	
<div id="deletethis" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<!-- header start-->
<div class="modal-header">
<!-- cross bottom -->
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<!--msg started -->
<h3 id="myModalLabel">Are You sure to delete this ?</h3>
<!--msg end -->
</div>
<!-- header end-->
<!-- body msg-->
<div class="modal-body">
<p>after deleting this post all cetagory will get under uncetagory</p>
</div>
<!-- body msg end-->
<!-- footer-->
<div class="modal-footer">
<!--close bottom -->
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<?php echo '<a href="del.php?type=cat&id='.$_GET['id'].'" class="btn btn-danger">Delete this </a>';//trash link ?>
</div>
<!-- footer msg end-->
</div>
*/
?>




 <div class="panel-body">
	
	
	<div class="modal fade" id="deletethis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Notice</h4>
				</div>
				<div class="modal-body">

<h3 id="myModalLabel">Are You sure to delete this ?</h3>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<?php echo '<a href="del.php?type=cat&id='.$_GET['id'].'" class="btn btn-danger">Delete this </a>';//trash link ?>
				</div>
			</div>
		</div>
	</div>
 </div>


<?php

} ?>


    