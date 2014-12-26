<!DOCTYPE html>
<?php if(!isset($prefix_content)){die('what?');}?>
<head>
	<title><?php echo $title ; ?></title>
	<meta charset="UTF-8">
	<!-- bootstrap css-->
	<link rel='stylesheet' href="<?php echo theme_directory() ;?>/bootstrap/css/bootstrap.css">
	<link rel='stylesheet' href="<?php echo theme_directory() ;?>/bootstrap/css/bootstrap-responsive.css">
	<!-- bootstrap css end-->
	
	<!-- custom css-->
	<link rel='stylesheet' href="<?php echo theme_directory() ;?>/style.css">
	<!-- custom css end-->
	
	<!-- bootstrap js-->
	<script type="text/javascript" src="<?php echo theme_directory() ;?>/bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo theme_directory() ;?>/bootstrap/js/bootstrap.js"></script>

	<!-- bootstrap js end-->
	
	<?php header_view() ; ?>
</head>
<body>
	<div class="content">
		<div class="header">
			
			<div class="topmenu">
				<div class="pull-right"> 
					<?php if(get_the_option('site_permalink')=='dynamic'){ ?>
					<a href="<?php echo get_the_option('site_address');?>/document/list">Document</a> -
					<?php if(get_the_option('contactfrom')=='true') { ?>
					<a href="<?php echo get_the_option('site_address');?>/document/contact">Contact</a>- 
					<?php } ?>
					<?php }else{?>
					<a href="<?php echo get_the_option('site_address');?>/?doc=list">Document</a> -
					<?php if(get_the_option('contactfrom')=='true') { ?>
					<a href="<?php echo get_the_option('site_address');?>/?doc=contact">Contact</a>- 
					<?php } } ?>
					<?php if(user_logged_in()){
					
					
					//echo 'Welcome '.loginuserinfo('username').' - ';
					//$id  = loginuserinfo('id');
					
					//echo '<a href="'.get_the_option('site_address').'/profile/'.loginuserinfo('username').'">'.display_name($id).'</a> - ';
					
					if(user_can('new_post')){
						echo '<a href="'.get_the_option('site_address').'/admin/?pages=editor"> New Content  </a> - ';
					}
					echo '<a href="'.get_the_option('site_address').'/admin/"> Admin Panel </a> - ';
					 echo login_back_url() ;
					}
					else{ 
					
					?>
					<a href="<?php echo get_the_option('site_address');?>/sign-in.php?forget=true">Forget Password?</a> 
					<?php if(is_signup()) { ?>
					<a href="<?php echo get_the_option('site_address');?>/sign-up.php">Register</a> -  
					<?php } ?>
					<a href="<?php echo get_the_option('site_address');?>/sign-in.php?back=<?php echo current_url(); ?>">Sign In</a> 
					<?php  } ?>

				</div><br>
			</div>
			<h1 class="headertitle"><a href="<?php echo get_the_option('site_address');?>"><?php echo get_the_option('site_name');?></a></h1>
			<p class="des"><?php echo get_the_option('site_description');?></p>
			<div class="border"></div>
			<div class="top_menu_bar">
				<form  method="get" action="<?php echo get_the_option('site_address');?>" class="header_search" >
					<div class="input-append">
						<input type="text" id="appendedInputButtons" placeholder="keyword" value="<?php if(isset($_GET['search'])){echo htmlspecialchars($_GET['search']);}?>" name="search" class="span2">
						<button type="submit" class="btn">Search!</button>
					</div>
				</form>
			</div>
		</div>
		<br>
				<div class="mainarea row-fluid">
