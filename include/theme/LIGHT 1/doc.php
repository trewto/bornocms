<?php include('header.php'); ?>
			<div class="primary span8">
				<div id="post" class="postarea">
					<div class="single-title">
						<h4>
							<a href="<?Php echo doc_link($_GET['doc']); ?>"><?php echo get_the_doc_page($_GET['doc'],'title'); ?></a>
						</h4>
					</div>
					<div class="main-content">
					<?php echo get_the_doc_page($_GET['doc'],'content'); ?>
					</div>
				</div>
			</div>
<?php include('sidebar.php') ;?>
<?php include('footer.php') ;?>