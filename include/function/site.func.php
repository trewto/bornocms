<?php/***	Loaded all the basic function of the site.*	@packge Borno CMS**	*/function site_address(){	return get_the_option("site_address");}/***	Displaying the site title**/function the_title(){		global $title ; 	if($title){		return $title ; 	}else{		return get_the_option("site_name");	}}/**	Echo**/function _echo($string){	echo $string ; }/**	print**/function _print($string){	print( $string ); }/***	Return with admin url*	*/function admin_url(){	if(defined("ADMIN_URL")){				return ADMIN_URL  ;		}	else{			return get_the_option("site_address").'/admin';			}}/***	check contact from is enable or not***/function is_contact_enable(){	$x = get_the_option('contactfrom');		if ($x == 'true'){		return true;	}}/** * 	Site option data *	uses $prefix_options to get the data form option table of database * * 	@param string $name * */# echo $prefix_options;  function get_the_option($name){		if($name == 'site_address' && defined($name)){		return site_address;	}	//	/*	Globaling prefix_ of option table*/ // 	global $prefix_options ; 		//	/*	query */ // 	$result = borno_query("SELECT * FROM prefix_option WHERE name='".mysqli_escape($name)."'");		//	/*	number of rows */ // 	$count = mysqli_num_rows($result);		//	/*	if number of row is one then return with $name data */ // 	if($count==1){			$row = mysqli_fetch_array($result);						//*	/ get data form the row */ //			$datas = $row['value'];						//*	/ return */	//			return $datas;	}	}/* *	first make an array of option table*	get the data form the option table**//an array$option_table_array = array();//query$query = mysqli_query($connection,"Select * From prx9_options");//while and make adding thing on the arraywhile($e=mysqli_fetch_array($query)){	$option_table_array[$e['name']] = $e['value'];}//var_dump($option_table_array);//function get_the_optionfunction get_the_option($field){	global $option_table_array;	return isset($option_table_array[$field])? $option_table_array[$field] : false;}*//**	Session Secuirty code*	every 24 give a new seceret code . Every login user will*	auto matic log out after 24 hour preiod*	*	@return string**/function season_security_hour(){		/*	//date [day] // */		$day = date('d');				/*	// Add only 1 with date . // */		$day = $day + 1 ;				/*	// date	[month] // */		$month = date('m');				/*	// Add only 6 with date . // */		$month = $month + 6;				/*	// date	[year] // */		$year = date('y');				/*	// Add only 1 with date . // */		$year = $year+ 1;				/*	// Getting the date key . // */		$security_code = $day.$month.$year;				/*			 *		 *		 *	Global $dbconnect form config.php file to get LOGKEY_E		 *	LOGKEY_E is the extra secuirty to session preiod time for a unique string		 *		*/		global $dbconnect;				/* // And the logkey  - //	*/		$key = $dbconnect['LOGKEY_E'];						/* //@return string // */		//return base64_encode(md5($security_code.$key)) ;		//at this time i disble it , if need please enable		return md5('15');	}							function mysqli_escape($sql){	global $connection ; 	return mysqli_real_escape_string($connection , $sql);}/***	Update the option*	{option} table*	*	@param $field - the field to update*	@param $value - the updatable value*/	function update_option($field,$value,$createandupdate=true){	global $prefix_options;	//count the field	$field = mysqli_escape($field);	$value = mysqli_escape($value);		if(!$createandupdate){			$field = mysqli_escape($field);		$field = htmlspecialchars($field);		$value = mysqli_escape($value);		$value = htmlspecialchars($value);		borno_query("UPDATE $prefix_options SET `value`='$value' WHERE name= '$field' ");			return true;	}			$query = borno_query("SELECT * FROM $prefix_options WHERE name='$field'");//$query	$count = mysqli_num_rows($query);//count	if($count ==0 ){		borno_query("INSERT INTO $prefix_options (`name`, `value`) VALUES ('$field', NULL );");	}	if($count==1){		//nothing to do 	}	else{		borno_query("DELETE FROM $prefix_options WHERE name = '$field'");		borno_query("INSERT INTO $prefix_options (`name`, `value`) VALUES ('$field', NULL );");	}	//	if(user_can('manage_site')){	$field = mysqli_escape($field);	$field = htmlspecialchars($field);	$value = mysqli_escape($value);	$value = htmlspecialchars($value);	borno_query("UPDATE $prefix_options SET `value`='$value' WHERE name= '$field' ");	//	}}/**	Login / log out link url**	*	@return string the sign in / signout url**/function login_back_url(){	/*	//	get the current page url//	*/	$siteUrl = current_url();		/*	//	if user not logged in echo sign in	//	*/	if(!user_logged_in()){		/*	//	data	//	*/		$data = '<a href="'.get_the_option('site_address').'/sign-in.php?back='.$siteUrl.'">Log in</a>';				/* //	return	// */		return $data;			}			/*	//	else sign out	//	*/	else{			/*	//	data	//	*/		$data = '<a href="'.get_the_option('site_address').'/sign-out.php?back='.$siteUrl.'">Sign out</a>';			/* //	return	// */		return $data;	}}/**	mysql query*	replace borno_query to borno_query*	uses $sql - convert $sql to mysql query*	uses $replace_prefix - replace the database table word  (true/false) *	@return query*/$total_borno_query = 0;$borno_query_debug=array();function borno_query($sql,$replace_prefix=true,$d=false){		/*	//globaling prefix	//	*/	global $prefix;	global $total_borno_query;	global $borno_query_debug;		/*	//	database table array// replacable word	//	*/	$prefixarray = array(' prefix_contentmeta ',' prefix_content','prefix_option ',' prefix_comment ',' prefix_category ','prefix_categorymeta',' prefix_doc ','prefix_docmeta ',' prefix_notify ',' prefix_user ',' prefix_visit ',' prefix_usermeta ',' prefix_photo ',' prefix_menu ',' prefix_cpermalink ',' prefix_dpermalink ',' prefix_catpermalink ',' prefix_meta ');		/*	//	replace array	//	*/	#echo $prefix; 		$replacearray = array(' '.$prefix.'contentmeta ',' '.$prefix.'contents ',' '.$prefix.'options ',' '.$prefix.'comments ',' '.$prefix.'category ',' '.$prefix.'categorymeta ',' '.$prefix.'doc ',' '.$prefix.'docmeta ',' '.$prefix.'notify ',' '.$prefix.'users ',' '.$prefix.'visit ',' '.$prefix.'usermeta ',' '.$prefix.'photo ',' '.$prefix.'menu ',' '.$prefix.'cpermalink ',' '.$prefix.'dpermalink ', ' '.$prefix.'catpermalink ', ' '.$prefix.'meta ');			/*	//	if replace prefix is true than replace the sql 	//	*/	if($replace_prefix){		$sql=str_replace($prefixarray,$replacearray,$sql);	}	if($d){echo $sql;}		/*	//	query	//	*/	global $connection ; 		#var_dump($connection);	$query = mysqli_query($connection,$sql);		$borno_query_debug[] = $sql;;	/*// +1 borno query//	*/	$total_borno_query++;		/*	//@return With query	//	*/	return $query;}/**	Countring function*	//need to adding more thing***	**/function site_count($id=0,$thing='all_post'){	if($thing=='user_total_post'){		global $prefix_contents ;		$qry = borno_query("SELECT * FROM $prefix_contents WHERE user_id='$id' and post_status='publish'");		$count = mysqli_num_rows($qry);		}	if($thing =='all_post'){		global $prefix_contents ;		$qry = borno_query("SELECT * FROM $prefix_contents WHERE post_status='publish'");		$count = mysqli_num_rows($qry);			}	if($thing=='total_user'){		global $prefix_users;		$qry = borno_query("SELECT * FROM $prefix_users");		$count = mysqli_num_rows($qry);	}	if ($thing == 'doc'){		$qry = borno_query("SELECT * FROM prefix_doc WHERE doc_status='publish'");		$count = mysqli_num_rows($qry);	}		return $count ;}/** * 	Search form *	The basic search form of the site * * 	@return string  * */function search_form(){	$s_value='';	if(isset($_GET['search'])){$s_value = htmlspecialchars($_GET['search']);}$d = '<form method="get" action="'.get_the_option('site_address').'/">	    <div class="input-append">    <input class="span2" name="search" value="'.$s_value.'" placeholder="keyword" id="appendedInputButtons" type="text">    <button class="btn" type="submit">Search!</button>    </div>	 </form>';return $d; }/** Searching anything for and string* count any world / letter form an paragraph or other* @suses $string - the airticle * @uses $countword - which word you want to count* @return integer*/function count_from_string($string , $countword){	// count by any word / letter from a senterse or paragraph	preg_match_all("/$countword/", $string, $matches);		$count = (isset($matches[0]))?count($matches[0]):0;		return $count;}/**	Theme directory url*	*	*	@return string - the theme url**/function theme_directory(){		/* //	Site link	//	*/		$site_link	= get_the_option('site_address');		/* //	the catchable folder	//	*/		$theme_root	=$site_link.'/include/theme/';		/* //	theme folder name - form the database	//	*/		$the_folder = get_the_option('theme_folder_name');				/* //	return	//	*/		return	$theme_root.$the_folder;	} /***	The time*	Convert timestamp to time formate/ with site timehour***/function the_time($time,$formet){	$site_hour = get_the_option('timelplus');	return date($formet, strtotime($time.$site_hour." hour"));}/**	Site option menu . Automatic update function*	(type=input)*	***/function _site_option_auto_update_display($fieldname , $update,$prefix){	if(empty($fieldname)){		return false;	}	if($update==true){		if($prefix==true){			$pfix= 'soaud_';		}		else{			$pfix = '';		}		$updatefield=  $pfix.$fieldname ;		if(isset($_POST[$updatefield])){			$newvalue =( $_POST[$updatefield] );			update_option($fieldname , $newvalue);		}	}	$output = get_the_option($fieldname);	//return $output;	if($prefix==true){			$pfix= 'soaud_';		}		else{			$pfix = '';		}		$field = $pfix.$fieldname;	return "<input type='text' name='$field' value='$output'/>";}/****	current url***/function current_url(){		$url = 'http://';		$url .= $_SERVER['HTTP_HOST'];		$url .= $_SERVER['REQUEST_URI'];		return $url;}/****	reqest count***/function req_get_count(){if(isset($_GET)){	$getarray =  $_GET;	$i = 0 ;	foreach ( $getarray as $v){	$i++ ;	} 	return $i;}else{	return 0;}	}/****	check if is mobile***/function is_mobile() {  return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]); }/****	Bangla Date function*	only for bangladesh user**/function bn_date($str){     $en = array(1,2,3,4,5,6,7,8,9,0);    $bn = array('à§§','à§¨','à§©','à§ª','à§«','à§¬','à§­','à§®','à§¯','à§¦');    $str = str_replace($en, $bn, $str);    $en = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' );    $en_short = array( 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' );    $bn = array( 'à¦œà¦¾à¦¨à§à§Ÿà¦¾à¦°à§€', 'à¦«à§‡à¦¬à§à¦°à§à§Ÿà¦¾à¦°à§€', 'à¦®à¦¾à¦°à§à¦š', 'à¦à¦ªà§à¦°à¦¿à¦²', 'à¦®à§‡', 'à¦œà§à¦¨', 'à¦œà§à¦²à¦¾à¦‡', 'à¦…à¦—à¦¾à¦¸à§à¦Ÿ', 'à¦¸à§‡à¦ªà§à¦Ÿà§‡à¦®à§à¦¬à¦°', 'à¦…à¦•à§à¦Ÿà§‹à¦¬à¦°', 'à¦¨à¦­à§‡à¦®à§à¦¬à¦°', 'à¦¡à¦¿à¦¸à§‡à¦®à§à¦¬à¦°' );    $str = str_replace( $en, $bn, $str );    $str = str_replace( $en_short, $bn, $str );    $en = array('Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday');     $en_short = array('Sat','Sun','Mon','Tue','Wed','Thu','Fri');     $bn_short = array('à¦¶à¦¨à¦¿', 'à¦°à¦¬à¦¿','à¦¸à§‹à¦®','à¦®à¦™à§à¦—à¦²','à¦¬à§à¦§','à¦¬à§ƒà¦¹à¦ƒ','à¦¶à§à¦•à§à¦°');     $bn = array('à¦¶à¦¨à¦¿à¦¬à¦¾à¦°','à¦°à¦¬à¦¿à¦¬à¦¾à¦°','à¦¸à§‹à¦®à¦¬à¦¾à¦°','à¦®à¦™à§à¦—à¦²à¦¬à¦¾à¦°','à¦¬à§à¦§à¦¬à¦¾à¦°','à¦¬à§ƒà¦¹à¦¸à§à¦ªà¦¤à¦¿à¦¬à¦¾à¦°','à¦¶à§à¦•à§à¦°à¦¬à¦¾à¦°');     $str = str_replace( $en, $bn, $str );     $str = str_replace( $en_short, $bn_short, $str );     $en = array( 'am', 'pm' );    $bn = array( 'à¦ªà§‚à¦°à§à¦¬à¦¾à¦¹à§à¦¨', 'à¦…à¦ªà¦°à¦¾à¦¹à§à¦¨' );    $str = str_replace( $en, $bn, $str );     return $str;}/*****	site option auto update . developing function**/function _site_option_auto_update_option_display($fieldname , $array,$value ,$update,$prefix_on,$selectend=true){	if(empty($fieldname)){		return false;	}	if($update==true){		// $prefix_on mean soaud off prefix enable or not		if($prefix_on==true){			$updatefield= 'soaud_'.$fieldname ;		}		else{			$updatefield= $fieldname ;		}		if(isset($_POST[$updatefield])){			$newvalue =( $_POST[$updatefield] );			update_option($fieldname , $newvalue);					}	}	 $out = get_the_option($fieldname);	//return $output;		if($prefix_on==true){			$newfield= 'soaud_'.$fieldname ;		}		else{			$newfield= $fieldname ;		}	$output =  '<select name="'.$newfield.'" id="'.$newfield.'">';		$number  = 0 ;	foreach ($array as $menu){		if($out ==  $menu){			$selected = " selected='selected' ";		}		else{			$selected = "";		}		$menuvalue = isset($value[$number]) ? $value[$number]: $menu;			$output .= "<option value='$menu' $selected >$menuvalue</option>";		$number++;	}	//	$output.=$moreoption;			if($selectend){	$output .= '</select>';	}	return $output;}/****	is signup option enable or not ***/function is_signup(){	if(get_the_option('user_can_signup')==true){		return true;	}}/***	get the visior ip****/if(!function_exists("get_IP")){	function get_IP() {	 		$ip = "0.0.0.0";		if( ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) && ( !empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) ) {				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];		} 				elseif( ( isset( $_SERVER['HTTP_CLIENT_IP'])) && (!empty($_SERVER['HTTP_CLIENT_IP'] ) ) ) {			$ip = explode(".",$_SERVER['HTTP_CLIENT_IP']);			$ip = $ip[3].".".$ip[2].".".$ip[1].".".$ip[0];		}		elseif((!isset( $_SERVER['HTTP_X_FORWARDED_FOR'])) || (empty($_SERVER['HTTP_X_FORWARDED_FOR']))) {				if ((!isset( $_SERVER['HTTP_CLIENT_IP'])) && (empty($_SERVER['HTTP_CLIENT_IP']))) {					$ip = $_SERVER['REMOTE_ADDR'];				}			}		return $ip;	}}/****	the ip***/function the_ip(){	return get_IP();}/*******/$db_table = array('user' => $prefix.'users','option' => $prefix.'options','usermeta' =>$prefix.'usermeta','content' =>	$prefix.'contents','contentmeta' => $prefix.'contentmeta');$table_user=$db_table['user'];						/*******/		if(get_the_option('site_permalink')=='dynamic'){		$post_GET = '/content/'; 		}		else{				$post_GET = '/?&p='; 		}if(get_the_option('site_permalink')=='dynamic'){$page_number = get_the_option('site_address').'/page/'; }else{$page_number = get_the_option('site_address').'/?page='; }if(is_admin()){	$page_number = admin_url().'/?page='; }$url_profile ='/profile/';$Url_userpost='/user/';//user/arnob/1 ** page$url_search = '/search/';//search/keyword$user_agent = $_SERVER['HTTP_USER_AGENT'];$agent = $_SERVER['HTTP_USER_AGENT'];$user_ip = $_SERVER['REMOTE_ADDR'];/****	Site Custom query**/function borno_qurey($str="SELECT * FROM prefix_content"){		return borno_query($str);		}/*	Display option by array */function display_select_options($namearray,$valuearray,$select_value){	if(!is_array($namearray) or !is_array($valuearray)){		return false;	}	$i = 0;	$a = '';	foreach($namearray as $name){		$value = isset($valuearray[$i]) ? $valuearray[$i] : $name ; 		$selected = $value == $select_value ? " selected='selected'" : '';			$a .= "<option value='$value' $selected>$name</option>		";					$i++;	}	return $a ; }//////////////////////////////////////////////////////// encode decode functions ///////////////////////////////////////////////////function x0012x9($string,$key="My key") {    $key = sha1($key);    $strLen = strlen($string);    $keyLen = strlen($key);    for ($i = 0; $i < $strLen; $i++) {        $ordStr = ord(substr($string,$i,1));        if ($j == $keyLen) { $j = 0; }        $ordKey = ord(substr($key,$j,1));        $j++;        $hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));    }    return $hash;}function x012x29($string,$key="My key") {    $key = sha1($key);    $strLen = strlen($string);    $keyLen = strlen($key);    for ($i = 0; $i < $strLen; $i+=2) {        $ordStr = hexdec(base_convert(strrev(substr($string,$i,2)),36,16));        if ($j == $keyLen) { $j = 0; }        $ordKey = ord(substr($key,$j,1));        $j++;        $hash .= chr($ordStr - $ordKey);    }    return $hash;}