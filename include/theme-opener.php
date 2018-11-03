<?php
/*
 *	Theme Opener
 *	Opening the specific php file by the request
 *	Opening the theme
 *
 *
 *	There are two url styles
 *	One is basic get method , and another is the
 *	htaccess permalink . you can change it form
 *	site setting of admin panel
 *
 *
 *	@package Borno CMS
 *	@since  1.0
 *
 *
 *
 *
 *
 */

/*
 *	the $function_page will be open at the end of the file
 *
*/
$function_page = 404 ;


/*
 *	Check the permalink style.
 *	if permalink style is dynamic work with dynamic function
 * 	Permailink style database value = 'site_permalink'
 *
*/
if((get_the_option('site_permalink')=='dynamic' or get_the_option('site_permalink')=='special') && !is_admin()){

/*
 *	Working with the permalnk 
 *	Detect permalink form REQUEST url
 *	Remove the Site domain subfolder extension
 *  from the REQUEST.
 *
*/
	if($dbconnect['permalink']!="/"){
		$sr = str_replace($dbconnect['permalink'],'',$_SERVER['REQUEST_URI']);
		$sr = str_replace('','',$sr);
	}else{
		 $sr  = substr($_SERVER['REQUEST_URI'],1);
	}

/*
 * 
 *	Making the REQUEST permalink as array
 *
*/	
	$permalinks = explode("/",$sr);
/*
 *
 *	Count the permalinks
 */
	$totallink = count($permalinks);
	
	
/*
 *
 *	if exists 2 REQUEST working with the following page
 *
*/	
if(isset($permalinks[0]) and isset($permalinks[1])){
	/*
	*	Switch Permalink {0}
	*/
	switch($permalinks[0]){
	
		/*
		 *	Case /content/ page
		 */
		case('id'):
		
			if(!isset($_GET['p'])){
				$_GET['p']  = $permalinks[1];//set the $_GET['p'] value
			}
			
			/*
			*	Notify from notification page
			*/
			$t= str_replace('?&ref=notify','',$permalinks[1]);
			
			if(is_numeric($permalinks[1])){
				$_GET['p']  = $permalinks[1];
			}else if(is_numeric($t)){
				$_GET['p']  = $t;
			}else{
				$_GET['p']  = $permalinks[1];
			}
			
		break;
		
		
		case('p'):
			$t= str_replace('?&ref=notify','',$permalinks[1]);
			$_GET['p'] = permalink_to_post_id($t);
			$_GET['p'] = $_GET['p'] ? $_GET['p'] : $t ; 
		break;
		
		
		
		/*
		*	Case /page/ set the $_GET['page'] value
		*/
		case('page'):
			$_GET['page']  = $permalinks[1];
		break;
		
		/*
		*	Case /profile/ set the $_GET['profile'] value
		*/
		case('profile'):
			$_GET['profile']  = $permalinks[1];
			if(isset($permalinks[2])){
			$_GET['page']  = $permalinks[2];
			}
		break;
		/*
		# i dont know , when and why i added this condition
		case('content'):
	
			$t= str_replace('?ref=notify','',$permalinks[1]);
			if(is_numeric($permalinks[1])){
			$_GET['p']  = $permalinks[1];
			}else if(is_numeric($t)){
			$_GET['p']  = $t;
			}else{
			$_GET['p']  = $permalinks[1];
			}
		break;
		*/
		
		/*
		*	Case /cat/ set the $_GET['cat'] value
		*/
		case('category'):
			$_GET['cat']  = $permalinks[1];
			if(isset($permalinks[2])){
			$_GET['page']  = $permalinks[2];
			}
		break;
		
		
		case('cat'):
				$_GET['cat']  = permalink_to_cat_id($permalinks[1]);
				
				
				if(isset($permalinks[2])){
					$_GET['page']  = $permalinks[2];
				}
				$_GET['cat'] = $_GET['cat'] ? $_GET['cat'] : 0;
		break;
		
		
		
		/*
		*	Case /document/ set the $_GET['document'] value
		*/
		case('document'):
			$_GET['doc']  = $permalinks[1];
		break;
		
		
		case('doc'):
		  	$_GET['doc']  = permalink_to_doc_id($permalinks[1]);
			//$_GET['doc'] = $_GET['doc'] ? $_GET['p'] : $permalinks[1] ; 
		break;
		
		/*
		*	if case empty , nothing
		*/
		case(''):
		
		break;
		
		
		
		/*
		*	Default value is error 404
		*/
		default:
			$error404 = true;
		
	}
	
	if(!(isset($_GET['cat']) or isset($_GET['profile']) or isset($_GET['search']))){
		if(!empty($permalinks[2])){
			$error404 = true;
		}

	}
	else {
		if(!empty($permalinks[3])){
		//	if(!isset($_GET['p'])){
			$error404 = true;
			//}
		}
	}
	
	
	
	
}else if(isset($_GET['search'])){
//$_GET['page'] = str_replace( $permalinks[1];) 2?search=a


}
	else if(!$totallink  == 0 ){
		if($totallink == 1 and empty($permalinks[0])){
		
		}
	
	
		else{
			//if(!isset($_GET['p'])){ ///  i dont want to show post on this type url . ;) wanna hiding  ..
			$error404 = true; 
			//}
		}
	}
	
//	var_dump($permalinks);
 if(isset($_GET['search'])){
 
 
 
 if(isset($permalinks[1])){
	$_GET['page'] = str_replace( '?search='.$_GET['search'] , ''  ,$permalinks[1] );

if(filter_var($permalinks[1], FILTER_VALIDATE_INT)){
//	$_GET['page'] = str_replace( '?search='.$_GET['search'] , ''  ,$permalinks[2] );
	$_GET['page'] = $permalinks[1];

}

}
	
	
//echo  '?search'.$_GET['search'];
}	//	echo count($permalinks);
//var_dump($_GET);
//var_dump($permalinks);

}




