<?php 
	//include header
	include("header.php");

?>
		<div id="mainarea" class="row-fluid">
			<!-- primary area-->
			<div class="primary span8">
				<h3><b><?php echo get_the_cat($_GET['cat'],'name');?></b></h3><hr>
				
			
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