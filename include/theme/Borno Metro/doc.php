<?php include('header.php'); ?>
  <div class="main-content">
   <div class="container">
    <div class="content col-md-8 col-xs-12 col-sm-12">
	
	

	<div class="row">
	  <h3><a href="<?Php echo doc_link($_GET['doc']); ?>"><?php echo get_the_doc_page($_GET['doc'],'title'); ?></a></h3>

	  	
							<?php echo get_the_doc_page($_GET['doc'],'content'); ?><br>

	
	 </div>


	 
	</div>
	<?php include('sidebar.php'); ?>
	<?php include('footer.php'); ?>