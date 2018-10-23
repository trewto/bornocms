<?php
/*
*	Image upload page
*
*/

require('admin-functions.php');




//check role
if(user_can('upload_image')){
	//display form
	echo '<form action="img_upload.php" method="post"
	enctype="multipart/form-data">
	<label for="file">Filename:</label>
	<input type="file" name="file" id="file"><br>
	<input type="submit" name="submit" value="Submit">
	</form>
	';
	//$upload_root = '../photos/';



	if(count($_POST)){

		if( count($_FILES) == 1 ){
			
			 $tmp = $_FILES['file'];

			 //checking progress 
			 
			 $dir = '../photos/';
			 
			 //makeing dir
			 $path = "../photos/";

			$year_folder = $path . date("Y");
			
			$month_folder = $year_folder . '/' . date("m");

			!file_exists($year_folder) && mkdir($year_folder , 0777);
			!file_exists($month_folder) && mkdir($month_folder, 0777);

			$dir = $month_folder . '/' . $new_file_name;
						 
						 
			 $loc = date("Y").'/'. date("m") . '/';
			 
			 
			 if(!class_exists("imgUploader")){
				include_once("ImgUploader.class.php");
			 }
			 $img = new imgUploader($_FILES['file']);
			 $time= time();
			// $_FILES['file']['name'];
			 $namewithoutext = explode('.',$_FILES['file']['name']);
		//	 $full = $img->upload_unscaled( '../photos/' ,$namewithoutext[0] );
			 $full = $img->upload_unscaled( $dir ,$namewithoutext[0] );
			 //upload short img
			 
			 
			 
			 
			 
			 
			 
			 	
			 $first=  substr($full,0,-4);
	
			 $last  = substr( $full,-4);
	
		
			 
			 //upload short img
			 
			 
			 $img->upload($dir,$first.'_200x200', 200, 200);
			 
			 
			 
			if($full){
				 $image  =  $loc.$full;
				// add reccord to database 
				 add_img_record($image,loginuserinfo('id'));
				
				echo '<br>';
				echo '<br>';
				
				echo "<img style='max-width:50%;max-height:50%;' src='".get_the_option('site_address').'/photos/'.$image."'/>";
				echo '<br>';
				echo '<br>';
				echo 'Your image has been uploaded successfully. Here is your image link';
				echo '<br>';
				echo '<br>';
				echo '<code>'.get_the_option('site_address').'/photos/'.$image.' </code>';
				
				
			}else{
				switch ( $img->getError()){
					case 101:
						echo "MAX SIZE EXCEDED. Allowed size less than 2MB";
					break;
					case 102:
						echo "UPLOAD_FAILED";
					break;
					case 103:
						echo "NO_UPLOAD";
					break;
					case 104:
						echo "NOT_IMAGE";
					break;
					case 105:
						echo "INVALID_IMAGE";
					break;
					case 106:
						echo "NONEXISTANT_PATH";
					break;
					case 107:
						echo "FILE_EXISTS";
					break;
					default:
						echo "UPLOAD_FAILED";
					break;
					
				
				}
			}
			
			
		}else{
			echo 'Something went wrong';
		}
	}


}
?>
<style>
input{
	background:white;
	border:1px solid #ccc;
}
</style>
	