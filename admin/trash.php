<?php
	/*
	*	this is the progress page to trash anything
	*
	*
	*
	*/
	
/*
*	Check http refer
*/	
if(isset($_SERVER['HTTP_REFERER'])){
	
/*
*	Include functions
*/	
include('../functions.php');


if(isset($_GET['trashtype']) &&  isset($_GET['id'])){
	/*
	*	Comment trash Progress
	*
	*/
	if($_GET['trashtype']=='comment'){
		if(is_exists_comment($_GET['id'])){
		
			$id = $_GET['id'];
			$status = get_the_comment($id,'status');
			if($status=='publish' or $status=='pending'){
			
				//role check
				
				if(user_can('trash_all_comment')){
					update_comment('status','trash',$id);
						header('location:'.admin_url().'?pages=manage-comment&viewtype=alltrash&msg=trash');
				}
				else if(user_can('trash_own_comment')){
					if( get_the_comment($id,'user_id') == loginuserinfo('id') ){
						update_comment('status','trash',$id);
						header('location:'.admin_url().'?pages=manage-comment&viewtype=mytrash&msg=trash');
					}
					else{
						borno_die('Error');
					}
				
				}
				else{
				
					borno_die('Error');
				}
				
			}
			else{
				borno_die('Error');
				echo $status;
			}
			
		}
		else{
			borno_die('Error');
		}

	}
	/*
	*	post trash Progress
	*
	*/
	else if($_GET['trashtype']=='post'){
	
		if(is_exists_content($_GET['id'])){
		
			$id= $_GET['id'];
			$status= get_the_post($id,'post_status');
			$post_user= get_the_post($id,'user_id');
			
			if($status=='pending' or $status=='draft' or $status=='publish'){
			
				//role check
				if(user_can('trash_all_post')){
					//update
					borno_query("UPDATE $prefix_content SET `post_status` = 'trash' WHERE id = '$id'");
					
					header('location:'.admin_url().'?pages=managepost&by=trash&msg=trash');
					borno_die('Content trashed','Command done');
				}
				else if(user_can('trash_own_post')){
					if(loginuserinfo('id')==$post_user){
					//update
						borno_query("UPDATE $prefix_content SET `post_status` = 'trash' WHERE id = '$id'");
						header('location:'.admin_url().'?pages=managepost&by=trash&msg=trash');
						borno_die('Content trashed','Command done');
					}
				}
				else{
					borno_die( 'You can not trash anything' );
				}
				
				
			}
			else{
				borno_die('Already trashed');
			}
			
		}
		else{
			borno_die('Content does not exist.');

			}
	
	}
	
	else{
			borno_die('Unavailable.');

	}
}
	

	/*
	*	Restore Progress
	*
	*/
if(isset($_GET['restoretype']) &&  isset($_GET['id'])){

	/*
	*	comment restore Progress
	*
	*/
	if($_GET['restoretype']=='comment'){
	
		if(is_exists_comment($_GET['id'])){
		
			$id = $_GET['id'];
			echo $status = get_the_comment($id,'status');
			
			if($status=='trash'){
					//role check
					if(user_can('restore_comment')){
							update_comment('status','publish',$id);
							//header("Location:".$_SERVER['HTTP_REFERER'] );
							header('location:'.admin_url().'?pages=manage-comment&msg=restore');
						}
					else{
						borno_die('Error');
						echo 'Error';
					}

			}
			else{
				borno_die('Comment already published');

			}
		}
		else{
			borno_die('Not exists');
			echo 'Comment does not exist.';
		}

	}
	else if($_GET['restoretype']=='post'){
	/*
	*	post restore Progress
	*
	*/
	
		if(is_exists_content($_GET['id'])){
		
			$id =$_GET['id'];
			$status= get_the_post($id,'post_status');
			
			if($status=='trash'){
				//role check
				if(user_can('restore_post')){
					borno_query("UPDATE $prefix_content SET `post_status` = 'publish' WHERE id = '$id'");
				
					header('location:'.admin_url().'?pages=managepost&by=user&msg=restore');
					borno_die('restored','restored');
				}
				else{
					//echo 'You can not restore it.';
					borno_die('you can not restore it');
				}
				
			}
			else{
			
			}
			
		}
		else{
		borno_die('No content');
		}
	}
	else{
		borno_die('unavailable');
	}
}
}
else{
	die('Progress Failed');
}