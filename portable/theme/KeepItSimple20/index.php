<?php include "header.php" ?>

   		<div id="main" class="eight columns">
		
		
		<?php if(have_post()):while($content = the_nav() ): ?>
	   		<article class="entry">

					<header class="entry-header">

						<h2 class="entry-title">
								<?php echo the_post_link($content['id']);?>
						</h2> 				 
					
						<div class="entry-meta">
							<ul>
								<li> <?php echo the_time($content['times'],'M d Y') ;?></li>
								<span class="meta-sep">&bull;</span>								
								<li><?php echo the_post_cat($content['id']); ?></li>
								<span class="meta-sep">&bull;</span>
								<li><?php echo display_name($content['user_id']) ; ?></li>
							</ul>
						</div> 
					 
					</header> 
					
					<div class="entry-content">
						<p><?php echo post_excerpt($content['content'],0,0); ?></p>
					</div> 

				</article> <!-- end entry -->
		<?php endwhile;else :?>
				 <article class="entry">

					<h2 class="entry-title">
							No Result Found
					</h2> 
					
					<div class="entry-content">
						<p>The content you are looking for is not found</p>
					</div> 

				</article> <!-- end entry -->
		

		<?php endif;?>
		
				
	

					 <ul class="post-nav group">
  			            <li class="prev"><?php  previous_page_link("prev") ;?></li>
  				         <li class="next"><?php next_page_link();?></li>
  			        </ul>

   		</div> <!-- end main -->


 <?php  include "sidebar.php" ; ?>
 <?php  include "footer.php" ; ?>