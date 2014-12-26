<?php
/*
*	Displaying captcha by this page
*
*/


/*
*	Direct access is not allowed
*/
if(basename($_SERVER['SCRIPT_FILENAME'])==='output.php'){
	die( 'You can not get captcha in this way' );
}

 
 /*
 *	Include all functions
 */
include('functions.php');



	/*
	*	View the captcha
	*/
	if(isset($_GET['c'])){

	the_captcha($captchatext=$_GET['c']);

	}
	else{

	the_captcha($captchatext='s');

	}

