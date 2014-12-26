<?php
/*
@borno cms
@arnob protim roy
@this is the user role page of borno cms 
@since version 1.0
@you can add more level if you want
*/

/*
*
*@@Include the custom option for developer
*@@custom role
*/
require('custom_role.php');

function user_can($permission_thing){
	if(user_logged_in()){

		//echo $email = $_SESSION['a'];
		$level1 = array( // admin
				'manage_site' 		=> 'true' ,
				'edit_user'			=> 'true' ,
				'new_post' 			=> 'true' ,
				'edit_own_post' 	=> 'true' ,
				'edit_all_post' 	=> 'true' ,
				'manage_user' 	    => 'true' ,
				'add_user' 	 	    => 'true' ,
				'trash_all_post' 	=> 'true' ,
				'trash_own_post' 	=> 'true' ,
				'delete_user'  		=> 'true' ,
				'manage_doc'  		=> 'true' ,	
				'approved_post'  	=> 'true' ,
				'add_comment'  		=> 'true' ,
				'approve_comment'  	=> 'true' ,	
				'manage_comment' 	=> 'true' ,	
				'trash_own_comment' => 'true' ,
				'trash_all_comment' => 'true', 	
				'delete_comment' 	=> 'true',
				'restore_comment' 	=> 'true',
				'delete_post' 		=> 'true',
				'back_up' 		=> 'true',
				'restore_post'		=> 'true',
				'add_category'		=> 'true',
				'edit_category'		=> 'true',
				'delete_category'		=> 'true',
				'manage_notify'		=> 'true',
				'manage_plugin'		=> 'true',
				'upload_image'	=> 'true',
				'delete_own_image'	=> 'true',
				'delete_all_image'	=> 'true'
				);
		/*$level2 = array( //normal user
				'manage_site' 		=> 'false',
				'edit_user'			=> 'false',
				'new_post' 			=> 'true' ,
				'edit_own_post' 	=> 'true' ,
				'edit_all_post' 	=> 'false',
				'manage_user'   	=> 'false',
				'add_user' 	 	    => 'false',
				'trash_all_post' 	=> 'false',
				'trash_own_post'	=> 'true' ,
				'delete_user'  		=> 'false',
				'manage_doc'  		=> 'false',
				'approved_post'  	=> 'false' ,
				'add_comment'  		=> 'true' ,
				'approve_comment'  	=> 'false' ,	
				'manage_comment'  	=> 'false' ,
				'trash_own_comment' => 'true',
				'trash_all_comment' => 'false', 
				'delete_comment'	=> 'false',
				'restore_comment' 	=> 'false',
				'delete_post' 		=> 'false',
				'back_up' 		=> 'false',
				'restore_post' 		=> 'false',
				'add_category'		=> 'false',
				'edit_category'		=> 'false',
				'delete_category'	=> 'false',
				'manage_notify'	=> 'false',
				'manage_plugin'	=> 'false',
				'upload_image'	=> 'true',
				'delete_own_image'	=> 'false',
				'delete_all_image'	=> 'false'

				);
		$level3 = array( //only have a account but no access
				'manage_site' 		=> 'false',
				'edit_user'			=> 'false',
				'new_post' 			=> 'false',
				'edit_own_post' 	=> 'false',
				'edit_all_post' 	=> 'false',
				'manage_user'   	=> 'false',
				'add_user' 	 	    => 'false',
				'trash_all_post' 	=> 'false',
				'trash_own_post'	=> 'false',
				'delete_user'  		=> 'false',	
				'manage_doc'  		=> 'false',
				'approved_post'  	=> 'false',
				'add_comment'  		=> 'false',
				'approve_comment'  	=> 'false',	
				'manage_comment'  	=> 'false',
				'trash_own_comment' => 'false',
				'trash_all_comment' => 'false',
				'delete_comment' 	=> 'false',
				'restore_comment'	=> 'false',
				'delete_post'		=> 'false',
				'back_up' 		=> 'false',
				'restore_post'		=> 'false',
				'add_category'		=> 'false',
				'edit_category'		=> 'false',
				'delete_category'		=> 'false',
				'manage_notify'		=> 'false',
				'manage_plugin'		=> 'false',
				'upload_image'	=> 'false',
				'delete_own_image'	=> 'false',
				'delete_all_image'	=> 'false'



				);*/
		if(user_logged_in()){
			$level = loginuserinfo('level');
			if($level=='1' or $level==1){
				$level_array=$level1;
			}
			
			else{
				
				if(ucr_get_the_array_number($level)){
					$level_array=ucr_get_the_array_of_the_role(ucr_get_the_array_number($level));
				}
				
			}
			if(!isset($level_array[$permission_thing])){
				return false;
			}
			$thing = $level_array[$permission_thing];
			if($thing=='true'){
				return true;
			}
			else{
				return false;
			}
		}
		return false;
	}
return false;	
}
