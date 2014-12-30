<!DOCTYPE html>
<!--[if lt IE 8 ]><html class="no-js ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="no-js ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 8)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>

   <!--- Basic Page Needs
   ================================================== -->
   <meta charset="utf-8">
	<title><?php echo the_title(); ?></title>
	<!--
	<meta name="description" content="">  
	<meta name="author" content="">-->

   <!-- CSS
    ================================================== -->
	<link rel="stylesheet" href="<?php echo theme_directory() ;?>/css/default.css">
	<link rel="stylesheet" href="<?php echo theme_directory() ;?>/css/layout.css">  
	<link rel="stylesheet" href="<?php echo theme_directory() ;?>/css/media-queries.css"> 
	<link rel="stylesheet" href="<?php echo theme_directory() ;?>/style.css"> 

   <!-- Script
   ================================================== -->
	<script src="<?php echo theme_directory() ;?>/js/modernizr.js"></script>

   <!-- Favicons
	================================================== -->
	<!--<link rel="shortcut icon" href="favicon.png" >-->

</head>

<body>

   <!-- Header
   ================================================== -->
   <header id="top">

   	<div class="row">

   		<div class="header-content twelve columns">

		      <h1 id="logo-text"><a href="<?php echo get_the_option('site_address');?>"><?php echo get_the_option('site_name');?></a></h1>
				<p id="intro"><?php echo get_the_option("site_description");?></p>

			</div>			

	   </div>

	   <nav id="nav-wrap"> 

	   	<a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show Menu</a>
		   <a class="mobile-btn" href="#" title="Hide navigation">Hide Menu</a>

	   	<div class="row">    		            

			  <!-- 	<ul id="nav" class="nav">
			      	<li class="current"><a href="index.html">Home</a></li>
			      	<li class="has-children"><a href="#">Dropdown</a>
	                  <ul>
	                     <li><a href="#">Submenu 01</a></li>
	                     <li><a href="#">Submenu 02</a></li>
	                     <li><a href="#">Submenu 03</a></li>
	                  </ul>
	               </li>
	               <li><a href="demo.html">Demo</a></li>	
	               <li><a href="archives.html">Archives</a></li>
			      	<li class="has-children"><a href="single.html">Blog</a>
							<ul>
	                     <li><a href="blog.html">Blog Entries</a></li>
	                     <li><a href="single.html">Single Blog</a></li>	                     
	                  </ul>
			      	</li>		      	
			      	<li><a href="page.html">Page</a></li> -- >
			   	</ul> <!-- end #nav -->			   	 
			<?php
			//view_menu($ul_class='mainul nav',$main_li_class='mainli',$main_li_sub='',$sub_ul_class='subul',$sub_li_class='subli nav',$deep_ul_class='nav deel_ul',$deel_li_class='deep_li')
			
			view_menu("nav");
			?>
	   	</div> 

	   </nav> <!-- end #nav-wrap --> 	     

   </header> <!-- Header End -->
   
   
  
   <!-- Content
   ================================================== -->
   <div id="content-wrap">

   	<div class="row">
 