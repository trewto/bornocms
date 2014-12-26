<?php include "header.php" ; ?>
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
			
			
				  <div class="post-preview">
                        <h2 class="post-title">
<a href="<?Php echo doc_link($_GET['doc']); ?>"><?php echo get_the_doc_page($_GET['doc'],'title'); ?></a>
                        </h2>
                        <h3 class="post-subtitle">
<?php echo get_the_doc_page($_GET['doc'],'content'); ?>
                        </h3>
                </div>
                <hr>		
				
            </div>
        </div>
    </div>
<?php include "footer.php" ; ?>

