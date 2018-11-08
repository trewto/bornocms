<?php include "header.php" ; ?>
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
			
			
				
                <div class="post-preview">
                        <h2 class="post-title">
							<?php echo the_post_link($post_id);?>
                        </h2>
                        <div class="post-subtitle">
                           	<?php 
								echo post_content($post_id,$post_password) ;
								echo '<br>';
								echo content_edit_link($post_id,get_the_option('site_address'),loginuserinfo('id'));
							?>
                        </div>
                   <p class="post-meta">	<?php 
				echo 'Post on ';
				echo date_of_post($post_id,'d-m-y');
				echo ' ,  Write by ';
				echo the_user_link(the_post_user('id'));
				echo ' , ' ;
			//	echo post_visit_count($post_id);
				//echo ' View , ';
				echo count_the_post_comment($post_id); 
				echo ' Comment , ';
				echo the_post_cat($post_id);
			?></p>
				   		
			<?php 
			include('comment.php');
			?>
		
				   
                </div>
                <hr>
				
				
				
				
				
            </div>
        </div>
    </div>
<?php include "footer.php" ; ?>

