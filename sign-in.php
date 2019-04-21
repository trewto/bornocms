<?php
/*
*	Sign in page
*	sign in , forget pass , forget pass progress page.
*
*	@packge : Borno CMS
*
*/

	
/*
*	Including the function
*/
include('functions.php');

	
	
/*
*	check invalid login
*/	 
if(isset($_SESSION['loginerror']) &&  $_SESSION['loginerror']>5){
	borno_die('You have made too much login attemp. So we blocked you for security reason');
}

	
	
/*
*	if user already logged in than 
*	redirect to another page
*/
if(user_logged_in()){
	header('Location:index.php');
	exit();
}








/*
*	Case forget pass
*/

/**
 *This is the forget password
 *
 *
**/
if(isset($_GET['active_account'])){
 
	header('Location:progress.php?active_account='.$_GET['active_account']);
}
/*
[changed-here]

if(isset($_GET['actived'])){
 unset($_SESSION['activemessage']);
 borno_die(  $_SESSION['activemessage'] ) ;
}

*/
if(isset($_GET['actived'])){
 echo ( '	<br><br><div class="alert alert-warning width-300" style="max-width:300px;margin:0 auto;"><button type="button" class="close" data-dismiss="alert">&times;</button>**'. $_SESSION['activemessage'].'</div><br>' ) ;
  unset($_SESSION['activemessage']);

}

if(isset($_GET['forget'])){

echo '<!DOCTYPE html>';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<link rel="stylesheet" href="';
echo get_the_option('site_address');
echo '/assets/bootstrap/bootstrap.css" />';
echo '<link rel="stylesheet" href="';
echo get_the_option('site_address');
echo '/assets/css/core.css" />';
echo '<script src="';
echo get_the_option('site_address');
echo '/assets/javascript/jquery.js"></script>';

echo '<script src="';
echo get_the_option('site_address');
echo '/assets/javascript/bootstrap.js"></script>';
echo '<meta name="robots" content="noindex, nofollow" />';

echo '<title>Sign in</title>';
echo '<body>';
echo '<br><br>';





/**
 * GET BACK System
 *
**/ 

if(isset($_SESSION['forget_pass'])){
	

echo	'	<div class="alert alert-danger width-300" style="max-width:300px;margin:0 auto;"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$_SESSION['forget_pass'].'</div><br>' ;
	unset($_SESSION['forget_pass']);
}
/**
 *System: At first sent an emailto user like this link sitename/sign-in.php?key=a9830hfania0339y393&valid=asd49 //key is the md5('active_key') //valid is the date of md5(d('d-m-y')); 24 hour link
 *if user click the link than check those link
 *if match found update/change/reganarate the user active_key
 *than an auto ganarate mail sent to the user email
 *filter_var($email, FILTER_VALIDATE_EMAIL)
**/
echo '<form class="form-login" method="POST" action="progress.php">';
echo '<h3>Forget Password</h3><br>';
echo '<label for="forgetpassword">Email</label>';
echo '<input id="forgetpassword" name="forgetpassword" type="text"/>';
echo '<br>';

echo '<input name="submit" class="btn btn-primary" value="Forget Password ?" type="submit"/>';
echo '<br><br><a href="'.get_the_option('site_address').'/">Get Back to site</a>';
echo ' - <a href="'.get_the_option('site_address').'/sign-in.php">Sign In</a>';
echo '</form>';
 die();
}

if(isset($_GET['key'])){
	
	header("Location:progress.php?key=".$_GET['key']);
}
if(isset($_GET['passwordupdated'])){
echo '<!DOCTYPE html>';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<link rel="stylesheet" href="';
echo get_the_option('site_address');
echo '/assets/css/bootstrap.css" />';
echo '<link rel="stylesheet" href="';
echo get_the_option('site_address');
echo '/assets/custom.css" />';
echo '<script src="';
echo get_the_option('site_address');
echo '/assets/js/jquery.js"></script>';
echo '<meta name="robots" content="noindex, nofollow" />';

echo '<script src="';
echo get_the_option('site_address');
echo '/assets/js/bootstrap.js"></script>';

echo '<div class="alert width-300">';
if(isset($_SESSION['keyprogress'])){
echo '<div class="alert alert-warning width-300" style="max-width:300px;margin:0 auto;"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$_SESSION['keyprogress'].'</div>';
}
else{
echo '<div class="alert alert-warning width-300" style="max-width:300px;margin:0 auto;"><button type="button" class="close" data-dismiss="alert">&times;</button>Unable to access this page.</div>';
}
echo '</div>';
unset($_SESSION['keyprogress']);

die();
}



$msg ='';

