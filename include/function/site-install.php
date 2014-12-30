<?php
/* Type: Install/Setup
 * Description: This is the site install script
 * More Info: $create= if it value is newcreate than create a new config.php file else not
*/



/////ip function 
function get_IP() {	 
	$ip = "0.0.0.0";
	if( ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) && ( !empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) ) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} 
	
	elseif( ( isset( $_SERVER['HTTP_CLIENT_IP'])) && (!empty($_SERVER['HTTP_CLIENT_IP'] ) ) ) {
		$ip = explode(".",$_SERVER['HTTP_CLIENT_IP']);
		$ip = $ip[3].".".$ip[2].".".$ip[1].".".$ip[0];
	}
	elseif((!isset( $_SERVER['HTTP_X_FORWARDED_FOR'])) || (empty($_SERVER['HTTP_X_FORWARDED_FOR']))) {
			if ((!isset( $_SERVER['HTTP_CLIENT_IP'])) && (empty($_SERVER['HTTP_CLIENT_IP']))) {
				$ip = $_SERVER['REMOTE_ADDR'];
			}
		}
	return $ip;
}







////site install function 

function site_install($create){
	$config = $create;

	if (isset($_POST['submit'])){
	
		
		
		
		
		$dbname = ($_POST['dbname']);
		$dbpass = ($_POST['dbpass']);
		$dbuser = ($_POST['dbuser']);
		$dbhost = ($_POST['dbhost']);
		$username = htmlentities($_POST['username']);//username	
		$email = $_POST['email'];		//email
		$password = htmlentities($_POST['password']);//password
		$repassword = htmlentities($_POST['repassword']);
		$prefix = htmlentities($_POST['prefix']);
		
		
		
		if(!$password == $repassword ){
			echo '<div class="form-install"><h4>Password Not Match</h4></div>';
		}
		if(empty($password)){
			echo '<div class="form-install"><h4>Blank password not allowed</h4></div>';
		}
		if(empty($username)){
			echo '<div class="form-install"><h4>Blank user-name not allowed</h4></div>';
		}
		if(empty($prefix)){
			echo '<div class="form-install"><h4>Blank prefix not allowed </h4></div>';
		}
		
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			$emails= 'ok';
		}
		else{
				$emails ='wrong';
				echo '<div class="form-install"><h4>Please insert an valid email</h4></div>';
		}
		if(!empty($dbname) && !empty($dbuser) &&  !empty($username) && !empty($email) && !empty($password) && !empty($prefix) && $password == $repassword && $emails=='ok'){
			$connection = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
			if (!$connection){
					echo '<div class="form-install">Wrong database information. check it and try again
						<a href="install.php" class="btn">Try Again</a>
						</div>';
			}
			// if connection
			if($connection){
					#$db = mysql_select_db($dbname, $connection);
					mysqli_query($connection,'SET CHARACTER SET utf8');
					mysqli_query($connection,"SET SESSION collation_connection ='utf8_general_ci'");
					
					//if the $db is exists
					if($connection){
						//echo 'db found';
						
							function change_config(){
									$filename="config.php";
									$filehandle=fopen($filename, 'w') or die('can not open file');
									################## key
									
							$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789".
	'0123456789``-=~!@#$%^&*()_+,./<>?;:[]{}\|oxyz';
    $user_logged_key =  md5(substr(str_shuffle($chars),0,8));
    $user_logged_key_a=  md5(substr(str_shuffle($chars),0,9));
    $user_logged_key_b=  md5(substr(str_shuffle($chars),0,10));
    $user_logged_key_c=  md5(substr(str_shuffle($chars),0,11));
    $user_logged_key_d=  md5(substr(str_shuffle($chars),0,12));
    $user_logged_key_e=  md5(substr(str_shuffle($chars),1,14));
	
									##Write the file
									$htfolderurl= $_SERVER['REQUEST_URI'];
									$htfolder = str_replace( 'install.php', '', $htfolderurl );	
									$writeaction = '<?php';
									$writeaction.= '    
/*
*	
*	The configuration file of Borno CMS
*	You can setting your site configuration from here . You can
*	change mysql information , db and prfix infomation , logkey
*	information form this file.
*	Logkey is the unique key of your site .
*/
';
									$writeaction.='$';
									$writeaction.='dbconnect=';
									$dbname = $_POST['dbname'];
									$dbpass = $_POST['dbpass'];
									$dbuser = $_POST['dbuser'];
									$dbhost = $_POST['dbhost'];	
									$prefix = $_POST['prefix'];	
									$writeaction.=" array(
// Database name

// /* You can get the information form your host provider */ //
'DBNAME' => '".$dbname."',

//Database password
'DBPASS' => '".$dbpass."',

//Database username
'DBUSER' => '".$dbuser."',

//Database host 
'DBHOST' => '".$dbhost."',




// /* Database prefix */ //


'DBPREFIX' => '".$prefix."',




// /* Logkey . It secure user login function */	//

//an uniqe site log key .
'LOGKEY' => '".$user_logged_key."',

//email field logkey
'LOGKEY_A' => '".$user_logged_key_a."',

//password field logkey
'LOGKEY_B' => '".$user_logged_key_b."',

//season logkey
'LOGKEY_C' => '".$user_logged_key_c."',

//logkey logkey
'LOGKEY_D' => '".$user_logged_key_d."',



//logkey e // sesion logkey enconding ...
'LOGKEY_E' => '".$user_logged_key_e."',




//	/* Site permalink / subfolder	*/	//
'permalink' => '".$htfolder."'


);";
$writeaction.= '  ?>';
									
									// write content 2/2
									fwrite($filehandle, $writeaction);
									//close the file 
									fclose($filehandle);
								}
						
						
						$prefix = mysqli_real_escape_string($connection,$prefix);
						//query
						$option_table = $prefix.'options';
						$query = "SELECT * FROM $option_table";
						$result = mysqli_query($connection,$query);
						$count = mysqli_num_rows($result);
						//$example_tb = mysqli_fetch_array($result);
						
						$user_table = $prefix.'users';
						$user_query = "SELECT * FROM $option_table";
						$user_result = mysqli_query($connection,$user_query);
						$user_count = mysqli_num_rows($user_result);
				
						//.htaccess
							if(!file_exists('.htaccess')){
									$filename= '.htaccess';
									$handle = fopen($filename , 'w');
									fclose($handle);
							
							}
							if(file_exists('.htaccess')){
									$filename=".htaccess";
									$filehandle=fopen($filename, 'w') or die('can not open file');
									
									
									##htaccess url
									$htfolderurl= $_SERVER['REQUEST_URI'];
									$htfolder = str_replace( 'install.php', '', $htfolderurl );
									##Write the file
							/*		
									$writeaction = 'RewriteEngine On 
RewriteRule ^content/([^/]*)$ '.$htfolder.'/?p=$1 [L]
RewriteRule ^content/([^/]*)/$ '.$htfolder.'/?p=$1 [L]

RewriteEngine On
RewriteRule ^page/([^/]*)$ '.$htfolder.'/?page=$1 [L]
RewriteRule ^page/([^/]*)/$ '.$htfolder.'/?page=$1 [L]

RewriteEngine On
RewriteRule ^document/([^/]*)$ '.$htfolder.'/?doc=$1 [L]
RewriteRule ^document/([^/]*)/$ '.$htfolder.'/?doc=$1 [L]
RewriteRule ^profile/([^/]*)$ '.$htfolder.'/?profile=$1 [L]
RewriteRule ^profile/([^/]*)/$ '.$htfolder.'/?profile=$1 [L]
RewriteRule ^search/([^/]*)$ '.$htfolder.'/?search=$1 [L]
RewriteRule ^user/([^/]*)$ '.$htfolder.'/?userpost=$1 [L]
RewriteRule ^category/([^/]*)$ '.$htfolder.'/?cat=$1 [L]
RewriteRule ^profile/([^/]*)/([^/]*)$ '.$htfolder.'/?profile=$1&page=$2 [L]
RewriteRule ^profile/([^/]*)/([^/]*)/$ '.$htfolder.'/?profile=$1&page=$2 [L]
RewriteRule ^category/([^/]*)/([^/]*)/$ '.$htfolder.'/?cat=$1&page=$2 [L]
RewriteRule ^category/([^/]*)/([^/]*)$ '.$htfolder.'/?cat=$1&page=$2 [L]


ErrorDocument 404 ' .$htfolder.'/404.php

<Files .htaccess>
order deny,allow
deny from all
</Files>

Options All -Indexes
#Options None
';*/
	
						/*			$writeaction = '
#CMS HTACCESS CODING									
RewriteEngine On
RewriteBase '.$htfolder.'
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_URI} !(.*)/$
RewriteRule ^(.*)$ '.$htfolder.'/$1/ [L,R=301]
									
RewriteEngine On 
#RewriteRule ^content/([^/]*)$ '.$htfolder.'/?p=$1 [L]
RewriteRule ^content/([^/]*)/?$ '.$htfolder.'/?p=$1 [L]

RewriteEngine On
#RewriteRule ^page/([^/]*)$ '.$htfolder.'/?page=$1 [L]
RewriteRule ^page/([^/]*)/?$ '.$htfolder.'/?page=$1 [L]

#popular post
RewriteRule ^popular/([^/]*)/?$ /bonracms/?orderbyvisit=DESC&page=$1 [L]
#unpopular post
RewriteRule ^unpopular/([^/]*)/?$ /bonracms/?orderbyvisit=ASC&page=$1 [L]



RewriteEngine On
#RewriteRule ^document/([^/]*)$ '.$htfolder.'/?doc=$1 [L]
RewriteRule ^document/([^/]*)/?$ '.$htfolder.'/?doc=$1 [L]
#RewriteRule ^profile/([^/]*)$ '.$htfolder.'/?profile=$1 [L]
RewriteRule ^profile/([^/]*)/?$ '.$htfolder.'/?profile=$1 [L]
RewriteRule ^search/([^/]*)/?$ '.$htfolder.'/?search=$1 [L]
#RewriteRule ^user/([^/]*)/?$ '.$htfolder.'/?userpost=$1 [L]
RewriteRule ^category/([^/]*)/?$ '.$htfolder.'/?cat=$1 [L]
#RewriteRule ^profile/([^/]*)/([^/]*)$ '.$htfolder.'/?profile=$1&page=$2 [L]
RewriteRule ^profile/([^/]*)/([^/]*)/?$ '.$htfolder.'/?profile=$1&page=$2 [L]
RewriteRule ^category/([^/]*)/([^/]*)/?$ '.$htfolder.'/?cat=$1&page=$2 [L]
#RewriteRule ^category/([^/]*)/([^/]*)$ '.$htfolder.'/?cat=$1&page=$2 [L]


ErrorDocument 404 ' .$htfolder.'/404.php

<Files .htaccess>
order deny,allow
deny from all
</Files>

Options All -Indexes
#Options None
';*/
		$writeaction	= "
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase $htfolder
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . ".$htfolder."index.php [L]
</IfModule>

		";						
									// write content 2/2
									fwrite($filehandle, $writeaction);
									//close the file 
									fclose($filehandle);
							
							
							
							
							}
						
						if(5<$count or 0<$user_count){
						
								if( $config == 'newcreate'){
									$filename= 'config.php';
									$handle = fopen($filename , 'w');
									fclose($handle);
								
								}
								change_config();
							die('<div class="form-install">The Site is already istalled . To freash install clean the database</div>');

						}

						//install progress
							$usertable = $prefix.'users';
							//create user table
								$user_sql = "CREATE TABLE $usertable
									(
									id INT( 130 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
									name varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci ,
									username varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci ,
									email varchar(105) CHARACTER SET utf8 COLLATE utf8_general_ci,
									password varchar(205) CHARACTER SET utf8 COLLATE utf8_general_ci,
									level varchar(205) CHARACTER SET utf8 COLLATE utf8_general_ci,
									active_key varchar(205) CHARACTER SET utf8 COLLATE utf8_general_ci,
									account_active varchar(205) CHARACTER SET utf8 COLLATE utf8_general_ci,
									reset_pass INT( 90 ) NOT NULL DEFAULT '0',
									two_step_email varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci,
									visited_profile varchar(14) CHARACTER SET utf8 COLLATE utf8_general_ci,
									ref varchar(206) CHARACTER SET utf8 COLLATE utf8_general_ci,
									about text CHARACTER SET utf8 COLLATE utf8_general_ci,
									last_ip varchar(105) CHARACTER SET utf8 COLLATE utf8_general_ci ,
									last_browser varchar(105)  CHARACTER SET utf8 COLLATE utf8_general_ci,
									reg_info varchar(105)  CHARACTER SET utf8 COLLATE utf8_general_ci,
									reg_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
									UNIQUE (`username`),
									UNIQUE (`email`)
									)CHARSET=utf8 COLLATE utf8_general_ci ";
								mysqli_query($connection,$user_sql);
							

							//create options table
								$optiontable = $prefix.'options';
								$options_sql = "CREATE TABLE $optiontable
									(
									id INT( 130 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
									name varchar(210) CHARACTER SET utf8 COLLATE utf8_general_ci,
									value TEXT CHARACTER SET utf8 COLLATE utf8_general_ci,
									times TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
									)CHARSET=utf8 COLLATE utf8_general_ci ";
							//skip on 7/10/14
							//changed_user varchar(210) CHARACTER SET utf8 COLLATE utf8_general_ci,		
								mysqli_query($connection,$options_sql);
								
							//create user meta table
								$usermetatable = $prefix.'usermeta';
								$usermeta_sql = "CREATE TABLE $usermetatable
									(
									id INT( 130 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
									name varchar(210) CHARACTER SET utf8 COLLATE utf8_general_ci,
									value varchar(210) CHARACTER SET utf8 COLLATE utf8_general_ci,
									user_id varchar(210) CHARACTER SET utf8 COLLATE utf8_general_ci,
									ip varchar(210) CHARACTER SET utf8 COLLATE utf8_general_ci,
									browser varchar(210) CHARACTER SET utf8 COLLATE utf8_general_ci,
									times TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
									)CHARSET=utf8 COLLATE utf8_general_ci ";
									
								mysqli_query($connection,$usermeta_sql);	
							//create content meta table
								$contentmetatable = $prefix.'contentmeta';
								$contentmeta_sql = "CREATE TABLE $contentmetatable
									(
									id INT( 130 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
									name varchar(210) CHARACTER SET utf8 COLLATE utf8_general_ci,
									value varchar(210) CHARACTER SET utf8 COLLATE utf8_general_ci,
									user_id varchar(210) CHARACTER SET utf8 COLLATE utf8_general_ci,
									post_id varchar(210) CHARACTER SET utf8 COLLATE utf8_general_ci,
									previous_title text CHARACTER SET utf8 COLLATE utf8_general_ci,
									previous_content text CHARACTER SET utf8 COLLATE utf8_general_ci,
									browser_info varchar(210) CHARACTER SET utf8 COLLATE utf8_general_ci,
									ip varchar(210) CHARACTER SET utf8 COLLATE utf8_general_ci,
									times TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
									)CHARSET=utf8 COLLATE utf8_general_ci ";
									mysqli_query($connection,$contentmeta_sql);
							// doc meta
								$docmetatable = $prefix.'docmeta';
								$docmetatable_sql = "CREATE TABLE $docmetatable
									(
									id INT( 130 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
									name varchar(210) CHARACTER SET utf8 COLLATE utf8_general_ci,
									value varchar(210) CHARACTER SET utf8 COLLATE utf8_general_ci,
									user_id varchar(210) CHARACTER SET utf8 COLLATE utf8_general_ci,
									post_id varchar(210) CHARACTER SET utf8 COLLATE utf8_general_ci,
									previous_title text CHARACTER SET utf8 COLLATE utf8_general_ci,
									previous_content text CHARACTER SET utf8 COLLATE utf8_general_ci,
									browser_info varchar(210) CHARACTER SET utf8 COLLATE utf8_general_ci,
									ip varchar(210) CHARACTER SET utf8 COLLATE utf8_general_ci,
									times TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
									)CHARSET=utf8 COLLATE utf8_general_ci ";
									mysqli_query($connection,$docmetatable_sql);
							///doc content
								$doctable = $prefix.'doc';
								$doctable_sql = "CREATE TABLE $doctable
									(
									id INT( 13 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
									user_id varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci ,
									title text CHARACTER SET utf8 COLLATE utf8_general_ci,
									content text CHARACTER SET utf8 COLLATE utf8_general_ci,
									doc_status varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci, 
									browser_info varchar(115) CHARACTER SET utf8 COLLATE utf8_general_ci,
									ip varchar(115) CHARACTER SET utf8 COLLATE utf8_general_ci,
									edited varchar(95) CHARACTER SET utf8 COLLATE utf8_general_ci, 
									active_key varchar(220) CHARACTER SET utf8 COLLATE utf8_general_ci, 
									times TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
									)CHARSET=utf8 COLLATE utf8_general_ci ";
								mysqli_query($connection,$doctable_sql);
	
							
							//create count table
								$visittable = $prefix.'visit';
								$visittable_sql = "CREATE TABLE $visittable
									(
									id INT( 13 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
									post_id INT(45)  ,
									user_id INT(45),
									type VARCHAR(45)  ,
									value INT(45) NOT NULL DEFAULT '0'
									)CHARSET=utf8 COLLATE utf8_general_ci ";
								mysqli_query($connection,$visittable_sql);
							
							////create content table
								$contenttable = $prefix.'contents';
								$content_sql = "CREATE TABLE $contenttable
									(
									id INT( 13 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
									user_id varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci ,
									title text CHARACTER SET utf8 COLLATE utf8_general_ci,
									content text CHARACTER SET utf8 COLLATE utf8_general_ci,
									post_status varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci, 
									post_level varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci, 
									post_password varchar(205) CHARACTER SET utf8 COLLATE utf8_general_ci, 
									comment_permission varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci, 
									browser_info varchar(115) CHARACTER SET utf8 COLLATE utf8_general_ci,
									ip varchar(115) CHARACTER SET utf8 COLLATE utf8_general_ci,
									edited varchar(95) CHARACTER SET utf8 COLLATE utf8_general_ci, 
									active_key varchar(220) CHARACTER SET utf8 COLLATE utf8_general_ci, 
									times TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
									)CHARSET=utf8 COLLATE utf8_general_ci ";
								mysqli_query($connection,$content_sql);
								/*category Sql*/
									//create category table
								
								$cettable = $prefix.'category';
								$cettable_sql = "CREATE TABLE $cettable
									(
									id INT( 13 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
									name text CHARACTER SET utf8 COLLATE utf8_general_ci,
									description text CHARACTER SET utf8 COLLATE utf8_general_ci,
									times TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
									)CHARSET=utf8 COLLATE utf8_general_ci ";
								mysqli_query($connection,$cettable_sql);
								
								
								///add a category to this section 
								mysqli_query($connection,"INSERT INTO $cettable (`id`, `name`, `description`, `times`) VALUES (1, 'Uncategory', 'No category', CURRENT_TIMESTAMP)");
								
								
								
								///////////////////////////////////////catmeta
								$cetmtable = $prefix.'categorymeta';
								$cetmtable_sql = "CREATE TABLE $cetmtable
									(
									id INT( 13 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
									post_id INT(13) ,
									cat_id INT(13)
									)CHARSET=utf8 COLLATE utf8_general_ci ";
								mysqli_query($connection,$cetmtable_sql);
								
								////////////////////////////////////////
								//meta for post_1
									mysqli_query($connection,"INSERT INTO $cetmtable (`id`, `post_id`, `cat_id`) VALUES (1, '1', '1')");
								
								///////////////////////////////
								/*category sql end*/
									////create comment table
								$commenttable = $prefix.'comments';
								$comment_sql = "CREATE TABLE $commenttable
									(
									id INT( 13 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
									user_id INT( 13 ) ,
									post_id INT( 13 ) ,
									content text CHARACTER SET utf8 COLLATE utf8_general_ci,
									status varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci, 
									browser_info varchar(115) CHARACTER SET utf8 COLLATE utf8_general_ci,
									ip varchar(115) CHARACTER SET utf8 COLLATE utf8_general_ci,
									times TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
									)CHARSET=utf8 COLLATE utf8_general_ci ";
								mysqli_query($connection,$comment_sql);
								##############################################
								
								
								/*
								*	Upload image table 
								*	Since version 1.1								*
								*/
								
								$img_table = $prefix.'photo';
								
								$img_query ="CREATE TABLE IF NOT EXISTS  $img_table (
  `id` int(90) NOT NULL AUTO_INCREMENT,
  `img` text CHARACTER SET utf8 NOT NULL,
  `user_id` int(90) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
								
								mysqli_query($connection,$img_query);
								
								
								/*
								*
								*	Post permalink table
								*
								*/
								
								
								$post_permalink = $prefix.'cpermalink';
								
								$post_permalink_query ="CREATE TABLE IF NOT EXISTS  $post_permalink (
  `id` int(90) NOT NULL AUTO_INCREMENT,
  `post_id` int(90) NOT NULL,
  `permalink` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
								
								mysqli_query($connection,$post_permalink_query);	
								
								
								
								/*
								*
								*	Document permalink
								*
								*/
								
								
									$doc_permalink = $prefix.'dpermalink';
								
								$doc_permalink_query ="CREATE TABLE IF NOT EXISTS  $doc_permalink (
  `id` int(90) NOT NULL AUTO_INCREMENT,
  `doc_id` int(90) NOT NULL,
  `permalink` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
								
								mysqli_query($connection,$doc_permalink_query);	
								
								
								
								
								/*
								*	Category permalink slug
								*
								*/
								
							$cat_permalink = $prefix.'catpermalink';
								
								$cat_permalink_query ="CREATE TABLE IF NOT EXISTS  $cat_permalink (
  `id` int(90) NOT NULL AUTO_INCREMENT,
  `cat_id` int(90) NOT NULL,
  `permalink` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
								
								mysqli_query($connection,$cat_permalink_query);	
								mysqli_query($connection,"INSERT INTO $cat_permalink (`id`, `cat_id`, `permalink`) VALUES (NULL, '1', 'uncategory');");
								
										
								
								
								
								
								
								
								
								
								
								
								
								
								###notfify table
								
								$menutable = $prefix.'menu';
								$menutable_sql = "CREATE TABLE $menutable
									(
									id INT( 13 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
									name text ,
									link text,
									submenu  INT( 13 )  DEFAULT 0
									
									)CHARSET=utf8 COLLATE utf8_general_ci ";
								mysqli_query($connection,$menutable_sql);
								
								
								
								
								
								
								
								
								
								
								
								
								
								###notfify table
								
								$notifytable = $prefix.'notify';
								$notifytable_sql = "CREATE TABLE $notifytable
									(
									id INT( 13 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
									user_for INT( 13 ) ,
									post_for INT( 13 ) ,
									other_for varchar( 42 ) ,
									type varchar( 205 ) ,
									message text CHARACTER SET utf8 COLLATE utf8_general_ci,
									times TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
									)CHARSET=utf8 COLLATE utf8_general_ci ";
								mysqli_query($connection,$notifytable_sql);
								
								
								
								
								
								//borno meta
								
								$metatable = $prefix.'meta';
								$metatable_sql = "CREATE TABLE $metatable
									(
									id INT( 210 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
									field varchar( 210 ) ,
									value text,
									type varchar(210),
									type_id	int(210)
									)CHARSET=utf8 COLLATE utf8_general_ci ";
								mysqli_query($connection,$metatable_sql);
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								################The Config File##############
							
								
								############################################
								### WRITE CONFIG.PHP PRGORESS ##############
								if( $config = 'newcreate'){
									$filename= 'config.php';
									$handle = fopen($filename , 'w');
									fclose($handle);
								
								}
								change_config();
								#############################################
								############table function end ##############
								##########INSERT DATA INTO TABLE ############
								#############################################
								$username = preg_replace('#[^A-Za-z]#i', '', $username);
								$password = base64_encode(md5($password));
								$user_agent = $_SERVER['HTTP_USER_AGENT'];
								$user_ip = $_SERVER['REMOTE_ADDR'];
								$user_info = get_IP()." and  IP is - ".$user_ip;
									$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789".
	'0123456789``-=~!@#$%^&*()_+,./<>?;:[]{}\|oxyz';
    $active_key =  md5(substr(str_shuffle($chars),0,8));
	
								$rand_user = 1;
								
								$username = mysqli_real_escape_string($connection,$username);
								$email = mysqli_real_escape_string($connection,$email);
								$password = mysqli_real_escape_string($connection,$password);
								$active_key = mysqli_real_escape_string($connection,$active_key);
								$user_info = mysqli_real_escape_string($connection,$user_info);
								mysqli_query($connection,"INSERT INTO $usertable (`id`,`name`,`username` , `email` , `password`,`level`,`active_key`,`account_active` ,`ref`,`reg_info`) VALUES ('$rand_user','the admin','$username' , '$email' , '$password', '1' ,'$active_key','1','installuser','$user_info')");
								
								///detect the site address 
								$address = "test";
								
									 $siteUrl = 'http://';
									 $siteUrl .= $_SERVER['HTTP_HOST'];
									 $siteUrl .= $_SERVER['REQUEST_URI'];
									$address = str_replace( '/install.php', '', $siteUrl );
									
								/// insert into options page $optiontable
								mysqli_query($connection,"INSERT INTO $optiontable (`name` , `value`) VALUES ('site_name' , 'Borno CMS!')");
								mysqli_query($connection,"INSERT INTO $optiontable (`name` , `value`) VALUES ('site_description' , 'A power-full content management system')");
								mysqli_query($connection,"INSERT INTO $optiontable (`name` , `value`) VALUES ('site_email' , '$email')");
								mysqli_query($connection,"INSERT INTO $optiontable (`name` , `value`) VALUES ('installed_ip' , '$user_ip')");
								mysqli_query($connection,"INSERT INTO $optiontable (`name` , `value`) VALUES ('installed_browser' , $user_agent)");
								mysqli_query($connection,"INSERT INTO $optiontable (`name` , `value`) VALUES ('site_address' , '$address')");
								mysqli_query($connection,"INSERT INTO $optiontable (`name` , `value`) VALUES ('installed' , CURRENT_TIMESTAMP)");
								mysqli_query($connection,"INSERT INTO $optiontable (`name` , `value`) VALUES ('user_defult_level' , '5')");
								mysqli_query($connection,"INSERT INTO $optiontable (`name` , `value`) VALUES ('user_can_signup' , 'false')");
								mysqli_query($connection,"INSERT INTO $optiontable (`name` , `value`) VALUES ('timelplus' , 'Africa/Abidjan')");
								mysqli_query($connection,"INSERT INTO $optiontable (`name` , `value`) VALUES ('pendingpost' , 'false')");
								mysqli_query($connection,"INSERT INTO $optiontable (`name` , `value`) VALUES ('contactfrom' , 'false')");
								mysqli_query($connection,"INSERT INTO $optiontable (`name` , `value`) VALUES ('post_revision' , 'true')");
								mysqli_query($connection,"INSERT INTO $optiontable (`name` , `value`) VALUES ('theme_folder_name' , 'KeepItSimple20')");
								mysqli_query($connection,"INSERT INTO $optiontable (`name` , `value`) VALUES ('number_of_post_display' , '10')");
								mysqli_query($connection,"INSERT INTO $optiontable (`name` , `value`) VALUES ('site_permalink' , 'getstyle')");
								mysqli_query($connection,"INSERT INTO $optiontable (`name` , `value`) VALUES ('full_install' , '0')");
								
								/// the season
								session_start();
								$_SESSION['installwelcomemail']='true';
								$_SESSION['admin_mail']=$email;
								$_SESSION['username']=$username;
								$_SESSION['address']=$address;
								$_SESSION['date']=md5(date('d'));
								
								
								
								////////////
								/*	$contenttable // table name
								 *	Add a new post
								 */
									//qry
									$qry = mysqli_query($connection,"SELECT * FROM $contenttable WHERE id='1'");
									
									// count the $qry
									$count = mysqli_num_rows($qry);
									
									//	add a welcome  post
									if	(! $count == 1){
										//welcome post content
										$title  = 'Hello World!';
										$content = 'Hello user , This is your new website and it is an sample post . Please delete it and start blogging .';
										mysqli_query($connection,"INSERT INTO $contenttable (`user_id`, `title`, `content`, `post_status`, `post_level`, `post_password`, `comment_permission`, `browser_info`, `ip`, `edited`,`active_key`) VALUES ( '$rand_user', '$title', '$content', 'publish','public','', 'false', 'Its an auto genatate post', '$user_ip','false','$active_key')");
									}
									mysqli_query($connection," INSERT INTO $doctable (
`id` ,
`user_id` ,
`title` ,
`content` ,
`doc_status` ,
`browser_info` ,
`ip` ,
`edited` ,
`active_key` ,
`times`
)
VALUES (
'1', '1', 'About', 'This is site about page', 'publish', 'auto genarated', '$user_ip', 'false', '$active_key',
CURRENT_TIMESTAMP
)");
								
								
								/*
								 * header to install mail page
								 */
								 
								 header('Location:include/mail/installmail.php');
						//install progress end
						
					}
					else{
						//echo 'no db found in this name';
						echo '<div class="form-install"><h4>Fail to connect database .check the database infomation.<h4>
						<a href="install.php" class="btn">Try Again</a>
						</div>';
					}
			}
		}
		else{
		echo '<div class="form-install"><h4>Mistake! Check the all input . May be you are not fill any input or insert wrong information.</h4> <br>
				<a href="install.php" class="btn">Try Again</a>
		</div>';
		}
	}
	else{
	?>
		<form method="POST" class="form-install " action="">
		<h2>Install</h2>
		<p>Borno CMS</p>
		<p>Fill up to form. Insert your databse information.</p>
		<label for="dbname">Database Name</label>
		<input name="dbname" class="span4" id="dbname" type="text" />
		<label for="dbpass">Database Pass</label>
		<input name="dbpass" class="span4" id="dbpass" type="text" />
		<label for="dbuser">Database User</label>
		<input name="dbuser" class="span4" id="dbuser" type="text" />
		<label for="dbhost">Database Host</label>
		<input  class="span4" id="dbhost" type="text" name="dbhost"/>
		<br><br>
		<label for="prefix">Table Prefix</label>
		<input name="prefix" class="span4" id="prefix" value="borno_" type="text" />
		<br><br>
		<h4>Insert the admin information</h4>
		<label for="username">User Name</label>
		<input name="username" class="span4" id="username" type="text" />
		<label for="email">Email</label>
		<input name="email" class="span4" id="email" type="text" />
		<label for="password">Password</label>
		<input name="password" class="span4" id="password" type="password" />
		<label for="repassword">Retype Password</label>
		<input name="repassword" class="span4" id="repassword" type="password" />
		<br>
		<input type="submit" class="btn btn-large" value="Install" name="submit"/>
		<br>
		<br>
		<b>&copy; Borno CMS </b>
	</form>
<?php
	}
	
	
	
	
	
	if(isset($connection)){
		mysqli_close($connection);
	}
	
	
}





#####################################################
#OPEN CONNECTION WITH DATABASE#######################
if(file_exists('config.php')){

	include('config.php');
	
	
		if(!isset($dbconnect)){
			die('Error To connect');
		}
		
	#chesking the config file	
	if(!isset($dbconnect['DBNAME'])){die('Invalid Config file');	}
	if(!isset($dbconnect['DBPASS'])){die('Invalid Config file');	}
	if(!isset($dbconnect['DBUSER'])){die('Invalid Config file');	}
	if(!isset($dbconnect['DBHOST'])){die('Invalid Config file');	}
	if(!isset($dbconnect['DBPREFIX'])){die('Invalid Config file');	}
	if(!isset($dbconnect['LOGKEY'])){die('Invalid Config file');	}
	if(!isset($dbconnect['LOGKEY_A'])){die('Invalid Config file');	}
	if(!isset($dbconnect['LOGKEY_B'])){die('Invalid Config file');	}
	if(!isset($dbconnect['LOGKEY_C'])){die('Invalid Config file');	}
	if(!isset($dbconnect['LOGKEY_D'])){die('Invalid Config file');	}
	if(!isset($dbconnect['permalink'])){die('Invalid Config file');	}
	if(!isset($dbconnect['LOGKEY_E'])){die('Invalid Config file');	}
	
	
	
		$dbname = $dbconnect['DBNAME'];
		$dbpass = $dbconnect['DBPASS'];
		$dbuser = $dbconnect['DBUSER'];
		$dbhost = $dbconnect['DBHOST'];
		

					
					
}









#####################################################################################
##Check the site installed or not
###################################################################################






function site_install_or_not(){

		if(!file_exists('config.php')){
			//than install

			if (basename($_SERVER['SCRIPT_FILENAME'])!='install.php'){	
				header('Location:install.php');
			}
		
		}
		
		
//if config.php file exists
else{

	$install = false ;
	//echo 'file exit';
	//check the db
	include('config.php');
	
	
	//Checking the config file
	if(isset($dbconnect)){
	if(!isset($dbconnect['DBNAME'])){die('Invalid Config file');	}
	if(!isset($dbconnect['DBPASS'])){die('Invalid Config file');	}
	if(!isset($dbconnect['DBUSER'])){die('Invalid Config file');	}
	if(!isset($dbconnect['DBHOST'])){die('Invalid Config file');	}
	if(!isset($dbconnect['DBPREFIX'])){die('Invalid Config file');	}
	if(!isset($dbconnect['LOGKEY'])){die('Invalid Config file');	}
	if(!isset($dbconnect['LOGKEY_A'])){die('Invalid Config file');	}
	if(!isset($dbconnect['LOGKEY_B'])){die('Invalid Config file');	}
	if(!isset($dbconnect['LOGKEY_C'])){die('Invalid Config file');	}
	if(!isset($dbconnect['LOGKEY_D'])){die('Invalid Config file');	}
	if(!isset($dbconnect['permalink'])){die('Invalid Config file');	}

	
	#global $connnection;
	//if(!isset($connnection)){
	#$connnection = mysqli_connect($dbconnect['DBHOST'],$dbconnect['DBUSER'],$dbconnect['DBPASS'],$dbconnect['DBNAME']);
	$connection = mysqli_connect($dbconnect['DBHOST'],$dbconnect['DBUSER'],$dbconnect['DBPASS'],$dbconnect['DBNAME']);

		#var_dump($connection);
	
	//}	

	if ((!$connection)){
			die('<h1>Error to database connection</h1>');
		}
		if($connection){
			//if correctly get database information
			//select db 
			#$data = mysql_select_db($dbconnect['DBNAME'], $connnection);
			

			if($connection){
				// if succressfully get db connectino
				//$install= false;
				$option_table = $dbconnect['DBPREFIX'].'options';
				$table_1 = $dbconnect['DBPREFIX'].'contents';
				$table_2 = $dbconnect['DBPREFIX'].'users';
				$table_3 = $dbconnect['DBPREFIX'].'doc';
				$table_4 = $dbconnect['DBPREFIX'].'comments';
				$table_5 = $dbconnect['DBPREFIX'].'notify';
				$table_6 = $dbconnect['DBPREFIX'].'visit';
				$table_7 = $dbconnect['DBPREFIX'].'docmeta';
				$table_8 = $dbconnect['DBPREFIX'].'contentmeta';
				$table_9 = $dbconnect['DBPREFIX'].'usermeta';
				//query
				
						$t_query1 = @mysqli_query($connection,"SELECT * FROM $option_table");
						$t_query2 = @mysqli_query($connection,"SELECT * FROM $table_1");
						$t_query3 = @mysqli_query($connection,"SELECT * FROM $table_2");
						$t_query4 = @mysqli_query($connection,"SELECT * FROM $table_3");
						$t_query5 = @mysqli_query($connection,"SELECT * FROM $table_4");
						$t_query6 = @mysqli_query($connection,"SELECT * FROM $table_5");
						$t_query7 = @mysqli_query($connection,"SELECT * FROM $table_6");
						$t_query8 = @mysqli_query($connection,"SELECT * FROM $table_7");
						$t_query9 = @mysqli_query($connection,"SELECT * FROM $table_8");
						$t_query10 = @mysqli_query($connection,"SELECT * FROM $table_9");
						if ($t_query1){}	else{die('Error to Connect');}
						if ($t_query2){}	else{die('Error to Connect');}
						if ($t_query3){}	else{die('Error to Connect');}
						if ($t_query4){}	else{die('Error to Connect');}
						if ($t_query5){}	else{die('Error to Connect');}
						if ($t_query6){}	else{die('Error to Connect');}
						if ($t_query7){}	else{die('Error to Connect');}
						if ($t_query8){}	else{die('Error to Connect');}
						if ($t_query9){}	else{die('Error to Connect');}
						if ($t_query10){}	else{die('Error to Connect');}
					mysqli_query($connection,'SET CHARACTER SET utf8');
					mysqli_query($connection,"SET SESSION collation_connection ='utf8_general_ci'");
						
						$query = "SELECT * FROM $option_table LIMIT 1";
						$result = mysqli_query($connection,$query);
						$count = mysqli_num_rows($result);
						$example_tb = mysqli_fetch_array($result);
						
						

						if(!$count<1){
						//	$install = false;
							if (array_key_exists('value', $example_tb)) {
								//echo 'Exist';
								}
								else {
								//echo 'Doesn\'t exist';
								die('<h1>Error to database connection</h1>');
								}
						}
						else{
							// if no table found
							//$install = true;
						//	echo 'not table file name installed';
						die( '<h1>Error to database connection</h1>');
						}
						
			}
			else{
				// if not connect to db
				//$install = true ;
				//echo 'no db in this name';
				die('<h1>Error to database connection</h1>');
			}
		}
		}
		else{
		
		die('<h1>Error to database connection</h1>');
		}
		
	if($install== false){
	//echo '//not istall';
	}
	else{
		header('Location:install.php');
	}
}
	
	//			 error_reporting(1);


}

site_install_or_not();


/**
 * type:locate
 * is_admin
 * count admin . if get admin than return
 * if you area located in admin panel
***/ 
/*
function is_admin(){
	if(!basename($_SERVER['SCRIPT_FILENAME'])=='install.php'){
		if(file_exists('sign-up.php')){
		return false;
		}
		else{
		return true;
		}
	}	
}
*/

if(file_exists('sign-in.php')){
			function is_admin(){
			
				return false;
			
			}
		}	
		else{
			function is_admin(){
			
				return true;
			
			}
}

###################################################
###GET THE DATABEASE PREFIX AND OTHER##############
if(basename($_SERVER['SCRIPT_FILENAME'])=='install.php'){


}
else{
if(file_exists('config.php')){
		include('config.php');
		if(isset($dbconnect['DBPREFIX'])){
		
		$prefix = $dbconnect['DBPREFIX'];
		$prefix_options = $prefix.'options';
		$prefix_option = $prefix.'options';
		$prefix_contentmeta = $prefix.'contentmeta';
		$prefix_usermeta = $prefix.'usermeta';
		$prefix_contents = $prefix.'contents';
		$prefix_content = $prefix.'contents';
		$prefix_users = $prefix.'users';
		$prefix_user = $prefix.'users';
		$prefix_meta = $prefix.'meta';		
		$prefix_doc = $prefix.'doc';		
		$prefix_doc_meta = $prefix.'docmeta';		
		$prefix_comments = $prefix.'comments';		
		$prefix_comment = $prefix.'comments';		
		$prefix_n = $prefix.'notify';		
		$prefix_notify = $prefix.'notify';		
		$prefix_not = $prefix.'notify';		
		$prefix_visit = $prefix.'visit';		
		$p_visit = $prefix.'visit';		
		$prefix_category = $prefix.'category';		
		$prefix_cat = $prefix.'category';		
		$prefix_catmeta = $prefix.'categorymeta';		
		$prefix_cm = $prefix.'categorymeta';		
		$p_c = $prefix.'category';		
		$p_cat = $prefix.'category';		
		$p_category = $prefix.'category';		
		$cpermalink = $prefix.'cpermalink';		
		}
		else{
			die('ERROR TO CONNECT');
			
		}
		
		
}
else{
	die('ERROR IN THIS SITE');
}
}
$connection = @mysqli_connect($dbconnect['DBHOST'],$dbconnect['DBUSER'],$dbconnect['DBPASS'],$dbconnect['DBNAME']);
