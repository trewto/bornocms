<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- BOOTSTRAP STYLES-->

    <link href="<?php echo admin_url(); ?>/theme/sb_admin/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="<?php echo admin_url(); ?>/theme/sb_admin/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="<?php echo admin_url(); ?>/theme/sb_admin/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
	      <!-- MORRIS CHART STYLES-->
    <link href="<?php echo admin_url(); ?>/theme/sb_admin/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="<?php echo admin_url(); ?>/theme/sb_admin/custom.css" rel="stylesheet" />
    <link href="<?php echo admin_url(); ?>/theme/sb_admin/css/phpcss.php" rel="stylesheet" />
	 <!-- JQUERY SCRIPTS -->
	      <script src="<?php echo admin_url(); ?>/theme/sb_admin/js/jquery-1.10.2.js"></script>
	<?php
	
		//include custom stylesheet
		//echo '<link rel="stylesheet" href="'.get_the_option('site_address').'/admin/css/phpcss.php"/>';
		
		//meta tag , disallow robot to nofollow and noindex
		echo '<meta name="robots" content="noindex, nofollow" />';
		
		//display the title
		echo '<title>'.$title.'</title>';
		
		//display the header 
		header_view();
		
		// if isset ?pages=editor than set $editor = contenteditor
		if(isset($_GET['pages'])){
			if($_GET['pages']=='editor'){
				$editor = 'contenteditor';
			}
			else{
				$editor = '';

			}
		}
		else{
				$editor = '';

		}
	?>	
	
	
	<!-- include the google font
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' /> -->
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
		
            <div class="navbar-header">
			
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				
				<!-- Display the admin panel title -->
                <a class="navbar-brand" href="<?php echo get_the_option('site_address'); ?>">Administration</a>
				
            </div>
			
			
			
					<?php 
					/*
					*	Get the contact from url
					*
					*/
						 if(get_the_option('site_permalink')=='dynamic') { 
							$contact_url =  get_the_option('site_address')."/document/contact";
						 }else{
							$contact_url =  get_the_option('site_address')."/?doc=contact";
						 }
					 ?>

		
			
			
			
				
			<div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;"> 


				<?php if(get_the_option('contactfrom')=='true') { ?>
				
				<!-- Displaying the contact from link -->
				<a href="<?php echo $contact_url ?>" class="btn btn-danger square-btn-adjust">Contact</a> 
				
				<?php }?>
				
				<!-- Displaying the logout url -->
				<a href="<?php echo get_the_option('site_address').'/sign-out.php'; ?>" class="btn btn-danger square-btn-adjust">Logout</a> 
				
			</div>
        </nav>   
		
		
           <!-- /. NAV TOP  -->
		   
		   
		 <!-- 
			Starting the menus		 
		 -->  
        <nav class="navbar-default navbar-side" role="navigation">
		
            <div class="sidebar-collapse">
			
                <ul class="nav" id="main-menu">
				
			
			
				<!--  index menu -->	
				<li>
					<a href="index.php"><i class="fa fa-dashboard fa-2x"></i> Dashboard</a>
				</li>
				
					
					
				<!-- content menu -->	
				<?php if(user_can('edit_own_post') or user_can('edit_all_post') or user_can('new_post')  or user_can('edit_category') or user_can('add_category') or anp_page_array_count("content")!=0) { ?>
                    <li>
					 <a href="#"><i class="fa fa-edit fa-2x"></i>Content<span class="fa arrow"></span></a>
                      <ul class="nav nav-second-level" >
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
					  <li>
                  
				  	<a href="#"><i class="fa  fa-archive fa-2x"></i>Document<span class="fa arrow"></span></a>
                       <ul class="nav nav-second-level" >
                        <li><a   href="<?php echo admin_url() ?>/?pages=doceditor">Add New Doc</a></li>
                        <li><a   href="<?php echo admin_url() ?>/?pages=managedoc">Manage Doc</a></li>
						 <?php anp_the_page_ul_li("doc"); ?> 
                      </ul>
                    </li>
					<?php } ?>
					
					
					
					
					<!-- User menu -->
					
						<?php if(user_can('manage_user') or  user_can('add_user') or anp_page_array_count("user")!=0){ ?>
						 <li>
					  
						<a href="#"><i class="fa  fa-user fa-2x"></i>Users<span class="fa arrow"></span></a>
						
						   <ul class="nav nav-second-level" >
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
					<li> 
					<a href="#"><i class="fa fa-desktop fa-2x"></i>Admin<span class="fa arrow"></span></a>
				
                      <ul class="nav nav-second-level" >
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
					<li>
						<a href="#"><i class="fa  fa-comment   fa-2x"></i>Notification<span class="fa arrow"></span></a>
						
					  <?php
						$notification_user= loginuserinfo('id');//current user id
						$tnotify =notify_user_count($notification_user); // total number of notify
					  ?>
					  
                     <ul class="nav nav-second-level">
                        <li><a href="<?php echo admin_url() ?>/?pages=notify">Notify <span class="label label-success"><?php echo $tnotify ;?></span></a></li>
						<li><a   href="<?php echo admin_url() ?>/?pages=manage-comment">Comments</a></li>
						 <?php anp_the_page_ul_li("notify"); ?> 

                      </ul>
                    </li>
					
				
				
				<!-- more pages -->
				<?php if(anp_page_array_count()!=0){ ?>
					 <li>
						<a href="#"><i class="fa fa-sitemap fa-2x"></i> More Pages<span class="fa arrow"></span></a>
						  <ul class="nav nav-second-level">
							 <?php anp_the_page_ul_li(); ?>   

						  </ul>
                    </li>
					<?php } ?>
					
					
					
					
				<!-- profile menus -->	
				
				 <li>
                        <a href="#"><i class="fa  fa-male fa-2x"></i> Profile<span class="fa arrow"></span></a>
						
                        <ul class="nav nav-second-level">
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
            
        </nav>  
        <!-- /. NAV SIDE  -->