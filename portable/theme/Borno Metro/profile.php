<?php include('header.php'); ?>
  <div class="main-content">
   <div class="container">
    <div class="content col-md-8 col-xs-12 col-sm-12">
	
	<?php 
				$id =   the_user_by_username($_GET['profile'],'id');
				$about =   the_user_by_username($_GET['profile'],'about');
				$name = display_name($id);
	?>
	 <div class="col-md-12">
     <div class="row author">
	  <div class="panel panel-success">
       <div class="panel-heading">
        <h3 class="panel-title"><i class="glyphicon glyphicon-user"></i><?php echo $name ; ?></h3>
       </div>
       <div class="panel-body">
	    <div class="author-avatar pull-left">
		<img src="<?php echo  get_gravatar( the_user($content['user_id'],'email'), 50);?>" class="img-circle">
	    </div>
	    <div class="author-info">
		 <p><?php echo $about ; ?></p>
	    </div>
       </div>
      </div>
	 </div>
	 <div class="row content">
	 </div>
    </div>
	
	
	
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