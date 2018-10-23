<?php
/*
*	Password Change Box
*
*/

/*
*	Current user
*/
$user_id = loginuserinfo('id');;

if(isset($_POST['submit'])){

	//check input
	if(!isset($_POST['newpassword'])){borno_die('Something is going wrong.');}
	if(!isset($_POST['renewpassword'])){borno_die('Something is going wrong.');}
	
	
	//check mewpassword length
	if(strlen($_POST['newpassword'])<8 or 12<strlen($_POST['newpassword'])){
		borno_die('Your password range must be [8-12]');
	}
	
	//cjecl mewpassword
	if(!empty($_POST['newpassword']) && $_POST['newpassword'] == $_POST['renewpassword'] ){
	
	
	//update
		$password = $_POST['newpassword'];
		$password = base64_encode(md5($password));
		update_user($user_id,'password',$password);
		
	//	$_SESSION['b']=$password;
		//add a log
		
		add_user_meta('passwordchange','self',$user_id);
		
		borno_die(  'You have changed your password successfully. For security purpose you are logged out. Please log in again.' );
		
			echo '	<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
				'.$msg.'
				</div>  ';
	}
	else{
	
	
		$msg=  '*You have to fill every input <br>Fill the passwords correctly.';
				echo '	<div class="alert alert-warning">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
					'.$msg.'
					</div>  ';
	}
	
}
?>


<script type="text/javascript">
function correctpass(){
 var myTextField = document.getElementById('password');
 var apos=myTextField.value.length;

	if (apos<8||apos>12) 
	  {alert('x:password; 8<x<12');myTextField.focus();return false;}
	else {}
 

}
</script>

<!--FROM-->

<form method="post" action="">

<b>	New Password</b>
			<table class="table table-hover table-bordered">
              <tbody>
                <tr>
                  <td>Password</td>
                  <td><input type="password" id="password" name="newpassword" class="" /><br></td>
                </tr>
                <tr>
                  <td>Retype password :</td>
                  <td><input type="password" name="renewpassword" class="" /><br></td>
                </tr>
              </tbody>
            </table>
	<input type="submit" class="btn btn-primary" name="submit" value="Submit" onclick="return correctpass()"/>

</form>