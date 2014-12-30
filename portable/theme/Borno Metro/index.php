<?php include('header.php'); ?>
  <div class="main-content">
   <div class="container">
    <div class="content col-md-8 col-xs-12 col-sm-12">
	
				<?php if(isset($_GET['search']) or isset($_GET['profile']) or isset($_GET['cat'])){ ?>

	 <div class="row">
	  <div class="alert alert-dismissable alert-success">
       <button type="button" class="close" data-dismiss="alert"><i class="glyphicon glyphicon-remove"></i></button>
				
							<?php if (isset($_GET['search']) && search_result_count($_GET['search'])!=0){ ?>
							<div class="border"></div>
							<?php echo search_result_count($_GET['search']);?> Result found
							
							<?php }if(isset($_GET['profile'])){
							
								$id =   the_user_by_username($_GET['profile'],'id');
								echo display_name($id)."'s Profile";
							} ?>
							
							<?php if(isset($_GET['cat'])){
							
							echo get_the_cat($_GET['cat'],'name');
							
							 } ?>
                   </div>
	 </div>
	      
					 
                        <?Php } ?>
	 <?php if(have_post()):while($content = the_nav() ): ?>
	 <div class="row">
	  <h3><?php echo the_post_link($content['id']);?></h3>
	  <p><?php	echo post_excerpt($content['content'],0,0);	?></p>
	   <a href="<?php echo the_post_link($content['id'],false) ; ?>" class="text-muted btn btn-primary">Read More</a>
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
	<?php include('sidebar.php'); ?>
	<?php include('footer.php'); ?>