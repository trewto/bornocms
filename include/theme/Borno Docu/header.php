<?php
/*
*	Borno Docu Theme
*	Display all content map , category base
*
*/
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		

		<!-- Meta tag-->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta charset="utf-8">
		<!-- Meta tag end-->
		
		
		<!-- Displaying the title -->
		<title><?php echo the_title(); ?></title>
		
		<!-- stylesheet-->
		<link href="<?php echo theme_directory() ;?>/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo theme_directory() ;?>/css/bootstrap-responsive.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="<?php echo theme_directory() ;?>/style.css" rel="stylesheet">
		<!--stylesheet end-->
		
		<?php
		//you must add header view on every header.php file
		header_view() ;

		?>
		
	</head>
<body>
	<div id="content" class="content">
	
		<!-- header section -->
		<div id="header">
		
			<!--displaying the title-->
			<h1>
				<a href="<?php echo get_the_option("site_address"); ?>" class="title"><?php echo get_the_option("site_name"); ?></a>
			
			</h1>
			
			<!--Displaying the description -->
			<div class="description"><?php echo get_the_option("site_description"); ?></div>
				
		
		</div><!-- #header -->
		
		<hr> 
		
		