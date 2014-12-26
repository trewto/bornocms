<?php
	/*
	 * Facebook and twitter address
	 */
//add_user_meta('logged_in','',$user_id);
//$prefix_usermeta

	//current user
		$user_id = loginuserinfo('id');
	//global the table string
		global $prefix_usermeta;
	//facebook query
		$fb_query = borno_query("SELECT * FROM $prefix_usermeta WHERE name = 'fb' AND user_id = '$user_id'");
		//facebook action
		$fb_count = mysqli_num_rows($fb_query);
		if($fb_count==1){
				$row = mysqli_fetch_array($fb_query);
				$fb_user = $row['value'];
		}
		else{
				$fb_user = '';
		}
	//twitter query
		$twitter_query = borno_query("SELECT * FROM $prefix_usermeta WHERE name = 'twitter' AND user_id = '$user_id'");
		//facebook action
			$twitter_count = mysqli_num_rows($twitter_query);
		if($twitter_count==1){
				$row = mysqli_fetch_array($twitter_query);
				$twitter_user = $row['value'];
		}
		else{
				$twitter_user = '';
		}	

	/*
     * if submited
	 */
	if(isset($_POST['submit']) && isset($_POST['fb']) && isset($_POST['twitter'])) {
		if(!empty($_POST['fb']) && !validate_username($_POST['fb'])){
			borno_die('Please insert a validate facebook username');
		}	
		if(!empty($_POST['twitter']) && !validate_username($_POST['twitter'])){
			borno_die('Please insert a validate twitter username');
		}
	
		if($fb_count==0){
		$fb_value= $_POST['fb'];
				$fb_value= mysqli_escape($fb_value);
				$fb_value = str_replace(' ','',$fb_value);
				$fb_value = htmlentities($fb_value);
			add_user_meta('fb',$fb_value,$user_id);
			$msg= 'Save Changed';
		}
		else if($fb_count==1){
			//change
			$fb_value= $_POST['fb'];
				$fb_value= mysqli_escape($fb_value);
				$fb_value = str_replace(' ','',$fb_value);
				$fb_value = htmlentities($fb_value);
			$msg= 'Save Changed';
			borno_query("UPDATE $prefix_usermeta SET value = '$fb_value' WHERE user_id =$user_id and name='fb'");
		}
		else{
			$msg = 'facebook not changed';
		}
		
		//twitter
		if($twitter_count==0){
				$twitter_value= mysqli_escape($_POST['twitter']);
				$twitter_value = str_replace(' ','',$twitter_value);
				$twitter_value = htmlentities($twitter_value);
			add_user_meta('twitter',$twitter_value,$user_id);
			$msg= 'Save Changed';
		}
		else if($twitter_count==1){
			//change
			$twitter_value= mysqli_escape($_POST['twitter']);
			$twitter_value = str_replace(' ','',$twitter_value);
			$twitter_value = htmlentities($twitter_value);
			borno_query("UPDATE $prefix_usermeta SET value = '$twitter_value' WHERE user_id =$user_id and name='twitter'");
			$msg= 'Save Changed';
		}
		else{
			$msg =  'twitter not changed';
		}
			
		//msg	
			echo '	<div class="alert alert-warning">
												<button type="button" class="close" data-dismiss="alert">&times;</button>
											'.$msg.'
											</div>  ';
	}
	
?>
<form method="post" action="">
	Your Social Profile
	<table class="table table-hover table-bordered">
        <tbody>
            <tr>
             <td>Facebook</td>
             <td><input type="text" name="fb" placeholder="Facebook Username" value="<?php if(isset($_POST['fb'])){echo htmlspecialchars($_POST['fb']); } else{  echo $fb_user ; } ?>"/></td>
			<tr>
			<tr>
             <td>Twitter</td>
             <td><input type="text" name="twitter" placeholder="Twitter Username" value="<?php if(isset($_POST['twitter'])){echo htmlspecialchars($_POST['twitter']); } else{ echo $twitter_user ; } ;?>"/></td>
			<tr>
		</tbody>
	</table>	
	
	<input type="submit" class="btn btn-primary" name="submit" value="Submit" />
</form>