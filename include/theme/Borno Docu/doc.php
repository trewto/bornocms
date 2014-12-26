<?php 
	//include header
	include("header.php");

?>
		<div id="mainarea" class="row-fluid">
			<!-- primary area-->
			<div class="primary span8">
			
			<h3>
				<a href="<?Php echo doc_link($_GET['doc']); ?>"><?php echo get_the_doc_page($_GET['doc'],'title'); ?></a>
			</h3><hr>
			
			<?php echo get_the_doc_page($_GET['doc'],'content'); ?>
			
			</div><!--#primary-->
			
			<?php
				include("sidebar.php");//including sidebar
			?>
		
		
		</div><!--#mainarea-->


<?php 
	//include footer
	include("footer.php");

?>