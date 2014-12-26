<?php include('header.php'); ?>
	<div class="primary span8">
		<?php if(have_post()):while($content = the_nav() ): ?>	
		
			<div id="post" class="postarea">
				<div class="title">
					<h4><?php echo the_post_link($content['id']);?></h4>
				</div>
			
				<span class="meta-info"><i>Write By <?php echo display_name($content['user_id']) ; ?> </i> , Date: <?php echo the_time($content['times'],'d.m.Y') ; echo ' , '.count_the_post_comment($content['id']).' Comment';?> </span> 
				
				<br>

				<div class="main-content">
					<?php
					echo post_excerpt($content['content'],0,0);
					echo "<a href='".the_post_link($content['id'],false)."' class='btn '>Read More</a>";
					?>
				<br><br><br>
				</div>
			</div>
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
	</div>
<?php include('sidebar.php') ;?>
<?php include('footer.php') ;?>