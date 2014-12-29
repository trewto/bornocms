<?php 
	//include header
	include("header.php");

?>
		<div id="mainarea" class="row-fluid">
			<!-- primary area-->
			<div class="primary span8">
				
				<!--Displaying the content -->
				<?php 
				
				
						echo "<h3><b>". get_the_post($post_id,"title")."</b></h3><hr>";//title

						echo post_content($post_id,$post_password) ;//content
						echo '<br><br>';
						echo content_edit_link($post_id,get_the_option('site_address'),loginuserinfo('id'));//edit link
				
				
				echo '<br> Post on ';
				echo date_of_post($post_id,'d-m-y');
				echo ' , By ';
				echo the_user_link(the_post_user('id'));
				echo '  <br>' ;
				echo post_visit_count($post_id);
				echo ' View , ';
				echo the_post_cat($post_id);
			?>
			
			<!-- previous and next post link -->
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
				
			
			<!--comment area-->
			<?php include('comments.php') ;?>
			<!--comment area end-->
			
			</div><!--#primary-->
			
			<?php
				include("sidebar.php");//including sidebar
			?>
		
		
		</div><!--#mainarea-->


<?php 
	//include footer
	include("footer.php");

?>