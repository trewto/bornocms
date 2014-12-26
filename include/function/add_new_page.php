<?php
/*
*	New Page function
*	User can adding a new page by this function
*	@packge Borno CMS
*	@author Arnob protim roy
*
*/

class borno_page{ // add new page file


		var $filename = array();// pagename 


		
		/*
		*	Adding a new page
		*
		*
		*/
		public function add_new_page($x,$y ,$z,$a,$dispaly,$main_menu='custom'){ // add new page 
		
			$x = (  array($x,$y,$z,$a,$dispaly,$main_menu));
			
			array_push($this->filename,$x); // insert to filename array
			
						
		}
	
	
		/*
		*	
		*  Get the array of the post
		*
		*/
		public function page_view(){ // view the page

				return $this->filename; // return with the filename array
			
			
		}
		
}

/*
*
*	Displaying the pages
*
*/
function anp_get_the_page($key,$data){
		global $dev_page; // global 

		$foot_view = $dev_page->page_view('filename'); // dev page view
		$id  = 0 ;
		foreach($foot_view as $submenu){
	
		
			if($submenu[0]==$key){
				///i$d =  $submenu[$data];
				if($data=='id'){
				echo $id;
				}
				else{
					return  $submenu[$data];
				}
				
			
				
			}
			
			$id++;
		}
		


}




/*
*	Check the page exists or not
*
*
*/
function anp_the_page_exists($key){
		global $dev_page; // global 

		$foot_view = $dev_page->page_view('filename'); // dev page view
		$id  = 0 ;
		foreach($foot_view as $submenu){
			if($submenu[0]==$key){
				///i$d =  $submenu[$data];
				return true;
		
			}
			
			$id++;
		}
		


}




/*
*	Get the post id
*
*
*
*
*/
function anp_get_the_id($key){
		global $dev_page; // global 

		$foot_view = $dev_page->page_view('filename'); // dev page view
		$id  = 0 ;
		foreach($foot_view as $submenu){
			if($submenu[0]==$key){
				///i$d =  $submenu[$data];
				return $id;
		
			}
			
			$id++;
		}
		


}


//////////////////////////////////////////////////
//Dont use dev pages
$dev_page = new borno_page(); // add new borno page 
////////////////////////////////////////////////////


/*
*
*	Adding the new pages
*	Developer can add a new page by this function easily 
*/
function add_page($pagename,$title , $content,$role,$displaymenu=true,$type='custom'){ // another option .. to add

	global $dev_page;
	$dev_page->add_new_page($pagename ,$title, $content,$role,$displaymenu,$type); // adding a new page

}



////////////////////////////////////////////////////////////////////
 


//////////////////////////////////////////////////////////////



/*********************************//*
add_page('red','title1' , 'content');
add_page('green','title2' , 'content');
add_page('yellow','title3' , 'content');

add_page('hello','title4' , 'content');
add_page('world','title5' , 'content');
add_page('!','title6' , 'content');
*/
/*
if(find_if_the_key_page_exists('world',1)){
	echo 'exists <br>';
	echo find_if_the_key_page_exists('world',1);
}
else{
echo 'not';
}
add_page('red','title1' , 'content','all'false);

*/



$foot_view = $dev_page->page_view('filename');



/*
*
*	Check existence of the page 
*
*/
function anp_array_keys_exists($array,$keys) {
    foreach($keys as $k) {
        if(!isset($array[$k])) {
        return false;
        }
    }
    return true;
}
 // dev page view
 
 

 
/*
*	Get all menu
*
*
*/
function anp_the_page_ul_li($type='custom'){
	global $dev_page;
	
	$foot_view = $dev_page->page_view('filename');
	
	$i = 0 ;
	foreach ($foot_view as $k){
	
		if($k[5]==$type){
		
			if($k[3]=='all' or user_can($k[3])){
		
				if($k[4]){
					echo '<li><a href="?pages='.$k[0].'">'.$k[1].'</a></li>';
					$i++ ;
				}
			}
			
		}	
	}
	
}




/*
*
*	Count the all menu
*
*
*/

function anp_page_array_count($type='custom'){
	global $dev_page;
	
	$foot_view = $dev_page->page_view('filename');
	
	
	$i = 0 ;
	
	foreach ($foot_view as $k){
		if($k[5]==$type){
			if($k[3]=='all' or user_can($k[3])){

					$i++ ;
				}
			
		}
	}
	
	return $i;
}
