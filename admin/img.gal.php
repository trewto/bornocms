<?php
/*
*	Image gallery with pagenav
*	By @rnob
*	Image Gellary 
*/
require('admin-functions.php');
if($lck->PHOTO!=1){
	borno_die("You need pro version to access it");
}


 ?>
	<link href="<?php echo get_the_option('site_address'); ?>/assets/bootstrap/bootstrap.css" rel="stylesheet" />
<?php
if(isset($_GET['del']) && $_GET['del']>0){


	//check img exists or not
	$id = mysqli_escape($_GET['del']);
	$query = borno_query("SELECT * FROM prefix_photo WHERE id='{$id}'");
	//if exists check is current user the uploader of this img 
	if(!mysqli_num_rows($query)){
		return 'Image not found for delete';
	}
	//view the img and display the link of the images 
	$row= mysqli_fetch_array($query);
		
	if( user_can('delete_all_image')){
				
				
				//deleteing a image
				$first=  substr( $row['img'],0,-4);
				
				$last  = substr($row['img'],-4);
				
				$short_img =  '../photos/'.$first.'_200x200'.$last; 
				$full_img = '../photos/'.$row['img'];
			
			
				if(file_exists($short_img)){
					//delete short img
					unlink($short_img);
					echo '<br>Short img deleted<br>';
					
				}
				if(file_exists($full_img)){
					//delete big img
					unlink($full_img);
					echo '<br>Full img deleted<br>';
				}
								borno_query("DELETE FROM prefix_photo  WHERE id={$row['id']}");

			
			
			//progress for delete
	}else if(user_can('delete_own_image')){
		if($row['user_id']==loginuserinfo('id')){
			
				
				//progress for delete
		}else{
			echo 'Invalid try';
		}
	}else{
			echo 'Invalid try';
	}

			
}
if(!isset($_GET['gal'])){
	
	?>
	
	<form method='get' action=''>
		<br>
		<br>
		<input type='submit' class='btn btn-submit' name='gal' value='Open Gellary'/>
	</form>
	<?php

}else{
	echo "<br><a href='".admin_url()."/img.gal.php?gal=true' class='label label-success'>Main</a> <br><br>";
	
	if(isset($_GET['img_id'])){
		if($_GET['img_id']>0){
			//check img exists or not
			$id = mysqli_escape($_GET['img_id']);
			$query = borno_query("SELECT * FROM prefix_photo WHERE id='{$id}'");
			//if exists check is current user the uploader of this img 
			if(!mysqli_num_rows($query)){
				return 'Image not found';
			}
			//view the img and display the link of the images 
			$row= mysqli_fetch_array($query);
			
			
			
		 ?>
		 	<?php
		$first=  substr( $row['img'],0,-4);
		
		$last  = substr( $row['img'],-4);
			//echo get_the_option('site_address'). '/photos/' .$first.'_200x200'.$last; 
	
		?>
	 <img src='<?php echo get_the_option('site_address'). '/photos/' .$first.'_200x200'.$last; ?>'>
		<br>	<?php
			//if user can delete img then show delete bottom
			$img_link =  get_the_option('site_address'). '/photos/' .$row['img']; 
			
			echo "Img link:  <br><code>{$img_link}</code>";
			
			
			/*
				$first=  substr( $img_link,0,-4);
				
				$last  = substr($img_link,-4);
				
				echo $first.'_200x200'.$last; 
				*/
				
				
				if( user_can('delete_all_image')){
							echo '<br><br><a href="?del='.$row['id'].'">Delete</a>';;
				}else if(user_can('delete_own_image')){
					if($row['user_id']==loginuserinfo('id')){
							echo '<br><br><a href="?del='.$row['id'].'">Delete</a>';
					}
				}
			?>
		
			
			
			
			
			
			
			
			<?php
			
		}else{
			echo 'Image not found';
		}
	}else{
		//img gellary with page nav
		//img show order by date uploaded 
		//img show order by current user
		//search
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
/*
*	added search text to query
*/		
if(isset($_GET['s'])){
	$search = mysqli_escape($_GET['s']);
	$sk = htmlspecialchars($_GET['s']);;
	$sql = "SELECT * FROM prefix_photo WHERE (img LIKE '%$search%')";
}else{
	$sql = ("SELECT * FROM prefix_photo ");
	$sk = "";
}

if(isset($_GET['user'])){
	$guser = mysqli_escape($_GET['user']);
	$sql = $sql.' and user_id="'.$guser.'"';

}



$per_page= 10;

//echo $sql;


$count = mysqli_num_rows(borno_query($sql));



if(isset($_GET['per_page'])){
	$int_options = array("options"=>array("min_range"=>1));

	if(filter_var($_GET['per_page'], FILTER_VALIDATE_INT, $int_options)){
		
		$per_page = $_GET['per_page'];
	
	}
	else{
		$die = ('<hr>invalid number of per page<hr>');
	}
}else{
	$per_page = 10;
}

$current_page =0 ;

if(isset($_GET['page'])){
	$int_options = array("options"=>array("min_range"=>1));

	if(!filter_var($_GET['page'], FILTER_VALIDATE_INT, $int_options)){
	
		$die = ('<hr>Page Not found<hr>');
	}
	 $current_page = $_GET['page'];

}
else{
	$current_page = 1 ;
}

$last_page = ceil($count/$per_page);


$start = ($current_page-1)*$per_page;

if($current_page>$last_page){
	$die = ('<hr><i class="text-danger">No content in this page</i><hr>');
}




if($current_page==1){
	$pre = '';
}else{
	$a = $current_page-1;
	$pre=  " <a href='?page=$a&s=$sk&per_page=$per_page&gal=open'> Previous </a> ";
}



if($current_page>=$last_page){
	$nxt = '';
}else{
	$a = $current_page+1;
	$nxt=  " <a href='?page=$a&s=$sk&per_page=$per_page&gal=open'> Next </a> ";
}


echo "<form method='get' action=''><input name='s' type='text' style='border:1px solid white;' placeholder='Keyword '>
<input name='per_page' style='border:1px solid white;'  type='text' value='$per_page'> 
<input name='gal'   type='hidden' value='open'> 

<input type='submit' value='Submit' class='btn btn-large'></form>";
if(isset($die)){
	die($die);
}


// Now lets set the limit for our query
$limit = "LIMIT $start, $per_page";
//ORDER BY `info`.`id` DESC 
//echo $count. ' result <br>';
$query = borno_query("$sql ORDER BY `id` DESC $limit ");


/////////////////////////////////////////
if($count<1){
	return 'Nothing found';
}


?>

<table class="table table-hover  table-striped">
	<tr>
		<td>Images</td>
		<td>Date of upload</td>
	</tr>
	<?php while($img = mysqli_fetch_array($query)){ ?>
	
	<?php if(file_exists('../photos/'.$img['img'])){ ?> 
	<tr>
		<?php
		$first=  substr( $img['img'],0,-4);
		
		$last  = substr( $img['img'],-4);
			//echo get_the_option('site_address'). '/photos/' .$first.'_200x200'.$last; 
	
		?>
		<td ><img style='' src='<?php echo get_the_option('site_address'). '/photos/' .$first.'_200x200'.$last; ?>'>
		<a href="<?php echo admin_url();?>/img.gal.php?gal=open&img_id=<?php echo $img['id'];?>">Open</a>
		</td>
		<td><?php echo $img['time']; ?></td>
	</tr>
	
	
	<?php }
	
	} ?>	
</table><?php
echo $pre;
echo $nxt;

		
		
	
	}

	
	
}