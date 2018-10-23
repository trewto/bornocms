<?php
/*	*Borno CMS
	*SEREVER SEND A WELCOME MAIL TO THE SYSTEM ADMINISTRATOR
	*$_SESSION['installwelcomemail']='true';
	*$_SESSION['admin_mail']=$admin_email;
	*$_SESSION['username']=$username;
	*$_SESSION['address']=$address;
	*$_SESSION['date']=md5(date('d'));
*/	//$uptwol="../../index.php";
if(isset($_GET['success'])){
	if($_GET['success']=='true'){
		$uptwol="../../index.php";
//				echo "<a href='".$uptwol."'>dsa</a>";

		die( "You have successfully installed your website. <a href='".$uptwol."'>Click Here </a> to visit your new website. " );
	}
	else{
		die('Why You try this?');
	}
}

session_start();
if(isset($_SESSION['installwelcomemail'])){
	if($_SESSION['installwelcomemail']=='true'){
		if($_SESSION['date']==md5(date('d'))){
			include('mail-info.php');
			$to = $_SESSION['admin_mail'];
			$subject ="You have successfully installed your website";
			$message="Dear ".$_SESSION['username'].",
		Your site and mail system is successfully installed.
			
			<a href='".$_SESSION['address']."'>your website</a>
			";
			sent_mail($to , $subject , $message);
			
			
			
			///another mail to office
			$to  = "borno@webdesigncr3ator.com";
			$sub = "New installation";
			$message = "A new site is installed . [  {$_SESSION['address']} ] ";
			sent_mail($to , $subject , $message);
			
			session_destroy();
			header('Location:installmail.php?success=true');
		}
		else{
			session_destroy();
			die('Something is error');
		}
	}
	else{
		echo 'Ups , Error';
	}	
}
else{
	session_destroy();
	die('Something is error');
}
session_destroy();

