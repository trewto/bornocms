<?php
/*
*	Edit a user
*
*/

if(!user_can('manage_user')){
	borno_die('You can not access this page');
	exit();
}
if(isset($_GET['edituser'])){ 
	$user_id=$_GET['edituser'];
}
else{
	borno_die('invalid entry');
}


if(filter_var($user_id, FILTER_VALIDATE_INT)){
		//$user_id
		$query = borno_query("SELECT * FROM $prefix_users WHERE id=$user_id");
		$count = mysqli_num_rows($query);
		if($count == 1){
			$row = mysqli_fetch_array($query);
			//echo '<a href="'.get_the_option('site_address').'/profile/'.$row['username'].'">VISIT PROFILE</a>';
			//echo '<br>Chnage The USER<br>';
			
			if(isset($_POST['submit'])){
			
				///checking
				if(!loginuserinfo('id')==$user_id){
					if(!isset($_POST['role'])){ borno_die('Something is crazy');}
					if(!isset($_POST['account_active'])){ borno_die('Something is crazy');}
				}			
				if(!isset($_POST['pass'])){ borno_die('Something is crazy');}// check password field 
				if(!isset($_POST['repass'])){ borno_die('Something is crazy');}//check repassword field
				if(!isset($_POST['name'])){ borno_die('Something is crazy');}//check the name field
				if(!isset($_POST['about'])){ borno_die('Something is crazy');}//check the about field
				//if(!isset($_POST[''])){ borno_die('Something is crazy');}
			if(!isset($_POST['CSRFToken']) or $_POST['CSRFToken']!=loginuserinfo('active_key')){
				borno_die( 'Maybe someone is trying to create a admin user');
			}
			
				if(isset($_POST['user_id']) && isset($_POST['active_key'])){
					$id= $_POST['user_id'];
					$key = $_POST['active_key'];
					$qry = borno_query("SELECT * FROM $table_user WHERE id='".mysqli_escape($id)."' and active_key='".mysqli_escape($key)."'");
					$count = mysqli_num_rows($qry);
					if($count==1){
				//check
									$email=$_POST['email'];
									if(filter_var($email, FILTER_VALIDATE_EMAIL)){
											//echo 'valid';
											//if email is not with another account
											$query = borno_query("SELECT * FROM $prefix_users WHERE email='".mysqli_escape($email)."'");
											$count = mysqli_num_rows($query);
											
											if($count == 0  or $email == $row['email'] ){
											
														if(!empty($_POST['name']) &&  $_POST['pass']== $_POST['repass']){
														
															//update
															//update name
															update_user($id,'name',$_POST['name']);
															//update level
														 if(loginuserinfo('id')==$user_id){} else{

															update_user($id,'level',$_POST['role']);
															
															}
															//update pass
															if(!empty($_POST['pass'])){
															$password = base64_encode(md5($_POST['pass']));
															
															update_user($id,'password',$password);
															// add a password change log
																$current_login_user = loginuserinfo('id');
																add_user_meta('passwordchange',$current_login_user,$id);
															
															}
															//update email
															update_user($id,'email',$_POST['email']);
															//acount active
															update_user($id,'account_active',$_POST['account_active']);
															//about
															update_user($id,'about',htmlentities($_POST['about']));
														echo '	<div class="alert alert-success">
															<button type="button" class="close" data-dismiss="alert">&times;</button>
														You have successfully changed the profile
														</div>  ';
														}
														else{
															borno_die( 'You must fill the form properly');
														}
										 }
										else{
											borno_die( 'Similar email exist.' );
										}										 
									}
									else{
										borno_die(		'Invalid email.');
									}
						}
						else{
						borno_die( 'You can not do this');
						}						
					}
					else{
						borno_die( 'You can not do this');
					}
				}		
			
?>

<script type="text/javascript">
function validate_role(field,alerttxt)
{
with (field)
{
bpos=value;
if (bpos==1) 
  {
	var answer=confirm(alerttxt);
	if(answer){
	}
	else{
  return false;}
  }
else {}
}
}
//password match end

function validate_form(thisform)
{
with (thisform)
{
   if (validate_role(role,"Are you sure? You realy want to make this user admin ?")==false)
  {role.focus();return false;}

}
}
</script>
<?php			
			echo '<form method="POST" action="" onsubmit="return validate_form(this)">';
			//echo '<a href="'.get_the_option('site_address').'/?profile='.user_by_id($user_id,'username').'">Visit Profile</a>';
			//echo '<a href="'.get_the_option('site_address').'/profile/'.user_by_id($user_id,'username').'">Visit Profile</a>';
			echo the_user_link($user_id,true);
			?>
			
			<table class="table table-bordered">
				<tbody>
					<tr>
					  <td>Name</td>
					  <td><input name="name" class="" type="text" id="" value="<?php echo user_by_id($user_id,'name');?>" /></td>
					</tr>
					<tr>
					  <td>Username</td>
					  <td><input class="disabled" wrap="hard" disabled="yes" type="text" value="<?php echo user_by_id($user_id,'username');?>" /></td>
					</tr>
					<tr>
					  <td>Email</td>
					  <td><input name="email" class="" type="text" id="" value="<?php echo user_by_id($user_id,'email');?>" /></td>
					</tr>
					<tr>
					  <td>Password</td>
					  <td><input name="pass" class="" type="text" id="" /></td>
					</tr>
					<tr>
					  <td>Retype Password</td>
					  <td><input name="repass" class="" type="text" id=""/></td>
					</tr>
					
					
					<tr>
					  <td>Login Info</td>
					  <td><?php 
					  
					  $query1 = borno_query("SELECT * FROM $prefix_usermeta WHERE name = 'logged_in' AND user_id = '$user_id'");
					  	$query2 = borno_query("SELECT * FROM $prefix_usermeta WHERE name = 'logged_in' AND user_id = '$user_id' ORDER BY `times` DESC LIMIT 0 , 1");
					  
					  $count =  mysqli_num_rows($query1);
					  echo $count.' times login<br>';
					  while($row = mysqli_fetch_array($query2)){
					  
					  echo ' <b>Last Login:'.$row['browser'].' and ip '.$row['ip'].'</b><br>';
					  }
					  
					  
					  ?></td>
					</tr>
					<?php 
	$level = user_by_id($user_id,'level');
	$user_id_give =  user_by_id($user_id,'id');
	$user_key_give =  user_by_id($user_id,'active_key');
	$level = user_by_id($user_id,'level');

?>					
		<?php if(loginuserinfo('id')==$user_id){} else{?>

<tr>
					  <td>Role</td>
					  <td><select id="role" name="role">

					  
<?php echo ucr_diplay_role_li($level) ; ?>

</select></td>
					</tr>
					<?php } ?>
					<tr>
					<?php 
	$active_account = user_by_id($user_id,'account_active');
?>
		<?php if(loginuserinfo('id')==$user_id){echo "<input type='hidden' name='account_active' value='1'>";} else{?>

					  <td>Account</td>
					  <td><select name="account_active">
<option  value="1" <?php if ($active_account=='1') {echo "selected='selected'";}?> >Enable</option>
<option value="0"  <?php if (!$active_account=='1') {echo "selected='selected'";}?>>Disable</option>
</select></td>
					</tr>
										<?php } ?>

					<tr>
					  <td>About</td>
					  <td><textarea name="about"><?php echo user_by_id($user_id,'about');?></textarea><br></td>
					</tr>
				<tbody>
			</table>
<input type="hidden" name="user_id" value="<?php echo $user_id_give ;?>">
<input type="hidden" name="active_key" value="<?php echo $user_key_give ;?>">


<input type="hidden" name="CSRFToken"
value="<?php echo loginuserinfo("active_key"); ?>">
			<input type="submit" name="submit" value="Update" class="btn"/>
			</form>
			
			
			
			
			
			
			<?php if(loginuserinfo('id')==$user_id){} else{?>
		
			<script type="text/javascript">
function validate_del(field,alerttxt)
{
with (field)
{

	var answer=confirm(alerttxt);
	if(answer){
	}
	else{
  return false;}
  }
}

//password match end

function validate_form(thisform)
{
with (thisform)
{
   if (validate_del(e,"Are you sure?")==false)
  {e.focus();return false;}

}
}/*
function validate_del(thisform)
{
with (thisform)
{
   if (validate_del(e,"Are you sure? are you sure to delete this user? if you delete the user , all post by this user will delete")==false)
  {e.focus();return false;}

}
}*/
</script>
<form method="POST"  action="del.php?type=user&id=<?php echo $user_id ;?>&<?php echo 'CSRFToken='.loginuserinfo('active_key') ?>" onsubmit="return validate_del(this,'are your sure to delete this user?')">
<input type="submit" name="e" class="btn btn-danger btn-mini" value="Delete"/>
</form>
			
			
			
			
			
			<?php }
		}
		else{
			borno_die ('No user exists in this name');
		}
}
else{
	borno_die ( 'INSERT A VALID USERNAME' );
}