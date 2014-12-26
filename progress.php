<?Php
/*
*	Progress
*	@packge Borno CMS
*	@author Arnob Roy
*
*
*/





/*	// including function	*/
include('functions.php');










//include end
if(!isset($_SERVER['HTTP_REFERER'])){
	if(isset($_GET['key']) or isset($_GET['active_account'])){}
	
	else{
		//if not isset $_GET['key'] and $_SERVER['HTTP_REFERER'] than die();
		// die() ->  borno_die();
		// use borno_die(); functino
		borno_die('Ops! you can not access this page manualy');
	}	
}















/*
*
*	Forget Password Progress
*
*/ 
if(isset($_POST['forgetpassword'])){


	$email= $_POST['forgetpassword']; // the email
	
	
	if(filter_var($email, FILTER_VALIDATE_EMAIL)){// checking the email
	
		$qry = borno_query("SELECT * FROM $prefix_users WHERE email='".mysqli_escape($email)."'");
		
		
		$count= mysqli_num_rows($qry);
		
		
		if($count==1){
		
		
			$row= mysqli_fetch_array($qry);
			
			$key = base64_encode($row['active_key']);//active key with encode.
			
			
	
			/*
			 *	We wanna sending a mail
			 *
			 */
			 
 			$subject = 'Forget Password Request';#subject
			
			$to = $row['email'];#email
			
			
			$message="Dear user, 
			You request for you account Password . Click this link to continue to getthing password
			<a href='".get_the_option('site_address')."/sign-in.php?key=".$key."'>Click The Link</a>
			Thanks
			";# the message
			
			
			// Send mail
			if(sent_mail($to , $subject , $message)){
			
				// now the mail successfully sent
				
			}
			else{//if mail not sent success fully
			
				 $msg = 'Unable To Reset password';

				 }
		}
		else{// if email not found or found grater than 1

			$msg = 'Unable To Reset password';
		
		}
		
	}
	
	else{// if $email is not a valid mail

		$msg = 'Unable To Reset password';
	
	}
	
	if(isset($msg)){
		// if isset $msg set session msg
		$_SESSION['forget_pass'] =$msg;
		
	}
	else{
	
		$_SESSION['forget_pass'] ='We sent a mail in your mail address';
	
	}
	header('Location:sign-in.php?forget=true');//sending to the sign in page 
}





















/*
*
*	First step , User get a mail with a link in there email address , if user click the link than the action ....
*	
*
*
*/
else if(isset($_GET['key'])){

	$key = base64_decode($_GET['key']);// decode the key
	
	$qry =borno_query("SELECT * FROM $prefix_users WHERE active_key='".mysqli_escape($key)."'");//query
	
	$count= mysqli_num_rows($qry); // count 
	
	if($count ==1){ // if count == 1
	
	 //ganarate a new password
	 $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789".	'0123456789``-~!@#$%^*()_+,.;:[]{}|oxyz';
	 
	 $new_password =  substr(str_shuffle($chars),0,8);	// new password
		
	 $db_cp = base64_encode(md5($new_password));//encoding password
	 
	 //change active key 
	 
	 $user_active_key =  md5(substr(str_shuffle($chars),0,8));	// create a new user active key
	 
	 
	 while(!is_user_active_code_exists($user_active_key)){
				
				break 1; //looking if the active key not exists
			
			}
			
	
	 
	/*
	 *	Sending mail
	 */
	 
	 
	 $row=mysqli_fetch_array($qry); // make a row

	 
			$subject = 'New Password'; // Subject
			
			$to = $row['email']; // email
			
			$message="Dear user, 
			<br>
			Your password is been reset . this is your new login information .
			Login Info
			Email : ".$row['email']."  <br>
			Password : ".$new_password." <br>
			<a href='".get_the_option('site_address')."/sign-in.php'>Sign In</a> <br>
			";//msg with new password
			
			/**
			 *
			 *mail sent function
			 *
			**/ 
			if(sent_mail($to , $subject , $message)){
				//progress
				//change password
				update_user($row['id'],'password',$db_cp);	
				//change active key
				update_user($row['id'],'active_key',$user_active_key);	
				//add a password change log 
				add_user_meta('passwordchange','forget_pass',$row['id']);
				//update reset log
					$get_count = the_user( $row['id'], 'reset_pass');
					$new_count = $get_count +1 ;
					update_user($row['id'],'reset_pass',$new_count);	
				// message
				$msg ='Successfully password updated';
				
				
			}
			else{
				//if mail not sent successfully
				$msg  = 'Unable to send mail';
			}
	}
	else{	// if the key not existing in our database echo the message
	 $msg = 'Invalid active key';
	}
	
	if(isset($msg)){
	// if isset($msg) set session
	
	$_SESSION['keyprogress']= $msg ;
	
	header('Location:sign-in.php?passwordupdated=true'); // header to passwordupdated page
	
	}

}













