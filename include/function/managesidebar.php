<?php
/*
*
*	since on version 1.0.7
*
*/
class sidebar{
	public $sidebarname;
	

	public function __construct($name){
		$this->sidebarname =  $name;
	}
	

}


$sidebar = array();

function add_sidebar($name){
	global $sidebar;
	$sidebar[] = new sidebar($name);
}


function is_sidebar_exists($request){
	global $sidebar ; 
	
	foreach($sidebar as $side){
		if($side->sidebarname==$request){
			return true;
		}
	}
	
	
}
/*
add_sidebar('left');
add_sidebar('right');
*/