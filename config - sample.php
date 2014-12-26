<?php    
/*
*	
*	The configuration file of Borno CMS
*	You can setting your site configuration from here . You can
*	change mysql information , db and prefix information , logkey
*	information form this file.
*	Logkey is the unique key of your site .
*/

// /* You can get the information form your host provider */ //

$dbconnect= array(

// Database name
'DBNAME' => 'bornocms',//database name

//Database password
'DBPASS' => '',

//Database username
'DBUSER' => 'root',

//Database host 
'DBHOST' => 'localhost',




// /* Database prefix */ //


'DBPREFIX' => 'borno_',//Enter your prefix , must be a underline (-) of the end of the prefix




// /* Logkey . It secure user login function */	//

/*
*	Every log key must be unique
*
*/

//an unique site log key .
'LOGKEY' => '8d859af1a8d8f74f8bc0e0bef76809cd', /// a custom one

//email field logkey
'LOGKEY_A' => 'ee454aa26b7a9611366ea6b90a6c97f8',/// a custom one

//password field logkey
'LOGKEY_B' => '56147e3fff4888775af313486baaf335',// a custom one

//season logkey
'LOGKEY_C' => '587a9d0ebb8ca9eac1cb6a187ae5b4c3',// a custom one

//logkey logkey
'LOGKEY_D' => '69a2b4a984577f629e7f180948604160',//a custom one



//logkey e // sesion logkey encoding ...
'LOGKEY_E' => 'f16c0f9155c469f9b2291eadf0a75c6f', // a custom one




//	/* Site permalink / subfolder	*/	//
'permalink' => '/bornocmscheck/' // root address


); 






//You can also define it
//define("ADMIN_URL","http://localhost/bornocms/admin");
//define("site_address","http://localhost/bornocms");







 ?>