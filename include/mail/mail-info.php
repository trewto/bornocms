<?php 
ob_start();
//this is mail function

//$site_name=get_the_option('site_name');;


//sitemail / $form_mail

$sitename = strtolower( $_SERVER['SERVER_NAME'] );
	if ( substr( $sitename, 0, 4 ) == 'www.' ) {
		$sitename = substr( $sitename, 4 );
	}

if(!defined("FROM_MAIL")){	
	$from_mail = 'no-replay@' . $sitename;
}else{
	$from_mail = FROM_MAIL;
}


//function
function sent_mail($to , $subject , $message){
	global  $from_mail;	
	$headers  = 'From:'. $from_mail . "\r\n" .
            'Reply-To:'. $from_mail . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8' . "\r\n" ;
	if(mail($to, $subject, $message, $headers)){
		return true ;
	}
	else{
		return false;
	}
}	