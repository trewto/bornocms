<?php
	/*
		the function file 
	*/
	//header and footer action
	//add_footer('Proudly Power By borno CMS'); // add a text to the footer
	//add_header('Proudly Power By borno CMS'); // add a text to the header
	//add_page('page_link','title' , 'the_content','user_role');
	/*
	 function the_content(){
	  $a = "<input type='text'/>";
	  $a .= "<input type='submit'/>";
		return $a;
	 }
 	add_page('blue','title2' , the_content(),'manage_user');	
	*/
/*	
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
				'delete_category'		=> 'true'
				);
ucr_add_role('x','DC' ,$level1);
ucr_add_role('y','Officer' ,'z');
ucr_add_role('z','manager' ,'z');
ucr_add_role('n','junior admin' ,'z');
ucr_add_role('a','waiter' ,'z');
ucr_add_role('r','cooker' ,'z');
add_shortcode('word','<span style="color:red">Red</span><br>');

*//*
add_shortcode('welcome','<span style="color:red">Red</span>');
add_shortcode('php','<span style="color:red">&lt;?php</span>');
add_shortcode('?','<span style="color:red">?&gt;</span>');
add_shortcode('echo','<span style="color:blue">echo</span>');
add_shortcode('function','<span style="color:blue">function</span>');
add_shortcode(';','<span style="color:blue">; </span>');
add_shortcode('&lt;!','<span style="color:green">&lt;!--');
add_shortcode('//','<span style="color:green">//');
add_shortcode('///','</span>');
add_shortcode('!&gt;','--!&gt;</span>');
*/
//////////////
////////	/////
///		////
////	///////	
/////// ///////
///////

/*
@	Add header
@	Add shortcode
@	add footer
@	add option page
@	add custom role
 add_sidebar($name)

*/
 add_sidebar('Right');
//////////////////////////////////
//	many  many pluhin ..
//
/////////////////////////
function pluginpage(){
	$output= '<h2>Manage your plugin</h2>';
	//updateing option
	
	if(isset($_POST['updatevalue']) and isset($_POST['inputarea'])){
		$data = stripslashes($_POST['inputarea']);
		$data = str_replace('/','',$data);
		$data = mysql_real_escape_string($data);
		$data = htmlentities($data);
		update_option('plugin',$data);
		$output .=  '<span style="color:green">updated-Your plugin query successfully updated</span>';
		borno_die_title('Successfully updated','plugin successfully updated');
	}
	
	$value = stripcslashes(get_the_option('plugin')) ;
	$value = strip_tags($value) ;
	$value = htmlentities($value) ;
	$value = stripslashes($value) ;
	$output .= "<br />
				<form method='post' action=''>
					<label for='pluginarea'>Before add plugin please sure that your plugin is ok and have not bug </label>
					<label for='pluginarea'>Enter the plugin file name , separated by comma (,) . Ex. rony.php,auto-post.php</label>
					<textarea id='pluginarea' name='inputarea' placeholder='contactshortcode.php,bigcode.php' style='width: 100%; height: 154px;'>$value</textarea>
					<input type='submit' name='updatevalue' class='btn btn-success' value='Update plugin query'/>
				</form>
			";
	///stat detect debug 
	
		$plugins = get_the_option('plugin');
		$plugins =stripcslashes($plugins);;
		$plugins =strip_tags($plugins);;
		$plugins = explode(',',$plugins);
		$output .= '<br>Debug</br>';
		

		
					
		foreach($plugins as $plugin){
		$trim_plugin= trim($plugin);
			if(!empty($trim_plugin)){
					if(file_exists('../include/plugin/'.$plugin)){
						
						
						if(check_multiple_load($plugin)==1){
						
							if(strpos($plugin,'./')){
							
								$output .= "<span style='color:red'>./ not allowed - not opened $plugin</span><br>";
							}
							else{
							$output .= "<span style='color:green'>opened $plugin</span><br>";
							}
							}
							else{
							$output .= "<span style='color:red'>multiple time loaded $plugin</span><br>";
							}
						
					}
					else{
						$output .= "<span style='color:red'>can't opend $plugin</span><br>";
					}
				}else{
						$output.='';
					}
		 
		 
		}
	
	//end/////////////////////
	
	return $output;
}
	
//add_page('manageplugin','Manage Your Plugin' , 'pluginpage','manage_plugin');	

add_shortcode('word','<span style="color:red">Red</span><br>');

