<!doctype html>

<head>
	<!--title-->
	<title><?php echo the_title() ; ?></title>
	<meta charset="utf-8">
	<!--css-->
	<link rel="stylesheet" href="<?php echo theme_directory() ;?>/style.css"/>
	
	<!--js-->
	
	<!--rss-->
	
	<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo get_the_option("site_address");?>/feed.php" />
	
	<!-- header-->
		<?php header_view() ; ?>
</head>


<body>
	<div id="mainarea">
		<div id="header1">
			<h1 class="name"><a href="<?php echo get_the_option('site_address'); ?> "><?php echo get_the_option("site_name"); ?></a></h1>
			
				<form action="<?php echo get_the_option('site_address');?>" class='search' method="get">
					<input type='text' name='search'>
				</form>
		</div>
		
		<div id="header2">
			<?php echo get_the_option('site_description'); ?>
		</div>