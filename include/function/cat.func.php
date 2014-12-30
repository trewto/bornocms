<?php
/*
*	This is the category function page
*	@author:arnob protim roy
*	
*
*
*/


function the_cat_link($id){
	if(is_exists_cat($id)){
		if(link_type()=='dynamic'){
			if(cat_permalink($id)){
				return get_the_option('site_address').'/cat/'.cat_permalink($id);
			}else{
				return get_the_option('site_address').'/category/'.$id;
			}	
			
		}else{
			
			return get_the_option('site_address').'/?cat='.$id;

		
		}
		
	}
}



/*
**
*	Adding category function
*	
*
*
*/
function add_cat($cat_name , $cat_des='',$slug=''){


	$cat_name = mysqli_escape($cat_name);
	$cat_name = htmlspecialchars($cat_name);
	
	
	$cat_des = mysqli_escape($cat_des);
	$cat_des = htmlspecialchars($cat_des);
	
	
	
	
		if(empty($slug)){
				$slug  = 'random';
		}else if(!validate_username($slug)){
			$slug  = 'random';
		}
			
		$i=1;
		$ppb = $slug;
		while(true){
			if(!is_exists_catpermalink($slug)){
			
				break 1; 
				
			}else{
				$i++ ; 
				$slug = $ppb."_$i";
			
			}

		}
		
		$slug = mysqli_escape($slug);
		///we are successfullt ger $slug
		
		
		
		

	// get the  prefix_cat 
	global $prefix_cat;
	
	//query
	borno_query("INSERT INTO $prefix_cat (`name`, `description` ) VALUES ('$cat_name', '$cat_des')");

	$row = mysqli_fetch_array(borno_query("SELECT id FROM prefix_category  ORDER BY `id` DESC "));
	$cat_id = $row['id'];//content id
	
	borno_query("INSERT INTO prefix_catpermalink (`id`, `cat_id`, `permalink`) VALUES (NULL, '$cat_id', '$slug');");

}
















/*
*
*	Check Similar
*
*
*/
function is_similar_cat($cat_name){

	$cat_name = mysqli_escape($cat_name);
	
	global $prefix_cat;
	
	$query = borno_query("SELECT * FROM $prefix_cat WHERE name='$cat_name'");
	
	$count = mysqli_num_rows($query);
	
	if(!$count==0){
	
		return true;
		
	}
}



















/*
*
*
* update category
*
*/
function update_cat($id,$new_name ,$new_des,$slug=''){

	if(filter_var($id, FILTER_VALIDATE_INT)){
	
		$id = mysqli_escape($id);
		
		$new_name = mysqli_escape($new_name);
		$new_name = htmlspecialchars($new_name);
		
		$new_des = mysqli_escape($new_des);
		$new_des = htmlspecialchars($new_des);
		
		global $prefix_cat;

		borno_query("UPDATE $prefix_cat SET `name` = '$new_name',
		`description` = '$new_des' WHERE id = $id;
		");
		
		
		
		
		
		
	
		if(empty($slug)){
				$slug  = 'random';
		}else if(!validate_username($slug)){
			$slug  = 'random';
		}
			
		$i=1;
		$ppb = $slug;
		
		if($slug!=cat_permalink($id)){
			while(true){
				if(!is_exists_catpermalink($slug)){
				
					break 1; 
					
				}else{
					$i++ ; 
					$slug = $ppb."_$i";
				
				}

			}
		
		}
		
		$slug = mysqli_escape($slug);
		///we are successfullt ger $slug
		
		if(cat_permalink($id)){
				borno_query("UPDATE prefix_catpermalink SET `permalink` = '$slug' WHERE `cat_id` = $id; ");
		
		}else{
				borno_query("INSERT INTO prefix_catpermalink (`id`, `cat_id`, `permalink`) VALUES (NULL, '$id', '$slug');");
		
		}

		
		
		
		
		
		
		return ;
	}
	
}







/*
*
*
*	check if exists cat
*
*
*/
function is_exists_cat($cat_id){
		if(filter_var($cat_id, FILTER_VALIDATE_INT)){
				global $prefix_cat;
				$query = borno_query("SELECT * FROM $prefix_cat WHERE id='$cat_id'");
				$count = mysqli_num_rows($query);
				if(!$count==0){
					return true;
				}
				
		
		}
		
}














 
 
 
/*
*
*	Get the cat
*
*
*/ 
function get_the_cat($cat_id,$datatype){
	$cat_name = mysqli_escape($cat_id);
	
	if(filter_var($cat_id, FILTER_VALIDATE_INT)){
	
		global $prefix_cat;
		
		$query = borno_query("SELECT * FROM $prefix_cat WHERE id='$cat_id'");
		
		$count = mysqli_num_rows($query);
		
		if($count==1){
		
			$row = mysqli_fetch_array($query);
			
			return $row[$datatype];
		}
	}
}

















/*
*
*	the cat by post id
*
*
*
*/

function the_cat($post_id){

	if(filter_var($post_id, FILTER_VALIDATE_INT)){
	
		if(content_check($post_id)){
		
			global $prefix_catmeta;
			
			$post_id= mysqli_escape($post_id);
			
			$query = borno_query("SELECT * FROM $prefix_catmeta WHERE post_id='$post_id'");
			
			$count = mysqli_num_rows($query);
			
			if($count==1){
			
				$row = mysqli_fetch_array($query);
				
				$cat_id = $row['cat_id'];
				
				if(is_exists_cat($cat_id)){
					$cat = get_the_cat($cat_id,'name');
					return $cat;
				}
				else{
					borno_query("UPDATE $prefix_catmeta SET `cat_id` = '1' WHERE post_id =$post_id ");
					return 'Uncategory';
				}
			}
			else{
				return 'Uncategory';
				borno_query("INSERT INTO $prefix_catmeta (`post_id`, `cat_id`) VALUES ('$post_id', '1');");
			}
		}
			
	}

}





























/*
*
*	Category list
*
*
*
*
*
**/
function cat_list($start,$end,$linestart,$lineend,$link=false){
	
	#update on version 3.0.4
	
	
	
	
	
	
	
	
	global $prefix_cat;
	$query = borno_query("SELECT * FROM $prefix_cat");
	$count= mysqli_num_rows($query);
	if($count==0){
	
		echo '<'.$start.'>';
		echo '<'.$linestart.'>';
		
		
		echo 'Uncategory';
		echo '</'.$lineend.'>';
		echo '</'.$end.'>';
	}else{
			echo '<'.$start.'>';
		while($row= mysqli_fetch_array($query)){
		
			echo '<'.$linestart.'>';
			
			if($link){
				echo "<a href='".the_cat_link($row['id'])."'>";
			}
			echo $row['name'];
			
			if($link){
				echo '</a>';
			}
			
			echo '</'.$lineend.'>';
		

		
		}	echo '</'.$end.'>';
	
	
	
	
	}


}