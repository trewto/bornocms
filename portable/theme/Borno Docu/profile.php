<?php 
	//include header
	include("header.php");

?>
		<div id="mainarea" class="row-fluid">
			<!-- primary area-->
			<div class="primary span8">
			
				<?php $user_id = the_user_by_username($_GET['profile'],'id') ?>
				<h3><b><?php echo display_name($user_id,true); ?></b></h3>
				<?php echo the_user_by_username($_GET['profile'],'about'); ?><br>
				<?Php echo site_count($user_id,'user_total_post') ?> Content
				<hr>
				
			
				<?php if(have_post()):while($content = the_nav() ): ?>	
				
				    <?php echo the_post_link($content['id']);?><br>
				
				<?php endwhile;else :?>
					<h3 class="center">Not Found</h3>
					<div class="center">There are no content in this page.</div>
				<?php endif;?>
				
				
					
				<ul class="pager">
					<li class="previous">
						<?php  previous_page_link() ;?>
					</li>
					<li class="next">
						<?php next_page_link();?>
					</li>
				</ul>
				
						
						
			</div><!--#primary-->
			
			<?php
				include("sidebar.php");//including sidebar
			?>
		
		
		</div><!--#mainarea-->


<?php 
	//include footer
	include("footer.php");

?>