<!DOCTYPE html>
<head>
	
	<meta charset="UTF-8">
	<!-- bootstrap css-->
	<link rel='stylesheet' href="<?php echo theme_directory() ;?>/bootstrap/css/bootstrap.css">
	<link rel='stylesheet' href="<?php echo theme_directory() ;?>/bootstrap/css/bootstrap-responsive.css">
	<!-- bootstrap css end-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- custom css-->
	<link rel='stylesheet' href="<?php echo theme_directory() ;?>/style.css">
	<!-- custom css end-->
	
	<!-- bootstrap js-->
	<script type="text/javascript" src="<?php echo theme_directory() ;?>/bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo theme_directory() ;?>/bootstrap/js/bootstrap.js"></script>
	<!-- bootstrap js end-->
	<title><?php echo $title ; ?></title>
</head>
<body>
<div class="container-narrow">
<div class="masthead">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="<?php echo get_the_option('site_address'); ?>">Home</a></li>
		  <?php if(user_logged_in()){ ?>
			<li><a href="<?php echo get_the_option('site_address');?>/admin/">Admin</a></li>
			<?php }?>
			
			<?php if(is_contact_enable()) { ?>
				<li><a href="<?php echo get_the_option('site_address');?>/document/contact">Contact</a></li>
			<?php } ?>
			<?php if(user_logged_in()){ ?>
				<li> <?php echo login_back_url() ;?></li>
			<?php }else{ ?>
				<li><a href="<?php echo get_the_option('site_address');?>/sign-in.php">Sign In</a> </li>
			<?php } ?>
		</ul>
        <h3 class="muted"><?php echo get_the_option('site_name');;?></h3>
</div>

<hr>