<?php include('header.php'); ?>
	<h1 class="jumbotron"><?php echo get_the_option('site_description');?></h1>
	<hr>
	<!--
	 <span class="label label-important">404 Error No result found</span> 
	 <span class="label label-info">The content you are looking for is not found </span> 
-->
<h1 class="text-error">404 Not Found</h1>
<span class=" text-warning">The page you are looking for is not found </span>
<?php /*
<hr><!--
      <div class="row-fluid marketing">
	 	
        <div class="span6">
		<?php lasted_comment(5); ?>
        </div>

        <div class="span6">
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
      </div>-->
	  */?>
<?php include('footer.php'); ?>