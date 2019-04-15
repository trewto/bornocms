<?php
/*
*	Del doc
*	The doc is work for delete some content
*/


include('../functions.php');


/*
*	Checking HTTP_REFERER
*
*/
 if(!isset($_GET['CSRFToken']) or $_GET['CSRFToken']!=loginuserinfo('active_key')){
			borno_die( 'Maybe someone is trying delete something special');
	}

if(isset($_SERVER['HTTP_REFERER'])){

	/*
	*	Delete install.php file
	*/
	if($_GET['type'] =="file" & $_GET['id'] =='install.php'){
	
		if(user_can('manage_site')){
			unlink('../install.php');
			borno_die('Operation is done');
		}
		
		borno_die("Operation is done","Successfully removed");
		
	}
	
	

/*
*	Delete content or other
*	
*/
if(isset($_GET['type']) && isset($_GET['id'])){

	//check something
	$id = $_GET['id'];
	$type=$_GET['type'];
	
	if(!filter_var($id, FILTER_VALIDATE_INT)){
		borno_die('Invalid id');//checking
	}
	
	//delete content
	if($type=='post'){
	
		if(is_exists_content($id)){//checking the content
		
			if(user_can('delete_post')){//checking the role
			
				if(get_the_post($id,'post_status')=='trash'){//checking the content status
				
					//delete all information of content
					borno_query("DELETE FROM $prefix_content WHERE `id` = '$id' ");//deleting
					borno_query("DELETE FROM $prefix_cm WHERE `post_id` = '$id' ");
					borno_query("DELETE FROM $prefix_comment WHERE `post_id` = '$id' ");
					borno_query("DELETE FROM $prefix_notift WHERE `post_for` = '$id' ");//new addedd
					
					header('location:'.admin_url().'?pages=managepost&by=user&msg=delete');
					
					borno_die( 'deleted','OK');
					
				}
				else{
					borno_die( 'It is not a trashed Content');
				}
			}
			else{
				borno_die( 'You have no permission to delete it');
			}
		}
		else{
			borno_die( 'No content exists');
		}
		
		
	}
	
	//delete a cat
	else if($type=='cat'){

	
		if(is_exists_cat($_GET['id'])){//check the cat
		
				if(user_can('delete_category')  and $_GET['id']!=1){//check the role 
				
				
					//delete a category progress
					borno_query("DELETE FROM $prefix_cat WHERE `id` = '$id' ");
					borno_query("UPDATE $prefix_cm SET `cat_id` = '1' WHERE `cat_id` =$id");
					
					
					header('location:'.admin_url().'?pages=catlist&msg=delete');
					borno_die('Category successfully deleted','ok');
					
					exit();
				}
				else{
					borno_die( 'You have no permission to delete it');
				}
		}
		else{
		
			borno_die('cat and dog fight');
		}
	
	
	
	
	
	
	}
	//delete a comment
	else if($type=="comment"){
	
		if(is_exists_comment($id)){
		
			if(user_can('delete_comment')){
			
				if(get_the_comment($id,'status')=='trash'){
				
					//delete comment
					borno_query("DELETE FROM $prefix_comment WHERE `id` = '$id' ");
					
					
					header('location:'.admin_url().'?pages=manage-comment&msg=delete');
					borno_die( 'deleted','ok');
					
				}
				else{
					borno_die( 'it is not a trashed comment');
				}
			}
			else{
				borno_die( 'You have no permission to delete it');
			}
		}
		else{
			borno_die( 'no comment exists');
		}
		
	}
	
	
	
	//delete doc
	else if($type=="doc"){
	
	
		if(is_exists_doc($id)){//check the doc
		
			if(user_can('manage_doc')){//check the role
					
					//delete it 
					borno_query("DELETE FROM $prefix_doc WHERE `id` = '$id' ");
					
					header('location:'.admin_url().'?pages=managedoc&msg=delete');
					borno_die( 'deleted');
			
			}
			else{
					borno_die( 'You have no permission to delete it');
			}
		}
		else{
			borno_die( 'no content exists');
		}
	}
	
	
	//delete user
	else if($type=="user"){
	
		if(is_exists_user($id)){//check the user id 
		
			if(user_can('delete_user')){ //check the role
		
				//check current id 
				if(loginuserinfo('id')!=$id){
				
					// a long progress to delete a user
					borno_query("DELETE FROM $prefix_user WHERE `id` = '$id' ");
					borno_query("DELETE FROM $prefix_content WHERE `user_id` = '$id' ");
					borno_query("DELETE FROM $prefix_comment WHERE `user_id` = '$id' ");
					borno_query("DELETE FROM $prefix_contentmeta WHERE `user_id` = '$id' ");
					borno_query("DELETE FROM $prefix_usermeta WHERE `user_id` = '$id' ");
					borno_query("DELETE FROM $prefix_notify WHERE `user_for` = '$id' ");
					
					
					header('location:'.admin_url().'?pages=manageuser&msg=delete');
					borno_die( 'deleted','ok');
					
				}
				else{
					borno_die( 'You can not kill yourself');
				}
			}
			else{
					borno_die( 'You have no permission to delete it');
			}
		}
		else{
			borno_die( 'No ID exists');
		}
	}
	
}

else{

	borno_die( 'You can not do this.' );
	
}
//is_exists_user
}
else{
	borno_die( 'No refer is found. Please take a valid refer' );
}