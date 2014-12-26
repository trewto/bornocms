<?php include "header.php" ;?>
		
		<div id="contentarea">
			<div id="primary">
				
				
					
					<div class="main_content">
						<h2 class="title">
							<a href="<?php echo doc_link($_GET['doc']); ?>"><?php echo get_the_doc_page($_GET['doc'],'title'); ?></a>
						</h2><!--.title-->
			
						<div class="content">
						<?php echo get_the_doc_page($_GET['doc'],'content'); ?><br>
						</div><!--#content-->
						<div class='border'></div>
					</div><!--.artcle-->
					

			</div>
			
			<?php include "sidebar.php" ;?>
		</div>
		
		<?php include "footer.php" ;?>
	