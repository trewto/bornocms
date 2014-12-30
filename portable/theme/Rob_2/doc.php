<?php include('header.php'); ?>
<div class="row-fluid marketing">
        <div class="span12">
				<h4><a href="<?Php echo doc_link($_GET['doc']); ?>"><?php echo get_the_doc_page($_GET['doc'],'title'); ?></a></h4>
		</div>
		<?php echo get_the_doc_page($_GET['doc'],'content'); ?>
</div>
<?php include('footer.php') ;?> 