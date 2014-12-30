<?php include "header.php" ; ?>
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
			
				<?php clearnblog_event() ?>
				<?php if(have_post()):while($content = the_nav() ): ?>
				
                <div class="post-preview">
                        <h2 class="post-title">
							<?php echo the_post_link($content['id']);?>
                        </h2>
                        <div class="post-subtitle">
                           <?php echo post_excerpt($content['content'],0,0); ?>
                        </div>
                   <p class="post-meta">Posted by <?php echo display_name($content['user_id']) ; ?> on  <?php echo the_time($content['times'],'d M Y') ;?></p>
                </div>
                <hr>
				
				<?php endwhile;else :?>
				  <div class="post-preview">
                        <h2 class="post-title">
                         404 Not Found
                        </h2>
                        <h3 class="post-subtitle">
							Nothing found in this page
                        </h3>
                 
                </div>
                <hr>
				
				
				<?php endif;?>
					
					
                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <?php  previous_page_link("buttonx previous") ; ?>
                    </li>
					<li class="next">
						<?php next_page_link("buttonx next");?>
                    </li>
                </ul>
				
				
				
            </div>
        </div>
    </div>
<?php include "footer.php" ; ?>

