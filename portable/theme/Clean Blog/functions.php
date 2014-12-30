<?php



/*
*	Make a event function
*
*/


function clearnblog_event(){



	if(((isset($_GET['search']) and !empty($_GET['search']))  or isset($_GET['profile']) or isset($_GET['cat']))){ ?>
<div class='event'>
		<?php if (isset($_GET['search']) and !empty($_GET['search'])) { ?>
		
		<?php echo search_result_count($_GET['search']);?> Result found
		
		<?php }if(isset($_GET['profile'])){
		
			$id =   the_user_by_username($_GET['profile'],'id');
			echo display_name($id)."'s Profile";
			
			echo "<br>";
			echo   the_user_by_username($_GET['profile'],'about');

							
		} ?>
		
		<?php if(isset($_GET['cat'])){
		
		echo get_the_cat($_GET['cat'],'name');
		
		 } ?>

		 

 </div>
	<?php } 

}