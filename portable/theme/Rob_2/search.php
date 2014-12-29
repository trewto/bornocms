<?php include('header.php'); ?>
	<h1 class="jumbotron"><?php echo get_the_option('site_description');?></h1>
	<hr>
		<?php if (search_result_count($_GET['search'])!=0){ ?>
		<?php echo search_result_count($_GET['search']);?> Result found
		<?php } ?>
      <div class="row-fluid marketing">
	 	
        <div class="span8">
			<?php if(have_post()):while($content = the_nav() ): ?>
				<h4><?php echo the_post_link($content['id']);?></h4>
				<p><?php	echo the_excerpt($content['content'],40);?></p>
			<?php endwhile ;else :?>
				No result found
			<?php endif ;?>
					
			<ul class="pager">
				<li class="previous">
					<?php  previous_page_link() ;?>
				</li>
				<li class="next">
					<?php next_page_link();?>
				</li>
			</ul>	
        </div>

        <div class="span4">
			 <span class="label label-success">Search!</span> <br><br>
			 <ul>
			    <li> <form class="form-search" action="<?php echo get_the_option('site_address');?>" method="get">
					<div class="input-append">
					<input type="text" class="span8 search-query" name="search">
					<button type="submit" class="btn">Search</button>
					</div>
				</form></li>
			</ul>	
			 <span class="label label-success">Lasted Content</span> 
				<h4><?php lasted_content_list(25,true) ?></h4>
			<span class="label label-success">Popular Post</span> 
				<h4><?php popularpost_list(10,true,false) ?></h4>
        </div>
      </div>
<?php include('footer.php'); ?>