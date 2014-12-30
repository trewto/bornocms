<div class="sidebar span4">
		
				
				<?php 
				
				if( check_sidebar_widget('Right') ){
						display_sidebar('Right' ,'widget','widget_title');				
				}else{
				?>
				<div class="widget">
					<div class="widget_title">Search</div>
					<div class="widget_content">

					<form method="get" class="center" action="<?php echo get_the_option('site_address');?>">
							<input type="text" name="search"  value="<?php if(isset($_GET['search'])){echo htmlspecialchars($_GET['search']);}?>"/>
						
							<button class="btn" type="submit">Search!</button>
						</form>
					</div>
				</div>
				
				<div class="widget">
					<div class="widget_title">
					<?php
						if(!user_logged_in()){
							echo 'Sign in';
							}
							else{
								echo 'Sidebar Panel';
							}
					?>
					</div>
					<div class="widget_content">
						<?php login_widget() ?>
					</div>
				</div>
				
				<div class="widget">
					<div class="widget_title">Lasted Content</div>
					<div class="widget_content">
						<?php lasted_content(5) ?>
					</div>
				</div>
				
				
					
				<div class="widget">
					<div class="widget_title">Recent Comment</div>
					<div class="widget_content">
						<?php lasted_comment(5); ?>
					</div>
				</div>
				
				<div class="widget">
					<div class="widget_title">Popular Content</div>
					<div class="widget_content">
					<?php popularpost(5) ;?>
					</div>
				</div>
				<?php
				}
				
				?>
			
			
				
				
			</div>