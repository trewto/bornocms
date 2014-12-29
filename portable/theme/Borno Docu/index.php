<?php 
	//include header
	include("header.php");

?>
		<div id="mainarea" class="mainarea row-fluid">
			<!-- primary area-->
			<div class="primary span8">
				<?php 
					//display category base content
					$cat_query = borno_query("SELECT * FROM prefix_category ORDER by id desc");
					
					while($row = mysqli_fetch_array($cat_query)){
						
						echo "<h3><b>".$row['name']."</b></h3><hr>";
						
					
	
						//query
						$cat_content_query =	borno_query("SELECT * FROM prefix_content , prefix_categorymeta WHERE  prefix_categorymeta .cat_id = {$row['id']} and  prefix_categorymeta.post_id = prefix_content.id and post_status='publish' and post_level='public' ");
						
						//get tge contents of each category
						while($contents = mysqli_fetch_array($cat_content_query)){
							
							
							echo the_post_link($contents[0])."<br>";
						
						}
						
						echo '<br>';
					}
				?>
			
			
			</div><!--#primary-->
			
			<?php
				include("sidebar.php");//including sidebar
			?>
		
		
		</div><!--#mainarea-->


<?php 
	//include footer
	include("footer.php");

?>