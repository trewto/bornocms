<?php
/* 
*
*	Sign out page
*	Borno CMS 
*	
*/

#include function
include ('functions.php');


#if user not logged in than borno_die()
if(!user_logged_in()){
	borno_die('You are not logged in.Why are you trying to sign out ?');
}

#start session
if(!isset($_SESSION)){
	session_start();
}
	#unset this 4 session
	unset($_SESSION[$dbconnect['LOGKEY_A']]); //	may be email
	unset($_SESSION[$dbconnect['LOGKEY_B']]); //	may ne password
	unset($_SESSION[$dbconnect['LOGKEY_C']]);//	may be security time
	unset($_SESSION[$dbconnect['LOGKEY_D']]);//	may be security time


#destroy session	
session_destroy();


#destroy cookie
setcookie($dbconnect['LOGKEY_A'], "", time()-3600);
setcookie($dbconnect['LOGKEY_B'], "", time()-3600);
setcookie($dbconnect['LOGKEY_C'], "", time()-3600);
setcookie($dbconnect['LOGKEY_D'], "", time()-3600);

#if isset get[back] then back to the get[back] value
if(isset($_GET['back'])){
	header('Location:'.$_GET['back']);
}else{
	header("Location:sign-in.php");
}

#exit or die if not header to another page
exit();
borno_die('This is the signout page');
?>