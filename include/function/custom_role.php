<?php
////////////////////////
//adding new role///////
////////////////////////
///prefix = user custom role = ucr
function ucr_new_role($newarray=array()){
	
	
	///10/18/2014
	
	$array = array(
	'edit_user'  => false , 
	'manage_site'  => false , 
	'delete_category'  => false , 
	'edit_category'  => false , 
	'add_category'  => false , 
	'restore_post'  => false , 
	'back_up'  => false , 
	'delete_post'  => false , 
	'delete_comment'  => false , 
	'trash_all_comment'  => false , 
	'trash_own_comment'  => false , 
	'manage_comment'  => false , 
	'approve_comment'  => false , 
	'add_comment'  => false , 
	'approved_post'  => false , 
	'manage_doc'  => false , 
	'add_user'  => false , 
	'manage_user'  => false , 
	'edit_all_post'  => false , 
	'edit_own_post'  => false , 
	'new_post'  => false , 
	'restore_comment'  => false , 
	'delete_user'  => false , 
	'trash_own_post'  => false , 
	'trash_all_post' => false,
	'manage_plugin' => false,
	'manage_notify' => false,
	'upload_image' => false,
	'delete_own_image' => false,
	'delete_all_image' => false );
	
	
	foreach($newarray as $n=> $value){
		$array[$n] = $value ; 
	}
		

		
	return $array ;
	
	
}



















/////////////////////////////////////////////
class custom_role{
	public $role_id;
	public $role_name;
	public $role_array;
	/*
	$data  = > array(
		role_id =>
		rolename =>
		array =>
	)
	
	*/
	

	public function __construct($role_id,$role_name , $array){
		$this->role_id =  $role_id;
		$this->role_name =  $role_name;
		$this->role_array =  ucr_new_role($array);
	}
	
	
}




$role_roler = array();

function ucr_add_role($x,$y ,$z){
	global $role_roler;
	$role_roler[] = new custom_role($x,$y,$z);
}



/*
foreach ($role_roler as $role){
echo $role->role_id;
echo $role->role_name;
echo $role->role_array;
echo '<br>';
}*/


function  ucr_diplay_role_li($selectedvalue){
global $role_roler;
$output = '';
if(is_array($role_roler)){
	foreach ($role_roler as $role){
		$select =  ($role->role_id==$selectedvalue)? 'selected="selected"': '' ;
		
		$output  .= '<option value="'.$role->role_id.'"  '.$select.' >'.$role->role_name.'</option>';
	}
	}
	return $output;
}

function ucr_role_name($id){
	global $role_roler;
	if(is_array($role_roler)){
		foreach ($role_roler as $role){
			if($role->role_id==$id)
			
			
			return $role->role_name;
		}
	}

}


//////////////

//get the all of role array 
/*
foreach ($role_roler as $role){
	echo $role->role_array;
}
*/
///////////////////////
function ucr_get_the_array_number($role_id){
	$ei=0;
	global $role_roler;
	if(!is_array($role_roler)){
		return false;
	}
	foreach($role_roler as $role){

		if($role->role_id == $role_id){
			return $ei ;
		}
		$ei++;
	}
	

}

/////////////////
/*
	[1]=> doc_id, info , ...
	[2]=> doc_id, info , ...

*/
///////////get the role

//echo get_the_array_number(3);

function ucr_get_the_array_of_the_role($number){
		global $role_roler;
		$number = $number;
		if(!isset($role_roler[$number])){
			return false;
		}
		else{
			return $i = $role_roler[$number]->role_array;
		}

}

//ucr_add_role('x','y',array());