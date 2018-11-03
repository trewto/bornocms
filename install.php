<?php
	/*
	 *	install.php 
	 *	
	 *	@package:Borno CMS
	 *	@sub-package:install
	 *	
	 *	
	 *
	 *
	 *
	 *
	 */
	 
	 
	/* 
	 *	Stop the error report of this page
	 *
	 */
	#error_reporting(0);
	ob_start();

	
	/*
	 *	include the function page
	 */
	 
	include('include/function/site-install.php');

	/*
	 *
	 *
	 *	html header
	 *
	 */
	echo '<!DOCTYPE html>';
	echo '<head>';
	echo '<meta charset="UTF-8">';
	echo '<title>Install Borno CMS</title>';
	echo '<link rel="stylesheet" href="assets/bootstrap/bootstrap.css" />';
	echo '<link rel="stylesheet" href="assets/css/core.css" />';
	echo '<style>body{margin-top:5px;}</style>';
	echo '</head>';
	echo '<body>';


	
	/*
	 *
	 *	if config.php file not exists than install
	 *
	 */
	if(!file_exists('config.php')){
	
		/*	
		*
		*	Display the site install form
		*/
		site_install('newcreate');
		
		
	}

	else{
		
		$install = false ;
	
		/*
		*	include config.php
		*/
		require('config.php');
		
		
	//query
	if(isset($dbconnect)){
	
	
	$connnection = mysqli_connect($dbconnect['DBHOST'],$dbconnect['DBUSER'],$dbconnect['DBPASS'],$dbconnect['DBNAME']);
		
		if (!$connnection){
		
			/*
			*	if can not make a connection
			*
			*/
			
			echo '<h1>Unable to make connection with database</h1>';
		}
		
		
		if($connnection){
			/*
			*
			*	if can make a connection
			*/
			
			//if correctly get database information
			//select db 
			#$db = mysql_select_db($dbconnect['DBNAME'], $connnection);

			if($connnection){
				/*
				*	if select the db
				*
				$install= false;
				$option_table = $dbconnect['DBPREFIX'].'options';
				//query
						$query = "SELECT * FROM $option_table LIMIT 1";
						$result = mysqli_query($connection,$query);
						$count = mysqli_num_rows($result);
						$example_tb = mysqli_fetch_array($result);


						if(!$count<1){
						//	$install = false;
							if (array_key_exists('value', $example_tb)) {
								//echo 'Exist';
								}
								else {
								//echo 'Doesn\'t exist';
								echo '<h1>Error to datasbase connection</h1>';
								}
						}
						else{
							//than install
						}
					*/	
						
			}/**
			else{
				//echo '<h1>Error to database connection</h1>';// error to connection
			}*/
		}
		}/*
		else{
		
			//	echo '<h1>Error to database connection</h1>';// error to connection
		}
		*/
	if($install== false){
		die('<div style="background:white;margin:0 auto;width:960px;"><h1>Your site is already install</h1><p>Please delete the install.php file for security reason</p></div>');//// if site already install
	}
	else{
		header('Location:index.php'); // header to index page
	}
}