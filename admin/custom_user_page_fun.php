<?php
	/*	Borno CmS
		this is the custom opp page . custom page display
	
	*/
	/*
	*	requested page name
	*/
	$page_name = $_GET['pages'];
	
	/*
	*	Check page name
	*/
	if(!anp_the_page_exists($page_name)){borno_die('Wrong Page');}
	
	/*
	*	Check role
	*/
	$page_role_needed =  anp_get_the_page($page_name,3); 
	//if(!$page_role_needed=='all' or !user_can($page_role_needed)){echo 'sad';}
	if($page_role_needed=='all' or user_can($page_role_needed)){
	
	
	/*
	*	Display the page
	*/
	echo call_user_func(anp_get_the_page($page_name,2)) ;
	
	
	}
	else {
	borno_die('You can not access this page');}
	
	
?>