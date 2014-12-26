<?php
/*	Borno CMS
**  Footer Load File
** oop
*/


class borno_footer{ // add new footer file
	var $value = array();
	
	public function add_new_footer($x){ // add new footer 
		array_push($this->value, $x); // using array push
		
	}
	
	public function footer_view(){ // view the footer
		return $this->value;
		
	}
		
}

$dev_footer = new borno_footer(); // add new foter 


function add_footer($way){ // another option .. to add
	global $dev_footer;
	$dev_footer->add_new_footer($way);

}
	
 
function footer_view(){ // breack array
	global $dev_footer; // global 
	
	$foot_view = $dev_footer->footer_view(); // dev footer view
	
	foreach ($foot_view as $v)
		{
			echo $v;
		} 

}