else if(isset($_GET['signup'])){



	if(isset($_COOKIE['accountcount']) and $_COOKIE['accountcount']==1){
	 
		die('you already create a account in this site');//multiple account not allowed
	 }
	 
	 
/*
*
*	Sign up Progress
*
*/	 
	 
if(isset($_POST['signup'])){


	if(isset($_POST['fullname']) && isset($_POST['username']) && isset($_POST['email']) && !empty($_POST['password'])){
	
	
		if( $_POST['password'] == $_POST['repassword'] ){
		
		
			if(!empty($_POST['username']) && validate_username($_POST['username'])){
			
			
				 if(!empty($_POST['fullname'])){
				 
				 
					 if(!filter_var($_POST['fullname'], FILTER_VALIDATE_INT))
					 {
					 
						if(validate_name($_POST['fullname'])){
						
							//action
								if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
								
										//checking the captcha
									if($_POST['captchaform']==$_SESSION['rand_code']){
									
									
										if($_POST['checkboxagree']==true){
										
										
										
											$email = $_POST['email'];//email
											
											$username= $_POST['username'];//username
											
											$qry = borno_query("SELECT * FROM $table_user WHERE username='".mysqli_escape($username)."' or email='".mysqli_escape($email)."'");
											
											$count = mysqli_num_rows($qry);
											
											if($count==0){
												// then add the user
												$name = htmlspecialchars($_POST['fullname']);
												
												$username = htmlentities($_POST['username']);
												
												$password = base64_encode(md5($_POST['password']));
												
												$email = $_POST['email'];
												
												if(isset($_GET['refer'])){
												
													$refer = htmlentities($_GET['refer']);
												
												}
												
												else{
												
													$refer = '';
													
												}
												
												$level = get_the_option('user_defult_level');//the user level
												
												//ad user
												$account_active=0;
												
												$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789".	'0123456789``-=~!@#$%^&*()_+,./<>?;:[]{}\|oxyz';
														
														
												$user_active_key =  md5(substr(str_shuffle($chars),0,8));
												
												//adding user
												$user_active_key = add_user($name ,$username , $email ,$password,$refer,$level,$account_active);
												$user_active_key ; 
												
												//mail 
													//subject
													$subject = 'New Account Information';
													//to
													$to = $email;
													//message
													$message="Dear user, <br>
													It is Your New Password ".$new_password."<br>
													Login Info<br>
													Email =". $email."<br>
													Password = **********<br>
													<a href='".get_the_option('site_address')."/sign-in.php?active_account=".$user_active_key."'>Verify Account</a>
													";
													
													
													/**
													 *
													 *mail sent function
													 *
													**/ 
													
													
													if(sent_mail($to , $subject , $message)){
													
													$_SESSION['signup_done'] = true;
													
													
														$msgw ='<div class="alert alert-success">An auto Generate mail sent into your mail box. check it and verify your account</div>';
														
														
													}
													else{//if mail not sent success fully
													
													$_SESSION['signup_done'] = true;
														$msgw ='<div class="alert alert-warning">There are a mail server error so mail failed . you can not verify your account. But Your account is created . Contact to  the site admin for 
														active  your account</div>';
														
													}
												//welcome mail end
													$world  =  '<div class="alert alert-danger  width-300">
															<button type="button" class="close" data-dismiss="alert">&times;</button>
															Your account successfully added
															</div>  ';
															
														//Calculate 60 days in the future

														//seconds * minutes * hours * days + current time

														$inTwoMonths = 60 * 60 * 24 * 60 + time(); 

														setcookie('accountcount', 0, $inTwoMonths);
															header("Location:sign-up.php?reg_success");
											}
											else{
													$msg = '	<div class="alert alert-danger">
															<button type="button" class="close" data-dismiss="alert">&times;</button>
															Email or username already exists
															</div>  ';
											
												//echo 'email or username already exists';
											}

										}
										else{
											$msg = '	<div class="alert alert-danger">
															<button type="button" class="close" data-dismiss="alert">&times;</button>
															You must agreed with our term and condition
															</div>  ';
											//echo 'You must agreed with our term and condition';
										}
									
									}
									else{
											$msg = '	<div class="alert alert-danger">
															<button type="button" class="close" data-dismiss="alert">&times;</button>
																Invalid captcha
															</div>  ';
									}
								}						
								else{
											$msg = '	<div class="alert alert-danger">
															<button type="button" class="close" data-dismiss="alert">&times;</button>
														Invalid email
															</div>  ';
								}
						}
						else{
						
								$msg = '	<div class="alert alert-danger">
															<button type="button" class="close" data-dismiss="alert">&times;</button>
															invalid Name
															</div>  ';
							}
						
					 }
					 else
					 {
						$msg = '	<div class="alert alert-danger">
															<button type="button" class="close" data-dismiss="alert">&times;</button>
														invalid caracter please inset a corect name
															</div>  ';
					 }
				 }
			}//
			else{
			$msg = '	<div class="alert alert-danger">
														<button type="button" class="close" data-dismiss="alert">&times;</button>
													invalid username
														</div>  ';
			}
		}
		else{
			$msg = '	<div class="alert alert-danger">
														<button type="button" class="close" data-dismiss="alert">&times;</button>
													invalid username
														</div>  ';
		}

		
	
	}
	else{
	
			$msg = '	<div class="alert alert-danger">
														<button type="button" class="close" data-dismiss="alert">&times;</button>
														All field is required
														</div>  ';
	}

	if(isset($msg)){
		$_SESSION['signupproblem'] = $msg;
		header('Location:sign-up.php?fullname='.$_POST['fullname'].'&username='.$_POST['username'].'&email='.$_POST['email']);
	}
	else if(isset($msgw)){
		$_SESSION['signupproblem'] = $msgw;
		header("Location:sign-up.php?reg_success");
	}
	
}


}








/*
*
*	Active account . 
*	Return form sign up
*
**/


else if(isset($_GET['active_account'])){

	$active_account_key = $_GET['active_account'];
	
	$qry =borno_query("SELECT * FROM $table_user WHERE active_key='".mysqli_escape($active_account_key)."'");
	
	$count= mysqli_num_rows($qry);
	
	if($count==1){
	
		$row =mysqli_fetch_array($qry);
		
		$user_id = $row['id'];
		
		update_user($user_id,'account_active','1');
		
		$msg = 'Account Actived';
		
	}
	
	else{
	
	$msg = 'invalid key';
	
	}
	
	$_SESSION['activemessage']=$msg;
	
	header('Location:sign-in.php?actived=true');
}