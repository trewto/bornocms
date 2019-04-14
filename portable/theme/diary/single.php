<?php include "header.php" ;?>
		
		<!--<div id="contentarea">-->
		<div class="contentarea">
			<div id="primary">
				
				
					<div class="main_content">
					
						<h2 class="title">
							<?php echo the_post_link($post_id);?>
						</h2><!--.title-->
						<i>
							<span class="byline">		
								<?php 
								
									echo date_of_post($post_id,'d-m-y');
							
								
								?>
								</span></i><br><br>
						<div class=" container view">
														<?php 
														
														
														
					$r = ( get_meta('encryption' ,$_GET['p']));
					
					
					//$p = get_the_post($_GET['p'],'content');
					$p = post_content($_GET['p'],'content');
					
					if($r['value']=="1"){ 
						if(isset($_SESSION["073236e1ada0f3c20304d6d650e586aa"])){
						$p  = x012x29( $p , x012x29($_SESSION["073236e1ada0f3c20304d6d650e586aa"],"@@@##"));
						}
						else{
							$p= "dummy data";
						}
					}
					else{
						
					}
					
				echo  nl2br($p);
					
														
														
		
			echo '<br>';
			
			if(( user_can("edit_own_post") && get_the_post($_GET['p'],'user_id')==loginuserinfo('id')) or user_can("edit_all_post") ){
			
			
				echo "<a  href='".get_the_option('site_address')."/?doc=3&c=".$_GET['p']."'>Edit</a>";
			//echo content_edit_link($post_id,get_the_option('site_address'),loginuserinfo('id'));
			}
				?>
						</div><!--#content-->
						<div class='border'></div>
					</div><!--.artcle-->
					
				<?php 
					include('comment.php');
				?>
			</div>
			
			
		</div>
		
		<?php include "footer.php" ;?>
	