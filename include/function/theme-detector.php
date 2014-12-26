<?php
/*
*
*	Detect Theme
*	The script detect theme
*	you can manage your theme 
*	by this script
*	@since 17/3/14
*
*/
/*
*	Plugin Name: theme detctor 
*	Detail : test detail
*
*
*/

/**
*	Adding  a theme page 
*/
add_page('manage_theme','Theme' , 'site_the_func','manage_site',true,'admin');



/**
*	The function of site theme
*/
function site_the_func(){








/**
*	Which Word for detect theme ?
*/
$user = 'Theme Name'; //get this value from wherever it is you get it

/**
*	Theme theme directory
*/
$base = '../include/theme/';

/**
*	open the dir
*/
$handle= opendir($base);

/**
*	Strip thumbs
*/
$thumbs = 'thumbs';
/*
*	Blank value of description
*/
$des = '';
/**
*	Total theme folder
*/
$totaltheme = array();
/*
*	Total theme packges
*
*/
$theme_packges = array();







/**
*	Runing a loop and get all folder name of that directory
*
*/
while(($file = readdir($handle))!==FALSE)
	{
		if(is_dir($base."/".$file) && $file != "." &&  $file!= "..." && $file != ".." && $file != $thumbs)
		{
			$totaltheme[] =  $file;
		}
	}









/**
*	Working with the all the folder
*/
foreach($totaltheme as $theme){

/**
*	Set a empty value of author
*/
$author = '';

	/**
	*	Loop through the lines
	*	Check the style.css file
	*/
	$file = '../include/theme/'.$theme.'/style.css';
	
	/**
	*	Checking if style.css file exists
	*/
	if(file_exists($file)){
		
		/**
		*	Get the all line from style.css file
		*
		*/
		$lines  = file($file);
		
		/*
		*	Working with those all lines
		*
		*/
		foreach ($lines as $line_num => $line)
		{
			/**
			*
			*	Replacing some key to get the theme info sensitively
			*/
			$line = str_replace(array('*','#','/*','*/'),'',$line);
			
			
			
			
			if (strpos(trim($line),$user) === 0){ //string found at start of line
			
				//thing to replace
				$thing_to_replace = array('Theme','Name','*','#','/*','*/',':');
				
				//replace
				$info  = str_replace($thing_to_replace,'',$line);
				
				//the theme name
				$t_name = $info;
			}
			
		}// end the foreach loop
		
		
		
		
		
		
		
		/**
		*	Set the defult value of description
		*/
		$des = '';
		
		/*
		* Again make a foreach and get the theme detail
		*/
		foreach ($lines as $line_num => $line){
		
			$line = str_replace(array('*','#','/*','*/'),'',$line);
			
			if (strpos(trim($line),'Detail') === 0){
			
				$thing_to_replace = array('Theme','Detail','Name','*','#','/*','*/',':');
				
				$des = str_replace($thing_to_replace,'',$line);//the description of theme
			
			}
	
		}// end the foreach loop
		
		
		
		
		
		
		
		foreach ($lines as $line_num => $line){//searching the author name
		
			$line = str_replace(array('*','#','/*','*/'),'',$line);
			
			if (strpos(trim($line),'Author') === 0){
				$thing_to_replace = array('Author','Name','*','#','/*','*/',':');
				$author = str_replace($thing_to_replace,'',$line);
			
			}
	
		}// end the foreach loop
	
	
	
	
	
	
	
	
		/*
		*	if theme name not found , set theme
		*	name to folder name
		*/
		if(!isset($t_name)){
			$t_name = $theme;
		}
		if(!isset($theme)){
			$t_name = '';
		}if(!isset($des)){
			$t_name = '';
		}if(!isset($author)){
			$t_name = '';
		}
		
		
		/**
		*	Adding array
		*/

		$theme_packges[] = array('dir'=>$theme,'name'=>trim($t_name),'des'=>trim($des),'author'=>trim($author));
		unset($theme);
		unset($author);
		unset($des);
		unset($t_name);
	}

}/// end to making an theme packge array



	if(!function_exists('del_plug_rrmdir')){
			
					# recursively remove a directory
					function del_plug_rrmdir($dir) {
						foreach(glob($dir . '/*') as $file) {
							if(is_dir($file))
								rrmdir($file);
							else
								unlink($file);
						}
						rmdir($dir);
					}
			}
			


/*
*
*	if isset [activetheme][get] than update
*	the database field of theme_folder name
*	by the [activetheme] value
*
*/
//var_dump($totaltheme);
if(isset($_GET['activetheme'])){
	/**
	*	Enconding to htmlentities
	*/
	$newvalue = htmlentities($_GET['activetheme']) ;
	if($newvalue != 'offline'){
	/**
	*	Update the option
	*/
	if(in_array($newvalue,$totaltheme)){
	update_option('theme_folder_name',$newvalue);
	}else{
	borno_die('no valid theme found in this name');
	}
	
	}else{
	update_option('theme_folder_name','offline');
	}
	/**
	*	Redirect to another page [updated]
	*/
	header('Location:'.admin_url().'/?pages=manage_theme&updated=true');
	
}


/**
*	if isset [updated][get] displaying any message
*/
else if(isset($_GET['updated'])){
	/**
	*	The message
	*/
	echo '<div class="alert alert-success">Theme updated.</div><hr>';
}else if(isset($_GET['delete'])){
$newvalue = htmlentities($_GET['delete']) ;
	if(in_array($newvalue,$totaltheme)){
		if(get_the_option('theme_folder_name')==$newvalue){
			borno_die('You must disable the theme , or active another theme before delete');
		}else{
			del_plug_rrmdir('../include/theme/'.$newvalue);
			borno_die('Theme Deleted','Success! deleted');
		}
	
	}else{
		borno_die('no valid theme found in this name');
	}

}

?><script>
function s(){
 var myTextField = document.getElementById('jsselect');
 var answer = confirm('Are you sure to delete this ?');
	if (answer) 
	  {
	  
	  }
	else {
		myTextField.focus();
		return false
	}
	
}
</script><input type='hidden' id='jsselect' /><?php



			/**
			*	Working with the all theme packge
			*/


			foreach($theme_packges as $theme_packge){
				/**
				*	@uthor Name
				*/
				$authorw =  empty($theme_packge['author']) ? '' : '<br>Author: '. $theme_packge['author'];
				
				/**
				*	Displaying the thme name and author
				*/
				echo "<h3>".$theme_packge['name']."</h3> $authorw <br>";
				
				/**
				*	Theme description
				*/
				$tp = trim($theme_packge['des']);
				if(!empty($tp)){
					echo " ".$theme_packge['des']." <br>";
				}

				
				/**
				*	If the theme not active echo the active link
				*/
				if( !  (get_the_option('theme_folder_name') == $theme_packge['dir'] )){
					
					echo '<a  class="label label-success" href="?pages=manage_theme&activetheme='.$theme_packge['dir'].'">Active this</a>';
					echo ' <a onclick="return s()" class="label label-danger" href="?pages=manage_theme&delete='.$theme_packge['dir'].'"> Delete </a>';
				
				}
				/**
				*	if the theme active echo 'actived'
				*/
				else{

				echo '<span class="label label-warning btn btn-success btn btn-large">Actived</span>';
				
				}
				echo '<hr>';
			}
			
			
			
			/**
			*	The offline theme
			*/
			echo "<b>Offline window</b><br>";
			echo " this is the offline theme of this site <br>";
			if( !  (get_the_option('theme_folder_name') == 'offline' )){
				
				echo '<a href="?pages=manage_theme&activetheme=offline">Active this</a>';
			
			}else{

			echo '<span class="text-success">Actived</span>';
			
			}
}
