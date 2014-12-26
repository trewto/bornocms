<?php
/*
*
*	since on version 1.0.7
*
*/
function display_sidebar($sidebar_name , $div_class='toolbox',$title_class='title',$content_div_class='widget_content'){

	/*
	*	Globaling widget
	**/
	global $widget;
	global $sidebar;
	
	
	/*
	*	Check sidebar exists or not
	*
	*/
	if(!is_sidebar_exists($sidebar_name)){
		print "Sidebar not exists";
			return false;
	}
	
	$db_field  = 'widget_field_'.$sidebar_name;
	$db_data  = get_the_option($db_field);
	$func =  explode('*',$db_data) ; // array

	$new_array = array();
	
	foreach($func  as $f){
		if(check_widget_function($f)){
			$name = get_name_by_function($f,"widget_display_title");
			$new_array[] = array($f , $name);
		}
	}
	
$n= 1 ;
$i = 0 ;
	foreach($new_array as $tool){
		if(function_exists($tool[0])){
			echo "<div id='tool_$n' class='$div_class'>";
			echo "<h4  class='title $title_class'>{$tool[1]}</h4>";
			
			echo "<div class='$content_div_class'>";
				 call_user_func($tool[0]);
				 
			
			echo "</div>";
			
			
			echo "</div>";
		}else{
			echo "<div id='tool_$n' class='$div_class'>";
			echo "<h4  class='title'>{$tool[1]}</h4>";
			echo "<div class='$content_div_class'>";
				echo "Widget function not found . Please check your plugin or widget pack";
			echo "</div>";
			echo "</div>";
		
		}
		$n++;
		$i++;
	}
	
	
	if($i==0){
		echo 'Add some widget from panel';
	}
	
}





function check_sidebar_widget($sidebar_name){

	global $widget;
	global $sidebar;
	
	if(!is_sidebar_exists($sidebar_name)){
	 //	print "Sidebar not exists";
		return false;
	}
	
	$db_field  = 'widget_field_'.$sidebar_name;
	$db_data  = get_the_option($db_field);
	$func =  explode('*',$db_data) ; // array

	$new_array = array();
	
	foreach($func  as $f){
		if(check_widget_function($f)){
			$name = get_name_by_function($f);
			$new_array[] = array($f , $name);
		}
	}
	
$n= 1 ;
$i = 0 ;
	foreach($new_array as $tool){
		if(function_exists($tool[0])){
		
		}else{
		
		}
		$n++;
		$i++;
		
	}
	
	
	return $i ;
}

//display_sidebar('left');