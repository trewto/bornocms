<?php
/*	Borno CMS
**  header Load File
** oop
*/


class borno_header{ // add new header file
	var $value = array();
	
	public function add_new_header($x){ // add new header 
		array_push($this->value, $x); // using array push
		
	}
	
	public function header_view(){ // view the header
		return $this->value;
		
	}
		
}

$dev_header = new borno_header(); // add new foter 


function add_header($way){ // another option .. to add
	global $dev_header;
	$dev_header->add_new_header($way);

}
	
 
function header_view(){ // breack array
	global $dev_header; // global 
	
	$foot_view = $dev_header->header_view(); // dev header view
	
	foreach ($foot_view as $v)
		{
			echo $v;
		} 

}