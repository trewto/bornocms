<!doctype html>

<head>
	<!--title-->
	<title><?php echo the_title() ; ?></title>
	<meta charset="utf-8">
	<!--css-->
	<link rel="stylesheet" href="<?php echo theme_directory() ;?>/style.css"/>
	
	<!--js-->
	

	<!-- bootstrap css-->
	 <link href="<?php echo theme_directory() ;?>/css/bootstrap.min.css" rel="stylesheet">
	<link rel='stylesheet' href="<?php echo theme_directory() ;?>/css/bootstrap-responsive.css">
	<!-- bootstrap css end-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<!--rss-->
	
	<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo get_the_option("site_address");?>/feed.php" />
	
	<!-- header-->
		<?php header_view() ; ?>
</head>


<body>
	<div id="mainarea container" class="container">
	
	
	<?php// if(!is_single()){?>
	<div class="navbar ">
		<div id="header1" class="nav navbar-nav">
			<div class="name"><a href="<?php echo get_the_option('site_address'); ?> "><?php echo get_the_option("site_name"); ?></a></div>
			
				<!--<form action="<?php echo get_the_option('site_address');?>" class='search' method="get">
					<input type='text' name='search'>
				</form>-->
				<div id="header2">
			<?php echo get_the_option('site_description'); ?>
		</div>
		</div>
		
		
		<?php// }?>
		
		  <form class="navbar-form navbar-right">
			<input type="text" class="form-control" name='search' placeholder="Search">
			</form>
		
	</div>
		<br>