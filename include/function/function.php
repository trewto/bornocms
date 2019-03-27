<?php
/*
 *
 *  Borno CMS
 *  This is the function file
 *  @author:Arnob Roy
 *
 */
	 
	 
	 
	 
/*
*
*	if not isset session ,start session
*
*/

if(!isset($_SESSION)){
	session_start();
}



/*
*
*
*	Load the diffrent extension of the site
*
*
*
*
*
*/

	/*
	*
	*	include content function
	*
	*/
	require_once('content.func.php');


	/*
	*
	*	include site function
	*
	*/
	require_once('site.func.php');
	/*
	*	Set connection to utf8
	*
	**/
	borno_query('SET CHARACTER SET utf8');
	borno_query("SET SESSION collation_connection ='utf8_general_ci'");      

	/*
	*
	*	include the function of login
	*
	*/
	require_once('login-functions.php');
	
	/*
	*
	*	include user role function
	*
	*/
	require_once('user_can.php');
	
	/*
	*
	*	include user function
	*
	*/
	require_once('user.func.php');
	
	/*
	*	include notification funciton
	*
	*
	*/
	require_once('notification.func.php');
	
	/*
	*	include page visit function
	*
	*/
	require_once('visit.func.php');
	
	/*
	*
	*	include doc function
	*/
	require_once('doc.func.php');
	
	/*
	* include category function
	*
	*/
	require_once('cat.func.php');
	
	/*
	*	include widget
	*
	*/
	require_once('widget.php');
	
	/*
	*
	*	include comment function
	*/
	require_once('comment-functions.php');
	
	/*
	*
	*	include captcha function
	*/
	require_once('captcha.func.php');
	/*
	*
	*	include class user function
	*/
	require_once('class.user.php');
	/*
	*
	*	include class session function
	*/
	require_once('class.session.php');
	/*
	*
	*	include class notification function
	*/
	require_once('class.notification.php');
	require_once('class.notify.php');
	require_once('extension.php');
	require_once('menu_system.php');
	require_once('color-selector.php');
	require_once('about-page.php');
	require_once('optional_field.php');

	
	$loginuserinformation = array();
	
	
	
	
	
	
	
	
	

	if(user_logged_in()){
	
	
		if(session_login()){
			$email = base64_decode($_SESSION[$dbconnect['LOGKEY_A']])	;//email
			$password = $_SESSION[$dbconnect['LOGKEY_B']]	;//password
			$query = borno_query("SELECT * FROM prefix_user WHERE email='".mysqli_escape($email)."' and password='".mysqli_escape($password)."'");
			//echo $count = mysqli_num_rows($query);
			$row = mysqli_fetch_array($query);
			
		}
		else if(cokkie_login()){
			$email = base64_decode($_COOKIE[$dbconnect['LOGKEY_A']])	;//email
			$password = $_COOKIE[$dbconnect['LOGKEY_B']]	;//password
			$query = borno_query("SELECT * FROM prefix_user WHERE email='".mysqli_escape($email)."' and password='".mysqli_escape($password)."'");
			//echo $count = mysqli_num_rows($query);
			$row = mysqli_fetch_array($query);

		}
		
		$loginuserinformation = $row;
			
	}
