<?php
/*
*
*	Doucment function
*
*
*
*/











function doc_link($id){
	if(is_exists_doc($id) or $id== 'contact'){
		if(get_the_option('site_permalink')=='dynamic'){
			if(doc_permalink($id)){
				return get_the_option('site_address').'/doc/'.doc_permalink($id);
			}else{
				return get_the_option('site_address').'/document/'.$id;
			}
		}else{
			
			return get_the_option('site_address').'/?doc='.$id;
		}
	}

}






/*
*
*
*	get the doc page
*
*
*/
function get_the_doc_page($doc_id,$item){
global $prefix_doc;
if($doc_id=='list'){
	if($item =='title'){
		return 'Document Map';
	
	}
	else if($item == 'content'){
	$query = borno_query("SELECT id,title FROM $prefix_doc WHERE doc_status='publish'");

		
		$output ='<ul>';

		while($row=mysqli_fetch_array($query)){

				$output .= '<li><a href="'.doc_link($row['id']).'">'.$row['title'].'</a></li>';
		
		
		}
			if(get_the_option('contactfrom')==='true'){
				
				$output .= '<li><a href="'.doc_link('contact').'">Contact</a></li>';
				
				
				
			}
		
		
		$output .= '</ul>';
		
		$count = mysqli_num_rows($query);
		if($count==0){
			return 'No document available ';
		}
		return $output;
	}
	else if($item = 'count'){
	
		$query = borno_query("SELECT * FROM $prefix_doc WHERE doc_status='publish'");

		return  mysqli_num_rows($query);

	}

	

}/*contact form started */
else if($doc_id=='contact'){
	if($item =='title'){
		return 'Contact form';
	}
	else if($item =='content'){
		$adrress = get_the_option('site_address').'/include/plugin/contact.php';
		include('include/function/contact.php');
		
	}

}
/*contact form end*/
else if(filter_var($doc_id, FILTER_VALIDATE_INT)){
	$doc_id = mysqli_escape($doc_id); //string
	$query = borno_query("SELECT * FROM $prefix_doc WHERE id='$doc_id'");//$query
	
	//if any doc doc found in $GET[doc]
	if(mysqli_num_rows($query)=='1'){
		$row  = mysqli_fetch_array($query);
		
		//if the doc condition is publish
		if($row['doc_status']=='publish'){
				//give permission
				if($item=='times'){
					return $row['times'];
				}
				else if($item=='title'){
					return $row['title'];
				
				}
				else if($item=='content'){
					
					$content = $row['content'];
						global $shortcoder;
						//$datas = str_replace();
						if(is_array($shortcoder)){
							foreach ($shortcoder as $shortcode){
							
								
								$scode = $shortcode->shortcode_name;
								$sput = $shortcode->output;
								$content = str_replace('{'.$scode.'}',$sput,$content);
							}
						}
				
					
					return $content;
				}
				else if($item=='edited'){
					return $row['edited'];
				}
				else if($item=='user_id'){
					return $row['user_id'];
				}
				else{
					return false;
				}
				
		}
		//if the doc condition is draft
		if($row['doc_status']=='draft'){
			//if the doc editor id is equal to loggedin user id
			if($row['user_id']==loginuserinfo('id')){
					//give permission
			}
			else{
				return false;
			}
		}
	}
	else{
		return false;
	}
}
else{
		return false;
}



}






























/*
*
*	is exists doc
*
*
*
*/
function is_exists_doc($doc_id){
	if(!filter_var($doc_id, FILTER_VALIDATE_INT)){
	
	return false;
	
	}
	else{
		global $prefix_doc;
		$query = borno_query("SELECT * FROM $prefix_doc WHERE id='$doc_id'");
		
		$count = mysqli_num_rows($query);
		if($count==1){
			return true;
		}
		else{
			return false;
		}
		
	
	}

}

























/*
*
*
*
*	getting the doc
*
*/
function get_the_doc($doc_id,$data){
	if(filter_var($doc_id, FILTER_VALIDATE_INT)){
		global $prefix_doc;
		$query = borno_query("SELECT * FROM $prefix_doc WHERE id='$doc_id'");
		$count = mysqli_num_rows($query);
		if($count==1){
			$row = mysqli_fetch_array($query);
			return $row[$data];
		}
		else{
		return false;
		}
	
	}
	else{
		return false;

	}
}


































