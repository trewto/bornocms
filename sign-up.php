<?php
	/*	Borno CMS
	 *	sign-up.php
	 *	the page help user to sign up
	 */


	/*
	 *
	 *	include the function.php
	 *
	 */
	include('functions.php');

	/*
	 *
	 *	if user already logged in than die()
	 *
	 */
	if(user_logged_in()){
		die('Ops! You have already an account! Why you want to another ?');
		exit();
	}
	
	/*
	 *
	 *	if already created a account.[COOKIE]
	 *
	 *
	 */
	 //user can creat account only one times on one browser . by cookie
	 if(isset($_COOKIE['accountcount']) and $_COOKIE['accountcount']==0){
		$inTwoMonths = 60 * 60 * 24 * 60 + time(); 
		setcookie('accountcount', 1, $inTwoMonths);
	 }
	 ////////////////////////////////////////////////////////////////////
	 if(isset($_COOKIE['accountcount']) and $_COOKIE['accountcount']==1){
	 
		borno_die('you already create a account in this site . You can not create another account form this computer');
	 }
	 

//*sign up page 
echo '<!DOCTYPE html>';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<link rel="stylesheet" href="';
echo get_the_option('site_address');
echo '/assets/bootstrap/bootstrap.css" />';
echo '<link rel="stylesheet" href="';
echo get_the_option('site_address');
echo '/assets/css/core.css" />';
echo '<title>Sign Up</title>';
/*
 *
 *
 *	if user can not sign up than die();
 *
 *
 */
if(get_the_option('user_can_signup')==false){
	die('<div class="alert alert-warning container"><center>Signup is currently disable</center></div>');
}

echo '<script src="';
echo get_the_option('site_address');
echo '/assets/javascript/jquery.js"></script>';

echo '<script src="';
echo get_the_option('site_address');
echo '/assets/javascript/bootstrap.min.js"></script>';

echo '<meta name="robots" content="noindex, nofollow" />';

echo '<title>Sign Up</title>';
echo '<body>';
if(isset($_GET['reg_success'])){
/*echo '<div class="form-signup">';
echo '<div class="alert alert-success">We sent a varification mail in your mail address. Please check it in your inbox and verify the account</div>';
echo '</div>';*/
if(isset($_SESSION['signupproblem'])){

echo $_SESSION['signupproblem'];
	unset ($_SESSION['signupproblem']);
}
else

	echo '<div class="form-signup">Access denied</div>';
{}
die();
}
//javascript custom 
?>
<script type="text/javascript">
function validate_email(field,alerttxt)
{
with (field)
{
apos=value.indexOf("@");
dotpos=value.lastIndexOf(".");
if (apos<1||dotpos-apos<2) 
  {alert(alerttxt);return false;}
else {}
}
}

function validate_username(field,alerttxt)
{
with (field)
{
apos=value.length;
dotpos=value.lastIndexOf(" ");

if (apos<4||apos>12||dotpos>0) 
  {alert(alerttxt);return false;}
else {}
}
}

function validate_name(field,alerttxt)
{
with (field)
{
apos=value.length;
dotpos=value.lastIndexOf(" ");

if (apos<4||dotpos<1) 
  {alert(alerttxt);return false;}
else {}
}
}

function validate_pass(field,alerttxt)
{
with (field)
{
apos=value.length;
if (apos<8||dotpos>12) 
  {alert(alerttxt);return false;}
else {}
}
}
function validate_repass(field,alerttxt)
{
with (field)
{
apos=value.length;
if (apos<8||dotpos>12) 
  {alert(alerttxt);return false;}
else {}
}
}


////password match 

function validate_a_pass(fld){
	with(fld){
		abc = value;
		return abc;
	}
}
function validate_b_pass(fld){
	with(fld){
		abc = value;
		return abc;
	
	}

}


//password match end

function validate_form(thisform)
{
with (thisform)
{
if (validate_email(email,"Not a valid e-mail address!")==false)
  {email.focus();return false;}
 if (validate_username(username,"Invalid Username || You Must entry biggan than 4 letter and less than 12 letter || No space allowed")==false)
  {username.focus();return false;}
  if (validate_name(fullname,"Invalid Name || You Must entry Your Full Username")==false)
  {fullname.focus();return false;}
  if (validate_pass(password,"You must inset 8-12 letter password")==false)
  {password.focus();return false;}
  if (validate_a_pass(password)!=validate_b_pass(repassword))
  {password.focus();alert('password not match');return false;}
    if(document.getElementById("checkboxagree").checked==true){
//alert('true');
  }else{alert('You must ready to register');return false;}	

}
}
function show_password(){
var password_fild=document.getElementById('password')
var repassword_fild=document.getElementById('repassword')
var submit_fild=document.getElementById('submitb')
if(document.getElementById('submitb').value!='convertpass'){
password_fild.type='text';
repassword_fild.type='text';
submit_fild.value='convertpass';
submit_fild.class='label label-warning';
submit_fild.innerHTML ='Hide Password';
}
else{
password_fild.type='password';
repassword_fild.type='password';
submit_fild.value='';
submit_fild.innerHTML ='Show Password';

}
}
</script>

<?php

// js custom end 
//form
echo '<form method="POST" class="form-signup"  action="progress.php?signup" onsubmit="return validate_form(this);">';

//progress
if(isset($_SESSION['signupproblem'])){
	//echo and unset the message
	echo $_SESSION['signupproblem'];
	unset ($_SESSION['signupproblem']);
}

if(isset($_SESSION['signup_done'])){
	//if the signup is done than get out
	unset($_SESSION['signup_done']);
	die();
}

//captcha
$string = '';  
for ($i = 0; $i < 2; $i++) {  
    // this numbers refer to numbers of the ascii table (lower case)  
    $string .= chr(rand(97, 122));  
}  
 //
$string = rand(10,99).$string;
$_SESSION['rand_code']= $string;
?>

	<b><h4>Signup</h4></b> <hr>
	<label for="fullname">Full Name</label>
	<input id="fullname" type="text" class="span4" name="fullname" value="<?php if(isset($_GET['fullname'])){echo $_GET['fullname'];}?>"/>
	<label for="username">Username</label>
	<input id="username" type="text" class="span4" name="username" value="<?php if(isset($_GET['username'])){echo $_GET['username'];}?>"/>
	<label for="email">Email</label>
	<input id="email" type="text" class="span4" name="email"  value="<?php if(isset($_GET['email'])){echo $_GET['email'];}?>"/>
	<label for="password">Password <span class="label label-success" id="submitb" onclick="show_password()">Show Password</span> 
	</label>
	<input type="hidden" id="changebottom" value=""/>
	<input id="password" type="password" class="span4"  name="password"/>
	<label for="repassword">Retype Password</label>
	<input id="repassword" type="password" class="span4" name="repassword"/>
	<hr><b>Fill the captcha</b><br>
	<label for="captchaform"><img src="<?php echo get_the_option('site_address'); ?>/include/function/captcha.php" class="img-polaroid" /></label>
	<input id="captchaform" type="text" class="span4" name="captchaform"/>
	<hr>
	<label class="checkbox">
		<input type="checkbox" id="checkboxagree" name="checkboxagree" > 
		<?php
		if(!defined("condition_to_register")){
		
		print("I am ready to sign up");
		
		}else{
			echo condition_to_register ;
		}
		
		?>
		</label>
	<input type="submit" class="btn btn-success float-right"  name="signup" value="Submit" />
	<br>
</form>