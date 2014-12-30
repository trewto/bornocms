<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title ?></title>
  <link href="<?php echo theme_directory() ;?>/style.css" rel="stylesheet">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  
		<?php
		//you must add header view on every header.php file
		header_view() ;

		?>
		
 </head>
 <body>
  <header class="headerbar">
   <div class="container">
    <div class="title">
	 <h1 class=""><a href="<?php echo get_the_option('site_address'); ?>"><?php echo get_the_option('site_name'); ?></a></h1><br>
	 <p><?php echo get_the_option('site_description'); ?> </p>
	</div>
   </div>
  </header>
  
  
  
  <div class="menubar">
   <div class="container">
    <div class="navbar navbar-inverse">
     <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
      </button>
     </div>
     <div class="navbar-collapse collapse navbar-inverse-collapse">
  
  <?php 
  echo view_menu("nav navbar-nav",'','dropdown','dropdown-menu','data-toggle="dropdown"');
  ?>
  
      <form class="navbar-form navbar-right">
		<input type="text" class="form-control col-lg-8" name='search' placeholder="Search">
      </form>
     </div>
    </div>   
   </div>
  </div>
  
  
  