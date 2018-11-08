<?php include "header.php" ;?>
		
		<div id="contentarea">
			<div id="primary">
				
				
					<div class="main_content">
						<h2 class="title">
							<?php echo the_post_link($post_id);?>
						</h2><!--.title-->
						<i>
								<span class="byline">		
								<?php 
									echo '<br> Post on ';
									echo date_of_post($post_id,'d-m-y');
									echo ' ,  Write by ';
									echo the_user_link(the_post_user('id'));
									echo ' ,  ' ;
									//echo post_visit_count($post_id);
									//echo ' View ,';
									echo count_the_post_comment($post_id); 
									echo ' Comment , ';
									echo the_post_cat($post_id);
								?>
								</span></i><br><br>
						<div class="content">
														<?php 
			echo post_content($post_id,$post_password) ;
			echo '<br>';
			echo content_edit_link($post_id,get_the_option('site_address'),loginuserinfo('id'));
				?>
						</div><!--#content-->
						<div class='border'></div>
					</div><!--.artcle-->
					
				<?php 
					include('comment.php');
				?>
			</div>
			
			<?php include "sidebar.php" ;?>
		</div>
		
		<?php include "footer.php" ;?>
	