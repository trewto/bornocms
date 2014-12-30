<?php include "header.php" ;?>
		
		<div id="contentarea">
			<div id="primary">
							<?php jerry_event(); ?>

				<?php if(have_post()):while($content = the_nav() ): ?>
					<div class="article">
						<h2 class="title">
							<?php echo the_post_link($content['id']);?>
						</h2><!--.title-->
						
						<div class="content">
								<?php echo post_excerpt($content['content'],0,0); ?>
						</div><!--#content-->
						<div class='border'></div>
					</div><!--.artcle-->
					<?php endwhile;else :?>
						<div class="article">
							<h2 class="title">
								Not Found
							</h2><!--.title-->
							
							<div class="content">
								Nothing is found here
							</div><!--#content-->
							<div class='border'></div>
						</div><!--.artcle-->
					
					<?php endif;?>
					<?php  previous_page_link("buttonx previous") ;?>
					<?php next_page_link("buttonx next");?>
			</div>
			
			<?php include "sidebar.php" ;?>
		</div>
		
		<?php include "footer.php" ;?>
	