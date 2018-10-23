<?php
/*
* This is the user setting file
* all user can change their name and about form here
* available for all  user .
* Borno CMS
*
*/
	 
	

if(isset($_POST['submit']))	{

	/*
	*	if not isset $_POST['name'] or $_POST['about'] than die
	*
	*/
	if(!isset($_POST['name'])){borno_die('Error . Something wrong');}
	
	if(!isset($_POST['about'])){borno_die('Error . Something wrong');}
	
	/*
	*	Current user id
	*/
	$user_id = loginuserinfo('id');;
		
		/*
		*	Check the name
		*/
		if(validate_name($_POST['name'])){
			if(!count_from_string($_POST['name'],' ')==0){
			
				/*
				*	Update info
				*/
				update_user($user_id,'name',($_POST['name']));
				
				update_user($user_id,'about',($_POST['about']));
				
				/*
				*	Display Confirmation message
				*/
				echo '<div class="alert alert-success">You have successfully changed this.</div>';
			}
			else{
				/*
				*	request for insert full name
				*/
				echo 'Please enter your full name';
			}		
		}
		else{
		
				/*
				*	request for insert validate name
				*/
				$msg =  'Please fill a valid name.';
				echo '	<div class="alert alert-warning">
													<button type="button" class="close" data-dismiss="alert">&times;</button>
												'.$msg.'
												</div>  ';

		}
}
?>

<!-- INPUT FORM -->

<form method="post" action="">

	<!--MENU-->
	<b>Profile Setting || <a href="?pages=changepassword">Change Password</a></b>
	<b>||<a href="?pages=changesocial">Change Social Profile</a></b><br>
	
		<!--TABLE-->
			<table class="table table-hover table-bordered">
              <tbody>
                <tr>
                  <td>Name</td>
                  <td><input type="text" class="span4 " name="name" class="" value="<?php   if(isset($_POST['about'])){echo $_POST['name'];}else{  echo loginuserinfo('name'); }?>"/><br></td>
                </tr>
                <tr>
                  <td>User Name :</td>
                  <td>  <span class=""><?php echo loginuserinfo('username'); ?></span><br></td>
                </tr>
				  <tr>
                  <td>Email :</td>
                  <td>     <span class=""><?php echo loginuserinfo('email'); ?></span><br></td>
                </tr>
				
				  <tr>
                  <td>About :</td>
                  <td>     <textarea name="about"><?php if(isset($_POST['about'])){echo $_POST['about'];}else{ echo loginuserinfo('about');}; ?></textarea><br></td>
                </tr>
			



			
			<?php	
			
				/*
				*	GET Last to login info
				*/
				$usr_id = loginuserinfo('id');
				global $prefix_usermeta;
				$query = borno_query("SELECT * FROM $prefix_usermeta WHERE name = 'logged_in'AND user_id = '$usr_id'");
				$count = mysqli_num_rows($query);
				
				$query =borno_query("SELECT * FROM $prefix_usermeta WHERE name = 'logged_in' AND user_id = '$usr_id' ORDER BY `times` DESC LIMIT 1 , 1");
				$query2 =borno_query("SELECT * FROM $prefix_usermeta WHERE name = 'logged_in' AND user_id = '$usr_id' ORDER BY `times` DESC LIMIT 0 , 1");
				if($count>1){
				
				?>
				 <tr>
                  <td>Previous Log in :</td>
                  <td><?php 
				  /*
				  * 	Display the last login
				  */
				  while($row = mysqli_fetch_array($query)){
					echo $row['browser'];
					echo '<br> and IP : ';
					echo $row['ip'];
					echo '<br> and time ';
					echo $row['times'];
				  }
				  
				  
				  ?>  </td>
                </tr>
				
				 <tr>
                  <td>Current Logged in:</td>
                  <td>  <?php 
				  
				  /*
				  *	Display current login info
				  */
				  while($row = mysqli_fetch_array($query2)){
					echo $row['browser'];
					echo '<br> and IP : ';
					echo $row['ip'];
						echo '<br> and time ';
					echo $row['times'];
					
				  }
				  ?>  </td>
                </tr>
				
			<?php 
			} ?>
              </tbody>
            </table>

			<input type="submit" class="btn btn-primary" name="submit" value="Submit" />
</form>