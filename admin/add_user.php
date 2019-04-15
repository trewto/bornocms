<?php
/*
*
*	Add new user page
*
*/
/*
*	check role
*/
if(!user_can('add_user')){
	borno_die('You can not add a user.');
}

if(isset($_POST['submit'])){
	
	/*
	*	check all element , step by step
	*/
	if(!empty($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['repassword']) && isset($_POST['roles']) && isset($_POST['name'])){
		if(!validate_name($_POST['name'])){
		
			borno_die( 'Invalid name , Please insert your full name.');
		}
		else if(filter_var($_POST['name'], FILTER_VALIDATE_INT)){
			borno_die( 'Invalid name');
		}
		else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			borno_die ('Invalid email');
		}
		else if(empty($_POST['password'])){
			borno_die( 'Password is empty.');
		}
		else if(!$_POST['password']==$_POST['repassword']){
			borno_die( 'Password is not matching');
		}
		else if(!validate_username($_POST['username'])){
		
			borno_die( 'Invalid username');
		}
		else if(empty($_POST['username'])){
			borno_die( 'Invalid username');
				
		}else if(!isset($_POST['CSRFToken']) or $_POST['CSRFToken']!=loginuserinfo('active_key')){
			borno_die( 'Maybe someone is trying to create a admin user');
		}
		else{
			//progress
				$username= $_POST['username'];
				$email= $_POST['email'];
				$qry = borno_query("SELECT * FROM $table_user WHERE username='".mysqli_escape($username)."' or email='".mysqli_escape($email)."'");
				$count = mysqli_num_rows($qry);
				if($count==0){
					//progreess
					$username= $_POST['username'];
					$email= $_POST['email'];
					$name= $_POST['name'];
					$password= base64_encode(md5($_POST['password']));
					$level= $_POST['roles'];
					//refer
					$refer = loginuserinfo('username');
					//user account active or not 
					$account_active = 1;
					//ad user
					$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789".	'0123456789``-=~!@#$%^&*()_+,./<>?;:[]{}\|oxyz';
$user_active_key =  md5(substr(str_shuffle($chars),0,8));	
					add_user($name ,$username , $email ,$password,$refer,$level,$account_active);
					
					//success
					borno_die('<div class="alert alert-success">
															<button type="button" class="close" data-dismiss="alert">&times;</button>
															The account is successfully created.
															</div> ');
				}
				else{
					borno_die ('Email or username is already exists');
				}
		}
	
	
	
	}
	else{
	
		borno_die ('All fields is required to fill');
	}

}

?>

<script type="text/javascript">
function validate_email(field,alerttxt)
{
with (field)
{
apos=value.indexOf("@");
dotpos=value.lastIndexOf(".");
if (apos<1||dotpos-apos<2) 
  {alert(alerttxt);return false;}
else {}
}
}

function validate_username(field,alerttxt)
{
with (field)
{
apos=value.length;
dotpos=value.lastIndexOf(" ");

if (apos<4||apos>12||dotpos>0) 
  {alert(alerttxt);return false;}
else {}
}
}

function validate_name(field,alerttxt)
{
with (field)
{
apos=value.length;
dotpos=value.lastIndexOf(" ");

if (apos<4||dotpos<1) 
  {alert(alerttxt);return false;}
else {}
}
}

function validate_pass(field,alerttxt)
{
with (field)
{
apos=value.length;
if (apos<8||dotpos>12) 
  {alert(alerttxt);return false;}
else {}
}
}
function validate_roles(field,alerttxt)
{
with (field)
{
apos=value;
if (apos=='1') 
  {
	var answer= confirm(alerttxt);
	if(answer){
	
	}
	else{
  return false;}
  }
else {}
}
}

////password match 

function validate_a_pass(fld){
	with(fld){
		abc = value;
		return abc;
	}
}
function validate_b_pass(fld){
	with(fld){
		abc = value;
		return abc;
	
	}

}


//password match end

function validate_form(thisform)
{
with (thisform)
{
	if (validate_email(email,"Not a valid e-mail address!")==false)
  {email.focus();return false;}
 if (validate_username(username,"Invalid Username || You Must entry biggan than 4 letter and less than 12 letter || No space allowed")==false)
  {username.focus();return false;}
  if (validate_name(name,"Invalid Name || You Must entry Your Full Username")==false)
  {name.focus();return false;}
  if (validate_pass(password,"You must inset 8-12 letter password")==false)
  {password.focus();return false;}
    if (validate_a_pass(password)!=validate_b_pass(repassword))
  {password.focus();alert('password not match');return false;}
   if (validate_roles(roles,"Are you sure? You realy want to make this user admin ?")==false)
  {roles.focus();return false;}

}
}
</script>

<h4>Add User</h4>
<form method="POST" action="" onsubmit="return validate_form(this);">
	<table class="table  table-bordered">
		<tbody>
			<tr>
			  <td>Name</td>
			  <td><input type="text" class="" id="name" name="name" /></td>
			</tr>
			<tr>
			  <td>Username</td>
			  <td><input type="text" class="" id="" name="username" /></td>
			</tr>
			<tr>
			  <td>Email</td>
			  <td><input type="text" class="" id="" name="email" /></td>
			</tr>
			<tr>
			  <td>Password</td>
			  <td><input type="password" class="" id="" name="password" /></td>
			</tr>
			<tr>
			  <td>Retype Password</td>
			  <td><input type="password" class="" id="" name="repassword" /></td>
			</tr>
			<tr>
			  <td>Level</td>
			  <td><select name="roles">
<?php
$de_level = get_the_option('user_defult_level');
 ?>			  

<?php echo  ucr_diplay_role_li(5) ; ?>
</select></td>
			</tr>
		</tbody>
    </table>
	<input type="hidden" name="CSRFToken"
value="<?php echo loginuserinfo("active_key"); ?>">
	<input type="submit" name="submit" value="Add User" class="btn btn-primary" />
</form>