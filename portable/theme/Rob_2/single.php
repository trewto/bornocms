<?php include('header.php'); ?>
<div class="row-fluid marketing">
	 	
        <div class="span12">
			<?php if(have_post()):while($content = the_nav() ): ?>
				<h4><?php echo the_post_link($content['id']);?></h4>
				<p><?php	echo post_content($content['id'],$post_password);?></p>
					<p class="muted">	
					<?php 
						echo 'Post on ';
						echo date_of_post($post_id,'d-m-y h:i A');
						echo ' <br> Write by ';
						echo the_user_link(the_post_user('id'));
						echo ' , Category: ';
						echo the_post_cat($post_id);
						echo '  <br>' ;
						//echo post_visit_count($post_id);
						//echo ' View  , ';
						echo count_the_post_comment($post_id); 
						echo ' Comment  ';
						echo content_edit_link($post_id,get_the_option('site_address'),loginuserinfo('id'));
						endwhile ;endif ;
					?>
					</p>
        </div>
	

</div>
		
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
<hr>	
	
<?php include('comments.php') ;?>
<?php include('footer.php') ;?>