//var_dump($_GET);










if( isset($_GET['search'],$_GET['profile']) or  isset($_GET['cat'],$_GET['search']) or isset($_GET['profile'],$_GET['cat'])){
	$error404=true;
}








////////////////////////////////////////
/////////////////////////////////////////
$theme_directory = get_the_option('theme_folder_name'); // get the theme folder name

///////////////////////////////////////////////
/*
if(defined("INCLUDE_THEME")){
	include ('load/theme_condition_check.php') ;//theme check file
}*/

//$include= the header php
 if(isset($error404)){
	$title = '404 not found';
	$include=('404.php');
	$function_page = '404';
}
else if(isset($_GET['p'])){
$post_id= htmlspecialchars($_GET['p']);
$post_id= mysqli_escape($_GET['p']);
	$include=('single.php');
	if(!content_check($_GET['p'])){
		$include=('404.php');
		$function_page = '404';
	}
	else{
		$title =  get_the_post($post_id,'title').' | '.get_the_option('site_name');
		the_cat($post_id);
		///if coming form notify , delete this
		if(isset($_GET['ref'])){
			notify_delete($_GET['ref']);
		}
		  visit_count_progress($post_id);
		  $function_page = 'single';
	}


}
else if(isset($_GET['orderbyvisit'])){

	$include = 'visit.php';
	$title  = 'Order by visit';
	//if(file_exists('include/load/pagenav.php')){
		//include('include/load/pagenav.php');
	//}
	$function_page = 'orderbyvisit';

}
else if(isset($_GET['cat'])){
	if(filter_var($_GET['cat'], FILTER_VALIDATE_INT)){
		if(is_exists_cat($_GET['cat'])){
			$title= get_the_cat($_GET['cat'],'name');
			$include =('category.php');
				//if(file_exists('include/load/pagenav.php')){
				//include('include/load/pagenav.php');
			//}
			$function_page = 'cat';
		}
		else{
			$title='404 Error';
			$include=('404.php');
			$function_page = '404';
		}
	
	}
	else{
		$title='404 Error';
		$include=('404.php');
		$function_page = '404';
	}
}
else if(isset($_GET['profile'])){
	if(the_user_by_username(htmlspecialchars($_GET['profile']) , 'name')){
			$include=('profile.php');

		if(!the_user_by_username($_GET['profile'], 'name')=='' or !the_user_by_username($_GET['profile'], 'name')==' '){
			$title = the_user_by_username($_GET['profile'], 'name');
			
			//if(file_exists('include/load/pagenav.php')){
				//include('include/load/pagenav.php');
			//}
		}
		else{
			$title = the_user_by_username($_GET['profile'], 'username');
			//if(file_exists('include/load/pagenav.php')){
				//include('include/load/pagenav.php');
			//}
		}
		$function_page = 'profile';
	}
	else{
		$title = 'No user Found';
		$include=('404.php');
		$function_page = '404';
	}
}
else if(isset($_GET['search'])){
			//if(file_exists('include/load/pagenav.php')){
				//include('include/load/pagenav.php');
		//}
		$search = trim($_GET['search']);
		
		if(!empty($search)){
		$include=('search.php');
		
		$title ='Searching For - '.htmlspecialchars($_GET['search']);
		}
		else{
			$include=('index.php');
			$title =get_the_option('site_name').' | '.get_the_option('site_description');
		}
		 $function_page = 'search';
}
/*
else if(isset($_GET['special'])){
	if($_GET['special']=='contact'){
	$include=('contact.php');
	$title = 'Contact Us';
	}
	else{
		$include=('index.php');
$title =get_the_option('site_name').' | '.get_the_option('site_description');


	}
}*/
else if(isset($_GET['doc'])){
	if($_GET['doc']==='list'){ 
		$include=('doc.php');
		$title ='Document Map';
		$function_page = 'doc';
	}
	else if($_GET['doc']=='contact'){
	
		if(get_the_option('contactfrom')=='true'){
			$title = 'Contact Form';
			$include='doc.php';
			$function_page = 'doc';
		}
		else{
				$title = '404 ERROR Found';
				$include=('404.php');
				$function_page = '404';
		}
	}
	else{
	$include=('doc.php');
		if(is_exists_doc($_GET['doc'])){
			if(get_the_doc($_GET['doc'],'doc_status')!='draft'){
				$title =  get_the_doc($_GET['doc'],'title');
				$function_page = 'doc';
			}else{
				$title = '404 ERROR Found';
				$include=('404.php');
				$function_page = '404';
			}
		}
		else{
			$title = '404 ERROR Found';
			$include=('404.php');
			$function_page = '404';
		}
	}
}
else if(isset($error404)){
	$title = '404 Not found';

	$include=('404.php');
	$function_page = '404';
}