/**
 *This is the sign in page
 *
 *
**/
if(isset($_POST['submit'])){

	/*
	*	Checking all data and submit
	*
	*/



	//than the action
	$email = htmlentities($_POST['email']);
	$password = base64_encode(md5($_POST['password']));
	$seasontime = season_security_hour();
	//connect to database
	if(!empty($email) && !empty($password)){
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){

		$usertable = $db_table['user'];
		$query= borno_query("SELECT * FROM $usertable WHERE email='".mysqli_escape($email)."' and password='".mysqli_escape($password)."'");
		$count = mysqli_num_rows($query);
		if(!$count==1){
			$reason = 'invalid';
			$msg.= 'Email or password is invalid';
				if(isset($_SESSION['loginerror'])){
				$_SESSION['loginerror'] = $_SESSION['loginerror']+1;
			}
			else{
				$_SESSION['loginerror'] =1;
			}
		}
		if($count=1){
		//	session_start();
			$row = mysqli_fetch_array($query);
			if($row['account_active']==1){
			
				if(isset($_POST['remember']) and $_POST['remember']==true){
					//cookie base
				
					$inTwoMonths = 60 * 60 * 24 * 60 + time();

					setcookie($dbconnect['LOGKEY_A'],base64_encode($row['email']), $inTwoMonths);
					setcookie($dbconnect['LOGKEY_B'], $row['password'], $inTwoMonths);
					setcookie($dbconnect['LOGKEY_C'],season_security_hour() , $inTwoMonths);
					setcookie($dbconnect['LOGKEY_D'], $dbconnect['LOGKEY'] , $inTwoMonths);
				
				
				}
				else{
					//session base
					$_SESSION[$dbconnect['LOGKEY_A']]=base64_encode($row['email']);// a = username
					$_SESSION[$dbconnect['LOGKEY_B']]=$row['password'];//b = password
					$_SESSION[$dbconnect['LOGKEY_C']]=season_security_hour();//c = season_security_hour() its mean the 24 hour time
					$_SESSION[$dbconnect['LOGKEY_D']]=$dbconnect['LOGKEY'];//c = login key force stop all login() its mean the 24 hour time
					
					}
					
					
				
				
				
				
				
				
				
				$user_id = $row['id'];
				
				
				
				
				add_user_meta('logged_in','',$user_id);
				if(isset($_GET['back'])){
					header('Location:'.$_GET['back']);
				}
				else if(isset($_POST['back'])){
					header('Location:'.$_POST['back']);
				}
				else{		
					header('Location:'.admin_url());
				exit();
				}
			}
			else{
				if(!isset($reason)){
					$msg.= 'Your account is not verified. Please verify your account. A mail had been sent in your mail address. Please check the mail or contact with the site administrator';
				}
			}			
		}
		else{
			$msg.= 'Email or password is invalid';
			if(isset($_SESSION['loginerror'])){
				$_SESSION['loginerror'] = $_SESSION['loginerror']+1;
			}
			else{
				$_SESSION['loginerror'] =1;
			}
		}
		}
		else{
				//$msg='invalid email';
				$msg = 'Email or password is invalid';
				if(isset($_SESSION['loginerror'])){
				$_SESSION['loginerror'] = $_SESSION['loginerror']+1;
			}
			else{
				$_SESSION['loginerror'] =1;
			}
		}
	}
	else{
		$msg.= 'Email or password is invalid';
			if(isset($_SESSION['loginerror'])){
				$_SESSION['loginerror'] = $_SESSION['loginerror']+1;
			}
			else{
				$_SESSION['loginerror'] =1;
			}
	}
}

echo '<!DOCTYPE html>';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<link rel="stylesheet" href="';
echo get_the_option('site_address');
echo '/assets/bootstrap/bootstrap.css" />';
echo '<link rel="stylesheet" href="';
echo get_the_option('site_address');
echo '/assets/css/core.css" />';
echo '<script src="';
echo get_the_option('site_address');
echo '/assets/javascript/jquery.js"></script>';

echo '<script src="';
echo get_the_option('site_address');
echo '/assets/javascript/bootstrap.min.js"></script>';

echo '<title>Sign in</title>';
echo '<body>';
echo '<br>';
if(!$msg==''){
echo '<div class="alert alert-warning msg-form">';
echo($msg);

echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';

echo '</div>';


}
echo '<br>';

echo '<form class="form-login" method="POST" action="">';
echo '<h3>Please Sign In</h3>';
echo '<label for="email">Email:</label>';
echo '<input name="email" placeholder="Email Here" id="email" class="span4" type="text" />';
echo '<label for="password">Password:</label>';
echo '<input name="password" placeholder="Password" id="password" class="span4" type="password" />';
echo '<label id="remember"><input type="checkbox" name="remember" id="remember"> Remember me</label> ';
echo '<br>';

echo '<input name="submit"  class="btn btn-inverse btn-large" type="submit" value="Sign In" />';
echo '<br>';
echo '<br>';

if(isset($_POST['back'])){
echo '<input name="back"  type="hidden" value="'.htmlspecialchars($_POST['back']).'" />';
}


echo ' <a class="btn btn-mini btn-primary" href="sign-in.php?forget=true">Forget Password?</a> ';
if(get_the_option('user_can_signup')=='true'){

echo ' <a class="btn btn-mini btn-warning" href="sign-up.php">Register</a>';

}
echo '<br><br>';
echo '<a class="text-success" href="'.get_the_option('site_address').'"><u>Back to site</u></a>';
echo '</form>';
//echo 	$password = base64_encode(md5('123456'));;
