<?php include('header.php'); ?>
	<div class="primary span8">
		<div id="post" class="postarea">
		
			<div class="single-title">
				<h3>
					<?php echo the_post_link($post_id);?>
				</h3>
			</div>
			
			<span class="single-meta-info">
			<?php 
				echo 'Post on ';
				echo date_of_post($post_id,'d-m-y h:i A');
				echo ' , Write by ';
				echo the_user_link(the_post_user('id'));
				echo ' , ' ;
				echo post_visit_count($post_id);
				echo ' View , ';
				echo count_the_post_comment($post_id); 
				echo ' Comment , ';
				echo the_post_cat($post_id);
			?>
			</span>

			<div class="main-content" style="">
				<?php 
					echo post_content($post_id,$post_password) ;
					echo '<br>';
					echo content_edit_link($post_id,get_the_option('site_address'),loginuserinfo('id'));
				 ?>
				<br>
				
				<div class="border"></div>
				
				
				<ul class="pager">
					<li class="previous">
						<?php if(previous_post_link($post_id)){?>
						<span>&larr; <?php echo previous_post_link($post_id) ;?></span>
						<?php } ?>
					</li>
					
					<li class="next">
					<?php if(next_post_link($post_id)){?>
						<span><?php echo next_post_link($post_id) ;?> &rarr; </span> 
							<?php } ?>
					</li>
				</ul>
			
			
				<div class="border"></div>

				<!--comment area-->
				<?php include('comments.php') ;?>
				<!--comment area end-->
				
			</div>
		</div>
	</div>
<?php include('sidebar.php') ;?>
<?php include('footer.php') ;?>