<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo the_title() ; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo theme_directory() ;?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo theme_directory() ;?>/css/clean-blog.min.css" rel="stylesheet">
    <link href="<?php echo theme_directory() ;?>/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo theme_directory() ;?>/style.css" rel="stylesheet">

    <!-- Custom Fonts -->

	<!--feed-->
	<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo get_the_option("site_address");?>/feed.php" />

		
	<?php header_view(); ?>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<a class="navbar-brand" href="<?php echo get_the_option('site_address'); ?> "><?php echo get_the_option("site_name"); ?></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<?php view_menu("nav navbar-nav navbar-right") ?>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('<?php echo theme_directory() ;?>/img/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1><?php echo get_the_option("site_name"); ?></h1>
                        <hr class="small">
                        <span class="subheading"><?php echo get_the_option("site_description"); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </header>
