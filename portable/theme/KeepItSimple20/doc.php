<?php include "header.php" ?>

   		<div id="main" class="eight columns">
		
		
	   		<article class="entry">

					<header class="entry-header">

						<h2 class="entry-title">
								<a href="<?Php echo doc_link($_GET['doc']); ?>"><?php echo get_the_doc_page($_GET['doc'],'title'); ?></a>
						</h2> 				 
					
					
					</header> 
					
					<div class="entry-content">
						<?php echo get_the_doc_page($_GET['doc'],'content'); ?>
					</div> 

				</article> <!-- end entry -->
			

   		</div> <!-- end main -->


 <?php  include "sidebar.php" ; ?>
 <?php  include "footer.php" ; ?>