/*
else if(isset($_GET['userpost'])){
	if(the_user_by_username(htmlspecialchars($_GET['userpost']) , 'id')){
		$include=('profile.php');


		if(!the_user_by_username($_GET['userpost'], 'name')=='' or !the_user_by_username($_GET['userpost'], 'name')==' '){
			$title = the_user_by_username($_GET['userpost'], 'name')." - Profile";
		}
		else{
			$title = the_user_by_username($_GET['userpost'], 'username')." ' Posts";
		}
	}
	else{
	$title ='ERROR 404 not found';
	$include=('404.php');

	}
}*/
else{
	//var_dump($_GET);
	$title =get_the_option('site_name').' | '.get_the_option('site_description');
	$include=('index.php');
	$function_page = 'home';
	//if(file_exists('include/load/pagenav.php')){
				//include('include/load/pagenav.php');
		//}
}

if(!isset($post_id)){
	$post_id= 0;
}
//open the pagenav / page load / nav file

if(defined("INCLUDE_THEME")){

	if(file_exists('include/load/pagenav.php')){
			include('include/load/pagenav.php');//include the file

	}

}

if(isset($_POST['post_password'])){
	$post_password= $_POST['post_password'];
}
else{
	$post_password= '';
}
if(!isset($title)){
	$title = '404 not found';
}






//$function_page 
//get the function which page in 
function is_home(){
global $function_page;
	if($function_page=='home'){
		return true;
	}
	else{
		return false;
	}
}



function is_404(){
global $function_page;
	if($function_page=='404'){
		return true;
	}
	else{
		return false;
	}
}

function is_orderbyvisit(){
global $function_page;
	if($function_page=='orderbyvisit'){
		return true;
	}
	else{
		return false;
	}
}

function is_cat(){
global $function_page;
	if($function_page=='cat'){
		return true;
	}
	else{
		return false;
	}
}

function is_single(){
global $function_page;
	if($function_page=='single'){
		return true;
	}
	else{
		return false;
	}
}


function is_doc(){
global $function_page;
	if($function_page=='doc'){
		return true;
	}
	else{
		return false;
	}
}



function is_search(){
global $function_page;
	if($function_page=='search'){
		return true;
	}
	else{
		return false;
	}
}






function is_profile(){
global $function_page;
	if($function_page=='profile'){
		return true;
	}
	else{
		return false;
	}
}

// load plugin 
require_once('function/load-plugin.php');


if(defined("INCLUDE_THEME")){
	include ('load/theme_condition_check.php') ;//theme check file
}


$theme_directory = get_the_option('theme_folder_name'); 
if(is_admin()){
	if(file_exists('../portable/theme/'.$theme_directory.'/functions.php')){
		include('../portable/theme/'.$theme_directory.'/functions.php');//include the function file
	}

}
else{
	if(file_exists('portable/theme/'.$theme_directory.'/functions.php')){
			include('portable/theme/'.$theme_directory.'/functions.php');//include the function file
		}

}


/*
*
*	load the theme
*
*
*/
if(defined("INCLUDE_THEME")){
	if(	file_exists('portable/theme/'.$theme_directory.'/'.$include)){
		include('portable/theme/'.$theme_directory.'/'.$include);

	}
	else{ 
			include('portable/theme/'.$theme_directory.'/index.php');

	}

}