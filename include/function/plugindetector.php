<?php
/*
*	Plugin Name: Load plugin
*	Detail: This is the plugin loaded file
Author: Arnob Protim ROy
*/
add_page('plug_in','Plugin' , 'plugin_func','manage_plugin',true,'admin');


function plugin_func(){















$user = 'Plugin Name'; //get this value from wherever it is you get it

/**
*	Theme theme directory
*/
$base = '../portable/plugin/';

/**
*	open the dir
*/
$handle= opendir($base);

/**
*	Strip thumbs
*/
$thumbs = 'thumbs';
$detail = '';
$author = '';
/*
*	Blank value of description
*/
$des = '';
/**
*	Total theme folder
*/
$totalplugin = array();
/*
*	Total theme packges
*
*/
$pluginpackge = array();
$totalplugindir = array();
$plugindir = array();







/**
*	Runing a loop and get all folder name of that directory
*
*/

while(($file = readdir($handle))!==FALSE)
	{
		if(is_dir($base."/".$file) && $file != "." &&  $file!= "..." && $file != ".." && $file != $thumbs)
		{
			$totalplugindir[] =  $file;
		}
	}
	//var_dump($totalplugindir);
	
	
	


foreach ($totalplugindir as $plugdir){
	
	//if(substr($file,-4)=='.php' && $file != "." &&  $file!= "..." && $file != ".." && $file != $thumbs)
		//{
			//$totalplugin[] =  $plugdir.'/'.$file;
		//}
	$file = $base.$plugdir."/plug.php";
	$filedirec = $plugdir;

	if(file_exists($file)){
		$totalplugin[] = $filedirec;
		
	}

}




//var_dump($totalplugin);
/*
while(($file = readdir($handle))!==FALSE)
	{	//echo substr($file,-5).'<br>';
		if(/*is_dir($base."/".$file) && * / substr($file,-4)=='.php' && $file != "." &&  $file!= "..." && $file != ".." && $file != $thumbs)
		{
			$totalplugin[] =  $file;
		}
	}
	*/
	
	
	
	
	//var_dump($totalplugin);
	
	
	
	
	foreach ($totalplugin as $plugin){
	
		$dir = '../portable/plugin/'.$plugin.'/plug.php';
		
		
		if(!is_dir($dir)){
		
		
		
		$lines  = file($dir);
		foreach ($lines as $line_num => $line){
		
			/**
			*
			*	Replacing some key to get the theme info sensitively
			*/
			$line = str_replace(array('*','#','/*','*/'),'',$line);
			
			
			
				
				if (strpos(trim($line),$user) === 0){ //string found at start of line
				
					//thing to replace
					$thing_to_replace = array('Plugin','Name','*','#','/*','*/',':');
					
					//replace
					$info  = str_replace($thing_to_replace,'',$line);
					
					//the theme name
					$pluginame = $info;
				}
				
				
				
				
				
				if (strpos(trim($line),'Detail') === 0){ //string found at start of line
				
					//thing to replace
					$thing_to_replace = array('Detail','sadasasd','*','#','/*','*/',':');
					
					//replace
					$info  = str_replace($thing_to_replace,'',$line);
					
					//the theme name
					$detail = $info;
				}

				if (strpos(trim($line),'Author') === 0){ //string found at start of line
				
					//thing to replace
					$thing_to_replace = array('Author','sadasasd','*','#','/*','*/',':');
					
					//replace
					$info  = str_replace($thing_to_replace,'',$line);
					
					//the theme name
					$author = $info;
				}
			
		
		}
		
		
		if(!isset($detail)){
			$detail = '';
		}
		if(!isset($author)){
			$author = '';
		}/*if(!isset($pluginame)){
			$pluginame = $plugin;
		}*/
		//if(isset($pluginame)){
		if(!isset($pluginame)){
		$pluginame = $plugin;
		}
		if(isset($pluginame)){
		$pluginpackge[]  = array( 'name'=> trim($pluginame) ,'dir'=>$plugin,'detail'=>trim($detail),'author'=>trim($author) );
		
		$plugindir[] =  ($plugin);
		}
		
		
		//}
		$pluginame = NULL;
		$detail = NULL;
		$author = NULL;
		
		}
	}


//var_dump($pluginpackge);
	/*
	*
	*	Array of the plugin list
	*
	*/
	 $p_f_d = get_the_option('plugin');
	$p_array_f_d = explode(',',get_the_option('plugin'));
	//var_dump($pluginpackge);
	
	
	
			
		if(isset($_GET['active_name']) && !empty($_GET['active_name'])){
			$a_n   = htmlentities($_GET['active_name']);
			if(in_array($a_n,$plugindir)){
				//echo 'actived';
				if(in_array($a_n,$p_array_f_d)){
					$res = 1;//'Plugin alredy actived';
				}else{
				 //doing something
				 
				 if(count($p_array_f_d)==0){
				 
					update_option('plugin',$a_n);
				  $res =2 ;// 'updated';
				 }else{
					update_option('plugin',$p_f_d.','.$a_n);
				 $res = 3 ; //'updated';
				 }
				
				}
			}else{
				$res = 4; //'invalid plugin';
			}
			
			header('Location:'.get_the_option('site_address').'/admin/?pages=plug_in&msg='.$res);

		}
		
		if(isset($_GET['deactive'])&& !empty($_GET['deactive'])){
		
			
	 
			$d = htmlentities($_GET['deactive']);
			if(in_array($d,$p_array_f_d)){
				$aofpn = array();
				foreach($p_array_f_d as $p){
					if($p!= $d){
					$aofpn[] = $p;
					}
				}
				$newdata = implode(',',$aofpn);
				update_option('plugin',$newdata);
				$res = 9;
			}else{
			$res = 5;
			}
			header('Location:'.get_the_option('site_address').'/admin/?pages=plug_in&msg='.$res);
		}
		
		
		if(isset($_GET['delete']) && !empty($_GET['delete'])){
			$a_n   = htmlentities($_GET['delete']);
			if(in_array($a_n,$plugindir)){
				//echo 'actived';
				if(in_array($a_n,$p_array_f_d)){
					$res = 6;//'Please disable it before delete';
				}else{
					
					
					
					
					
					
					
					
					
					
				
					
	if(!function_exists('del_plug_rrmdir')){
			
					function del_plug_rrmdir($path) {
			return is_file($path) ?
            @unlink($path) :
            array_map(__FUNCTION__, glob($path.'/*')) == @rmdir($path);
}
			}
			
					
					
					
					
					
					del_plug_rrmdir('../portable/plugin/'.$a_n);
				//	unlink('../portable/plugin/'.$a_n);
					$res = 8;//deleted
				}
				
			}else{
				$res = 7;//you can not delete this . it is not on plugin derectory
			}
			header('Location:'.get_the_option('site_address').'/admin/?pages=plug_in&msg='.$res);
		
		}
		if(isset($_GET['msg'])){
			switch($_GET['msg']){
				case 1:
				$msg =  'Plugin already actived';
				break 1;
				case 2:
				$msg =   'Updated';
				break 1;case 3:
				$msg = 'Updated';
				break 1;case 4:
				$msg = 'invalid plugin';
				break 1;case 5:
				$msg = 'Plugin not enable..';
				break 1;;case 6:
				$msg = 'Please disable it before delete';
				break 1;;case 7:
				$msg = 'you can not delete this . it is not on plugin derectory';
				break 1;;case 8:
				$msg = 'deleted';
				break 1;;case 9:
				$msg = 'Deactived';
				break 1;
			
			
			}
		echo '<hr>';
		}
	if(isset($msg)){
			echo '<div class="alert alert-success">'.$msg.'</div><hr>';

	
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
	
	
	foreach($pluginpackge as $plug){
		echo '<h3>'.$plug['name'].'</h3>';
		if(!empty($plug['author'])){
		echo 'Author : '.$plug['author'].'<br>';
		}
		if(!empty($plug['detail'])){
		echo ''.$plug['detail'].'<br>';
		}
		
		if(!in_array($plug['dir'],$p_array_f_d)){
		echo ' <a  class="label label-success" href="?pages=plug_in&active_name='.$plug['dir'].'">Active it</a>';
			echo ' <a  class="label label-danger" href="?pages=plug_in&delete='.$plug['dir'].' " onclick="return s()"> Delete this plugin</a>';
		}else{
			echo ' <span class="label label-primary">Actived</span>';
			echo ' <a  class="label label-warning"  href="?pages=plug_in&deactive='.$plug['dir'].'"> Deactive it</a>';
	
		}
		echo '<br>';
		echo '<hr>';
	
	
	}
	
}



	
	