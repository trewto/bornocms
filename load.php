<?php
   /*	Borno CMS
	*	This is the Borno cms load file
	*	load.php
	*	this page load all the function of this site
	*
	*
	*
	*/
	
	
	/*	Disable error reporting  */
	//	error_reporting(0);
   
   
   /* security package */
	require_once('include/function/security.php');//opening the security.php , security file . 

	/* site-installer package */
	require_once('include/function/site-install.php'); // include the site install function . 

	
	/* function package */
	if(file_exists('config.php'))
	require_once('include/function/function.php');//include the site function . 


	/* theme package */
	if(file_exists('config.php'))
	require_once('include/theme-opener.php');

	