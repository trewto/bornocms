<?php include('header.php'); ?>
  <div class="main-content">
   <div class="container">
    <div class="content col-md-8 col-xs-12 col-sm-12">
	
	

	<div class="row">
	  <h3><?php echo the_post_link($post_id);?></h3>
	  <span class="label label-default"> <?php echo display_name(the_post_user('id')); ?></span>
		<?php 
			echo post_content($post_id,$post_password) ;
			echo '<br>';
			echo content_edit_link($post_id,get_the_option('site_address'),loginuserinfo('id'));
				?>
			
			             <small class="text-muted">
								<?php 
				echo '<br> Post on ';
				echo date_of_post($post_id,'d-m-y');
				echo ' ,<br>  Write by ';
				echo the_user_link(the_post_user('id'));
				echo ' ,  <br>' ;
				echo post_visit_count($post_id);
				echo ' View , <br>';
				echo count_the_post_comment($post_id); 
				echo ' Comment , <br> ';
				echo the_post_cat($post_id);
			?>
							
							
							</small><hr>
			<?php 
			include('comments.php');
			?>

							
	
	 </div>
	
	
	</div>
	<?php include('sidebar.php'); ?>
	<?php include('footer.php'); ?>