<?php
/*
*	Site Setting
*	Basic site setting function
*	You can control some basic item in this site form this
*	page . Like user defult role , registration option allow 
*	or disallow	, site email , site name , site description , 
*	enable or disable contact form , theme , timezone and more..
*	@packge Borno CMS
*/


/*	//	Check user role	//	*/
if(!user_can('manage_site')){
	borno_die('You can not access this page');
}



/*	// if isset	[submit] than take some action//	*/
if(isset($_POST['submit'])){
		
		
		$up = true;

		
		/*	//	if not isset this input than die	//	*/
		if(!isset($_POST['site_name'])){borno_die('Something is wrong');}
		if(!isset($_POST['site_description'])){borno_die('Something is wrong');}
		if(!isset($_POST['site_email'])){borno_die('Something is wrong');}
		if(!isset($_POST['user_defult_level'])){borno_die('Something is wrong');}
		if(!isset($_POST['canregister'])){borno_die('Something is wrong');}
		if(!isset($_POST['site_time'])){borno_die('Something is wrong');}
		if(!isset($_POST['post_approvel'])){borno_die('Something is wrong');}
		if(!isset($_POST['contactfrom'])){borno_die('Something is wrong');}
		if(!isset($_POST['post_revision'])){borno_die('Something is wrong');}
		if(!isset($_POST['soaud_number_of_post_display'])){borno_die('Something is wrong');}
		
		
		
		
			/*	//	email	//	*/
			$email=$_POST['site_email'];
			
			/*	//	Check the email	//	*/
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				borno_die( 'Invalid email. Please give a correct email');
				$up = false;
			}
		
		/* //	Checking some condition	//*/
		if(empty($_POST['soaud_number_of_post_display'])){
			borno_die('empty value of post number of display not allowed');
		}
		
		
		
		
		/* //	Checking some condition	//*/
		$int_options = array("options"=>array("min_range"=>1));

		if(!filter_var($_POST['soaud_number_of_post_display'], FILTER_VALIDATE_INT, $int_options)){
			borno_die('miniman range 1 allow');
		}
		
		
		
		
		
		/* //	Checking some condition	//*/
		if(!empty($_POST['site_name']) && !empty($_POST['site_description']) && ($_POST['post_approvel']=='true' or  $_POST['post_approvel']=='false') ){
		}
		else{
			$up = false;
			$error = 'You can not fill blank the site name ';
		}
		
		
		
		
		
		/* //	Checking some condition	//*/
		if(isset($_POST['canregister']) && isset($_POST['user_defult_level']) && isset($_POST['site_time'])){
		}
		else{
			$up = false;
			$error ='something is wrong';
		}
		
		
		
		/* //	Checking some condition	//*/
		if($up == true){
			
			
					$timeset =htmlentities($_POST['site_time']);
				
					/*	//	updating the itmeplus option	//	*/
					 update_option('timelplus',$timeset);
			
			
					 $updated = true;
	
	
		}
		else{
			$updatewrong =  'Something is wrong to updated';
		}
}



/*	//	The Site title	//	*/
echo	'<h2>Site Options</h2><hr>';



/* 
*	if updated	than display a simple messege
*/
if(isset($updated)){
	if($updated){
			echo '<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					Saved changed.
				</div>';
	}
}



/* 
*	if isset error than display the error messege
*/
if(isset($error)){
		echo '	<div class="alert alert-warning">
												<button type="button" class="close" data-dismiss="alert">&times;</button>
											'.$error.'
											</div>  ';

}


/* 
*	if isset error than display the error messege
*/
if(isset($updatewrong)){
		echo '	<div class="alert alert-warning">
												<button type="button" class="close" data-dismiss="alert">&times;</button>
											'.$updatewrong.'
											</div>  ';

}
 ?>
<form method="POST" class="sitesettingform" action="">
<table class="table table-hover table-bordered">
<tbody>

<tr>
	<td>
		<label for="address">Website Address</label>
		<!--<i>You can not change this</i>-->
	</td>
	<td>
		<input type="text" id="address"  disabled="yes" wrap="hard" value="<?php echo get_the_option('site_address'); ?>" />
	</td>
</tr>

<tr>	
	<td>
		<label for="sitename">Website Name</label>
		<!--<i>Insert Your site Name</i>-->
	</td>
	<td>	
		<?php echo	_site_option_auto_update_display('site_name' , true,false) ; ?>

	</td>
