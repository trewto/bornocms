<?php include('header.php'); ?>
		
			<div class="primary span8">	
			<?Php 
			$get_user=htmlspecialchars($_GET['profile']);
			echo '	<div class="border userupmargin"></div> ';
			echo '<div class="userinfo">';
			$e =  the_user_by_username($get_user,'email');//user email
			echo '<img style="text-align:center" class="avatar img-polaroid" src="'.get_gravatar( $e, 100).'" />'; // user gravater

			//username or name funciton 
			$user_id =   the_user_by_username($get_user,'id');
				//name
				echo '<h4 class="p-user-about"><b>'.user_profile_link($user_id).'</b></h4>';
			
			
			//row thing
		
			$i  = the_user_by_username($get_user,'about');// user description
			if(!empty($i)){
							echo '<p class="p-user-about">';

					echo nl2br($i);//display user description or about
								'</p><br>';

			}
			$id = the_user_by_username($get_user,'id');
			echo '<p class="p-user-about">The user write '. site_count($id,'user_total_post').' Content</p>';
			echo '<p class="p-user-about"><u>'.social_profile($id,'fb').' '.social_profile($id,'twitter').'</u></p>';

			echo '</div>';
			
			?>
			<!--	<div class="border"></div> -->
				<?php if(have_post()):while($content = the_nav() ): ?>	
			<div id="post" class="postarea">
				<div class="title">
					<h4><a href="<?php echo get_the_option('site_address').'/content/'.$content['id'];?>"><?php echo $content['title']; ?></a></h4>
				</div>
			
			<span class="meta-info"><i>Write By <?php echo display_name($content['user_id']) ; ?> </i> , Date: <?php echo the_time($content['times'],'d.m.Y') ; echo ' , '.count_the_post_comment($content['id']).' Comment';?> </span> 
					<br>

				<div class="main-content">
				<?php
				echo post_excerpt($content['content'],0,0);
				echo "<a href='".get_the_option('site_address')."/content/".$content['id']."' class='btn '>Read More</a>";
				?><br><br><br>
				</div>
			</div>
		<?php endwhile;else :?>
			<center><h3>Not Found</h3>
			<div class="border">There are no content in this page.</div></center>
		<?php endif;?>
		
			
				<ul class="pager">
				<li class="previous">
					<?php  previous_page_link() ;?>
				</li>
				<li class="next">
					<?php  next_page_link() ;?>
				</li>
				</ul>
			</div>
			<?php include('sidebar.php') ;?>
			<?php include('footer.php') ;?>