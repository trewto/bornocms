<?php include "header.php" ?>

   		<div id="main" class="eight columns">
		
		
	   		<article class="entry">

					<header class="entry-header">

						<h2 class="entry-title">
								<?php echo get_the_post($post_id,"title");?>
						</h2> 				 
					
						<div class="entry-meta">
							<ul>
								<li> <?php echo date_of_post($post_id,'M d Y') ;?></li>
								<span class="meta-sep">&bull;</span>								
								<li><?php echo the_post_cat($post_id); ?></li>
								<span class="meta-sep">&bull;</span>
								<li><?php echo the_user_link(the_post_user('id')) ?></li>
							</ul>
						</div> 
					 
					</header> 
					
					<div class="entry-content">
						<?php echo post_content($post_id,$post_password) ;//content
						echo '<br>';
						echo content_edit_link($post_id,get_the_option('site_address'),loginuserinfo('id'));//edit link ?>
					</div> 

				</article> <!-- end entry -->
				<ul class="post-nav group">
					<li class="prev">
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
				
			
						<!-- Comments
            ================================================== -->
            <div id="comments">

               <h3><?php echo count_the_post_comment($post_id);  ?> Comments</h3>

				<?php include ( "comments.php" ); ?>
            </div>  <!-- Comments End -->		
   			
			

   		</div> <!-- end main -->


 <?php  include "sidebar.php" ; ?>
 <?php  include "footer.php" ; ?>