</tr>	

<tr>	
	<td>
		<label for="description">Website Description</label>
		<!--<i>Insert Your site description</i>-->
	</td>
	<td>
		<?php echo	_site_option_auto_update_display('site_description' , true,false) ; ?>
	</td>
</tr>	

<tr>	
	<td>
		<label for="site_mail">Website Email</label>
	<!--	<i>Insert Your site email  ..</i>-->
	</td>
	<td>
		<?php echo	_site_option_auto_update_display('site_email' , true,false) ; ?>
	</td>
</tr>

<tr>	
	<td>
		<label for="post_approvel">Content Approval System </label>
	</td>
	<td>
		<?php
		$array = array('true','false');
		$valuearray = array('Yes','No');

		echo _site_option_auto_update_option_display('post_approvel' , $array,$valuearray ,true,false);
		?>
	</td>
</tr>

<tr>	
	<td>	
		<label for="post_approvel">Enable Contact form </label>
		<!--<i>Enable Contact Form in your site</i>-->
	</td>
	<td>
	<?php
		$array = array('true','false');
		$valuearray = array('Yes','No');

		echo _site_option_auto_update_option_display('contactfrom' , $array,$valuearray ,true,false);
	?>
	</td>
</tr>


<tr>	
	<td>	
		<label for="post_revision">Enable Content Revision System </label>
		<!--<i>If it enable all post and document log save on your database. You can see the revision of any content or document</i>-->
	</td>
	<td>
	<?php
	$array = array('true','false');
	$valuearray = array('Yes','No');

	echo _site_option_auto_update_option_display('post_revision' , $array,$valuearray ,true,false);
	?>
	</td>
</tr>

<tr>	
	<td>
		TimeZone<br>
		<!--<i>Select your country timezone	</i>-->
	</td>
	<td>
		<?php 
		$site_time = get_the_option('timelplus');
		?>
		<select name="site_time" >
			<option value="0">Please, select timezone</option>
			<?php foreach(tz_list() as $t) { ?>
				<option value="<?php print $t['zone'] ?>" <?php if($site_time== $t['zone']){echo "selected='selected'";}?>>
					<?php print $t['diff_from_GMT'] . ' - ' . $t['zone'] ?>
				</option>
			<?php } ?>
		</select>
	</td>
</tr>
	
<tr>	
	<td>
		Default Role
	<!--	<br><i>The default role of the new registered user</i>-->
	</td>
	<td>
<?php
	/*
	*	Default site role option 
	*	uses $array,$valuearray to adding some option to the selection
	*	uses $get_the_value to get the defult role value
	*	uses $newrole get the new registed role value
	*	uses _site_option_auto_update_option_display() display the function menu
	*/

	$array = array();
	$valuearray = array();
	echo _site_option_auto_update_option_display('user_defult_level' , $array,$valuearray ,true,false,false);
	
	$get_the_value = get_the_option('user_defult_level');
	
	echo $newrole = ucr_diplay_role_li($get_the_value);;
	
	echo '</select>';
	?>

	</td>
</tr>

<tr>
	<td>
		Registration Page 
		<!--<br><i>User can register in your site ?</i>-->
	</td>
	<td>
		<?php
		$array = array('true','false');
		$valuearray = array('Enable','Disable');

		echo _site_option_auto_update_option_display('canregister' , $array,$valuearray ,true,false);
		?>
	</td>
</tr>

<tr>
	<td>Permalink/Slug </td>
	<td>
		<?php 
		## ;_
		$array = array('Dynamic','Basic');
		$valuearray = array('dynamic','getstyle');
		echo _site_option_auto_update_option_display('site_permalink' , $valuearray,$array ,true,false);
		?>
	</td>
</tr>
<!--
	<tr>
		<td>Theme Folder Name
			<br>
			<i>Insert your theme folder name
			<br>
			Example: light_1 , ROB_2<br>
			Insert "offline" to site offline
			</i>
		</td>
		<td><?php echo _site_option_auto_update_display('theme_folder_name',true,true);?></td>
	</tr>-->
	<tr>
	<td>Content per page
			<br>
			<!--<i>the number of post you want to display
			</i>-->
		</td>
		<td><?php echo _site_option_auto_update_display('number_of_post_display',true,true);?></td>
	</tr>
<tbody>
</table>
	<input type="submit" name="submit" class="btn btn-success" value="Update" />
</form>