/**
 * change place admin-function.php to here on 1.0.6
 * Add document
 **/
 function add_doc($title,$doc_content,$user,$post_status,$permalink=''){
	global $prefix_doc;
	
	$title = mysqli_escape($title);
	$title = htmlspecialchars($title);
	$post_status = mysqli_escape($post_status);
	$user = mysqli_escape($user);
	$doc_content = mysqli_escape($doc_content);
	
	
	
	
	
	
		/*
		*	Decide the new peramilijhnk
		*
		*/
		
			/*
			*	check the permalink is empty or not
			*/
			
			if(empty($permalink)){
				$permalink  = 'random';
			}else if(!validate_username($permalink)){
				$permalink  = 'random';
			}
			
		$i=1;
		$ppb = $permalink;
		while(true){
			if(!is_exists_cpermalink($permalink)){
			
				break 1; 
				
			}else{
				$i++ ; 
				$permalink = $ppb."_$i";
			
			}

		}
		
		$permalink = mysqli_escape($permalink);
	
	
	
	
	
	
	
	
	$browser_info = $_SERVER['HTTP_USER_AGENT'];//browser info
	$ip  = get_IP();// ip
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789".
	'0123456789``-=~!@#$%^&*()_+,./<>?;:[]{}\|oxyz';
   $active_key =  md5(substr(str_shuffle($chars),0,8));
	borno_query("INSERT INTO  $prefix_doc (`user_id`, `title`, `content`, `doc_status`, `browser_info`, `ip`, `edited`, `active_key`) VALUES ('$user', '$title', '$doc_content', '$post_status', '$browser_info', ' $ip', 'false', '$active_key')");
	
	$row = mysqli_fetch_array(borno_query("SELECT id FROM prefix_doc  ORDER BY `id` DESC "));
	$doc_id = $row['id'];//content id
	
	
	//adding permalink meta
	borno_query("INSERT INTO prefix_dpermalink (`id`, `doc_id`, `permalink`) VALUES (NULL, '$doc_id', '$permalink');");
	
	
 }
/**
 *
 * Edit document
 **/
 
 function edit_doc($doc_id,$title ,$content , $newtitle , $newcontent,$doc_status,$edited,$user_id,$permalink=''){
	global $prefix_doc ;
	//editeed
	$doc_id = mysqli_escape($doc_id);
	$title = mysqli_escape($title);
	$content = mysqli_escape($content);
	$newtitle = mysqli_escape($newtitle);
	$newtitle = htmlspecialchars($newtitle);
	$newcontent = mysqli_escape($newcontent);
	$doc_status = mysqli_escape($doc_status);
	$user_id = mysqli_escape($user_id);
	$edited = mysqli_escape($edited);
	borno_query("UPDATE $prefix_doc SET title= '$newtitle' ,
	`content` = '$newcontent',
	`doc_status` = '$doc_status',
	`edited` = '$edited'
	 WHERE id = '$doc_id'");
	 
	 //ad a info to meta 
	 global $prefix_doc_meta;
	 $browser_info = $_SERVER['HTTP_USER_AGENT'];//browser info
	$ip  = get_IP();// ip
	
	 $sql = "INSERT INTO $prefix_doc_meta ( `name`, `user_id`, `post_id`, `previous_title`, `previous_content`, `browser_info`, `ip`) VALUES ( 'reviceinfo', '$user_id', '$doc_id', '$title', '$content', '$browser_info', '$ip')";
		borno_query($sql);
		
		
		
		
		
		
		
		
		
		
			
		/*
		*	Decide the new peramilijhnk
		*
		*/
		
			/*
			*	check the permalink is empty or not
			*/
			
			if(empty($permalink)){
				$permalink  = 'random';
			}else if(!validate_username($permalink)){
				$permalink  = 'random';
			}
			
		$i=1;
		
		if( doc_permalink($doc_id) != $permalink ){
		
		
			$ppb = $permalink;
			while(true){
				if(!is_exists_cpermalink($permalink)){
				
					break 1; 
					
				}else{
					$i++ ; 
					$permalink = $ppb."_$i";
				
				}

			}
		}
		
		$permalink = mysqli_escape($permalink);
	
	
		
		
		if(doc_permalink($doc_id)){
			borno_query("UPDATE prefix_dpermalink SET `permalink` = '$permalink' WHERE `doc_id` = $doc_id; ");
		
		}else{
			borno_query("INSERT INTO prefix_dpermalink (`id`, `doc_id`, `permalink`) VALUES (NULL, '$doc_id', '$permalink');");
		
		}

		
		
		
		
		
		
		
		
		
		
		
		
		
	 
}
