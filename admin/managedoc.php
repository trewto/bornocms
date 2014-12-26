<?php 
/*
*	Manage Doc
*	@@Tr3wt0
*/

/*
*	Check role
*/
if(!user_can('manage_doc')){
	die('You can not access this page');
}

//total publish
$tpublish  = borno_query("SELECT * FROM $prefix_doc WHERE doc_status = 'publish'");
$tpublish = mysqli_num_rows($tpublish);

//total draft
$tdraft  = borno_query("SELECT * FROM $prefix_doc WHERE doc_status = 'draft'");
$tdraft= mysqli_num_rows($tdraft);


if(isset($_GET['msg']) && $_GET['msg']=='delete'){

	echo "<div class='alert alert-success'>Successfully DELETED</div>";
}


//display status
echo'<a class="label label-success" href="?pages=managedoc&by=publish">Publish '.$tpublish.'</a> ';
echo'<a class="label label-success" href="?pages=managedoc&by=draft">Draft '.$tdraft.'</a> ';

?><br><br>
     <form method="get" action="<?php echo get_the_option('site_address');?>/admin/">
	    <div class="input-append">
    <input name="pages" value="managedoc" type="hidden">
    <input name="by" value="<?php 
	if(isset($_GET['by'])){
		echo $_GET['by'];
	}
	else{
	echo 'publish';
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
	</form><br>
<?php
include('doc-nav.php');