<?php include('header.php'); ?>
	<h1 class="jumbotron"><?php echo get_the_option('site_description');?></h1>
	<hr>

      <div class="row-fluid marketing">
	 	
        <div class="span6">
			<?php if(have_post()):while($content = the_nav() ): ?>
				<h4><?php echo the_post_link($content['id']);?></h4>
				<p><?php	echo the_excerpt($content['content'],40);?></p>
			<?php endwhile ;else :?>
				No result found
			<?php endif ;?>
					
			<ul class="pager">
				<li class="previous">
					<?php  previous_page_link() ;?>
				</li>
				<li class="next">
					<?php next_page_link();?>
				</li>
			</ul>	
        </div>

        <div class="span6">
			<div class="userinfo">
			<?Php 
				$get_user=htmlspecialchars($_GET['profile']);
				echo '	<div class="border userupmargin"></div> ';
				echo '<div class="userinfo">';
				$e =  the_user_by_username($get_user,'email');//user email
				echo '<img  class="img-polaroid" src="'.get_gravatar( $e, 100).'" />'; // user gravater

				//username or name funciton 
				
					//name
					echo '<h4 class="p-user-about"><b><a href="'.get_the_option('site_address').'/profile/'.$get_user.'">'.the_user_dispay_name($get_user).'</a></b></h4>';
				
				$id = the_user_by_username($get_user,'id');
				echo '<p class="p-user-about">The user write '. site_count($id,'user_total_post').' Content</p>';
				//row thing
			
				$i  = the_user_by_username($get_user,'about');// user description
				if(!empty($i)){
								echo '<p class="p-user-about">';

						echo $i;//display user description or about
									'</p><br><br>';

				}
				
				echo ' <br>'.social_profile($id,'fb').'  '.social_profile($id,'twitter').'';

				echo '</div>';
				
				?>
			</div>
		</div>
      </div>
<?php include('footer.php'); ?>