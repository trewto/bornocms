		<div class="navbar navbar-inverse navbar-fixed admin_top_menu"><!-- navbar navbar-inverse navbar-fixed-top -->
              <!-- div class="navbar-inner" -->
              <div class="navbar-simple">
                <div class="container containermenu">
		
				 <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
		 <a class="brand" href="<?php echo admin_url(); ?>">Admin</a>

			 <div class="nav-collapse collapse">

                  <ul class="nav" role="navigation">
                   






			
					
						<!-- content menu -->	
				<?php if(user_can('edit_own_post') or user_can('edit_all_post') or user_can('new_post')  or user_can('edit_category') or user_can('add_category') or anp_page_array_count("content")!=0) { ?>
                    <li class="dropdown">
                      <a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Content <b class="caret"></b></a>
					 <ul class="dropdown-menu" role="menu" aria-labelledby="drop1" >
						<?php if(user_can('new_post')){?>
                        <li><a href="<?php echo admin_url() ?>/?pages=editor">Add New</a></li>
						<?php } ?>
						<?php  if(user_can('edit_own_post') or user_can('edit_all_post')) {?>
                        <li><a href="<?php echo admin_url() ?>/?pages=managepost&by=user">Manage Content</a></li>
						<?php } ?>
						<?php  if(user_can('add_category')) {?>
                        <li><a href="<?php echo admin_url() ?>/?pages=addcat">Add Category</a></li>
						<?php } ?>
						<?php  if(user_can('edit_category')) {?>
                        <li><a href="<?php echo admin_url() ?>/?pages=catlist">Manage Category</a></li>
						<?php } ?>
						 <?php anp_the_page_ul_li("content"); ?> 
                      </ul>	
                    </li>
					<?php } ?>
					
					
					
					
					
					
					
					
						<!-- Doc menu -->
					<?php if(user_can('manage_doc') or anp_page_array_count("doc")!=0){ ?>
					  <li class="dropdown">
                  
				  	
						<a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Document <b class="caret"></b></a>
                       <ul class="dropdown-menu" role="menu" aria-labelledby="drop1" >
                        <li><a   href="<?php echo admin_url() ?>/?pages=doceditor">Add New Doc</a></li>
                        <li><a   href="<?php echo admin_url() ?>/?pages=managedoc">Manage Doc</a></li>
						 <?php anp_the_page_ul_li("doc"); ?> 
                      </ul>
                    </li>
					<?php } ?>
					
					
					
					
					<!-- User menu -->
					
						<?php if(user_can('manage_user') or  user_can('add_user') or anp_page_array_count("user")!=0){ ?>
						 <li class="dropdown">
					  	<a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Users <b class="caret"></b></a>
						
						   <ul class="dropdown-menu" role="menu" aria-labelledby="drop1" >
							<?php if(user_can('add_user')){ ?>
							<li><a   href="<?php echo admin_url() ?>/?pages=add-user">Add User</a></li>
							<?php } if(user_can('manage_user')){ ?>
							<li><a   href="<?php echo admin_url() ?>/?pages=manageuser">Manage User</a></li>
							<?php ; } ?>
							 <?php anp_the_page_ul_li("user"); ?> 
						  </ul>
						</li>
					<?php } ?>
					
					
					
					
					<!-- admin menus -->
					<?php if( user_can('manage_site')  or anp_page_array_count("admin")!=0){ ?>
					<li class="dropdown"> 
						<a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Appearance  <b class="caret"></b></a>
				
                      <ul class="dropdown-menu" role="menu" aria-labelledby="drop1" >
					  <?php if(user_can('manage_site')) { ?>
                        <li><a   href="<?php echo admin_url() ?>/?pages=sitesetting">Site Setting</a></li>
						<?php } ?><!--
						<?php if(user_can('back_up')) { ?>
                        <li><a   href="<?php echo admin_url() ?>/?pages=backup">Backup</a></li>
						<?php } ?>-->
						 <?php anp_the_page_ul_li("admin"); ?> 
                      </ul>
                    </li>
					
					<?php } ?>
					
					
					<!-- notification -->
					<li class="dropdown">
						<a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> Notification<b class="caret"></b></a>
					
						
					  <?php
						$notification_user= loginuserinfo('id');//current user id
						$tnotify =notify_user_count($notification_user); // total number of notify
					  ?>
					  
                     <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                        <li><a href="<?php echo admin_url() ?>/?pages=notify">Notify <span class="label label-success"><?php echo $tnotify ;?></span></a></li>
						<li><a   href="<?php echo admin_url() ?>/?pages=manage-comment">Comments</a></li>
						 <?php anp_the_page_ul_li("notify"); ?> 

                      </ul>
                    </li>
					
				
				
				<!-- more pages -->
				<?php if(anp_page_array_count()!=0){ ?>
					 <li class="dropdown">
												<a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> More Pages<b class="caret"></b></a>

						  <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
							 <?php anp_the_page_ul_li(); ?>   

						  </ul>
                    </li>
					<?php } ?>
					
					
					
				 

					
					
					
					
					
					
					
					
					
					
					
					
                  </ul>
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
                  <ul class="nav pull-right">
                 	
				<!-- profile menus -->	
				
				 <li class="dropdown">
					<a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> Profile<b class="caret"></b></a>

                        <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
							<!-- displaying the user profile link -->
                        	<?php 	if(get_the_option('site_permalink')=='dynamic'){ ?>

							 <li><a   href="<?php echo get_the_option('site_address').'/profile/'.loginuserinfo('username'); ?>">Visit Profile</a></li>
								<?php } else{ ?>
								 <li><a   href="<?php echo get_the_option('site_address').'/?profile='.loginuserinfo('username'); ?>">Visit Profile</a></li>
								
							 <?php } ?>

						<li><a href="<?php echo admin_url() ?>/?pages=changepassword">Change Password</a></li>
                        <li><a href="<?php echo admin_url() ?>/?pages=profilesetting">Profile Setting</a></li>

						<!-- display the contact form link -->
                        <li class="divider"></li>
						<?php if(get_the_option('contactfrom')=='true'){ 
						if(get_the_option('site_permalink')=='dynamic'){
							$output .= '<li><a href="'.get_the_option('site_address').'/document/contact/">Contact</a></li>';
						}
						else{
							$output .= '<li><a href="'.get_the_option('site_address').'/?doc=contact">Contact</a></li>';
						}
						
						echo $output;
						
						} ?>
							  <?php anp_the_page_ul_li("profile"); ?>
							  
						<li><a href="<?php echo get_the_option('site_address').'/sign-out.php'; ?>">Logout</a></li>  
                        </ul>
                      </li> 
                  </ul>
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				            </div>

                </div>
              </div>
            </div> <div class="homeheadmargin"></div><br><!-- /navbar-example -->