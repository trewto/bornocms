<?php
/*
*
*	Theme upload page
*
*/

add_page('upload_theme','Upload Theme' , 'upload_theme_func','manage_site',true,'admin');





function upload_theme_func(){

	/**
	**	The Form
	*/
	echo '<h1>Upload Theme</h1><form action="" method="post" enctype="multipart/form-data">

	<input type="file" name="file" id="file" />

	<input type="submit" name="Submit" class="btn btn-submit" value="Submit" />
	 
	</form>';

$csspack = array();


	if(isset($_POST,$_FILES) and isset($_FILES['file'])){

		//checking error
		if ($_FILES["file"]["error"] > 0){
			borno_die('Error detected'); 
		}
		 
		//if error not found 
		else
		{
			//var_dump($_FILES);
			echo $_FILES['file']['type'];

			if($_FILES['file']['type']!='application/zip'){
				//var_dump($_FILES['file']);
				borno_die('Not a valid zip file');
			
			}else{
				$file = $_FILES['file']['tmp_name'];
				$zip = zip_open($file);
				if (is_resource($zip)) {
					//we are opening the zip  . now read
					var_dump(zip_read($zip));
					/*
					* $za = new ZipArchive(); string $filename;
string $comment;
					*/
					
					$newtheme = New ZipArchive();
					$newtheme->open($file);
			//		echo $newtheme->filename;
//					echo $newtheme->comment;
			$errorsp = array();
			$vaiidthemename = array();
			$tfile = array();
			$filearea = '../portable/theme/';
				for( $i = 0; $i < $newtheme->numFiles; $i++ ){
				
					$stat = $newtheme->statIndex( $i );
				//	print_r( basename( $stat['name'] ) . PHP_EOL );
					$tfile = ( basename( $stat['name'] ) . PHP_EOL );
					//var_dump($stat);
					$t = substr($stat['name'],-1);
					if($t=='/'){
						//echo 'folder';
						if(is_dir($filearea.$stat['name'])){
							$errorsp[] = $stat['name'].'folder exists';
						}else{
							//nothing
						}
					}else{
						//if fiile
						if(file_exists($filearea.$stat['name'])){
							$errorsp[] = $stat['name'].' file exists';
						}else{
							//nothing
							$substrphp = substr($stat['name'],-4);
							if($substrphp=='.php' or $substrphp=='.css' ){
							$vaiidthemename = $stat['name'];
							}
							$substrphp = substr($stat['name'],-10);
							$substrphp1 = substr($stat['name'],-10);
							$substrphp2 = substr($stat['name'],-8);
							$substrphp3 = substr($stat['name'],-8);
							$substrphp4 = substr($stat['name'],-11);
							if($substrphp=='/style.css' ){
								$csspack[] = 'style.css';
							}if($substrphp1=='/index.php' ){
								$csspack[] = 'index.php';
							}if($substrphp2=='/404.php' ){
								$csspack[] = '404.php';
							}if($substrphp3=='/doc.php' ){
								$csspack[] = 'doc.php';
							}if($substrphp4=='/single.php' ){
								$csspack[] = 'single.php';
							}
							
						}
					}
				}
	//			var_dump($csspack);
				if(!in_array('index.php',$csspack) ||
					!in_array('style.css',$csspack) ||
					!in_array('404.php',$csspack) ||
					!in_array('doc.php',$csspack) ||
					!in_array('single.php',$csspack)){
					
					borno_die('Necessary files are not found.');
					
					}

					//var_dump($tfile);
					if(count($errorsp)==0){
				 $t = $newtheme->extractTo('../portable/theme');
				 }else{
				  $newtheme->close();
					$error_sp_im = implode('<br>',$errorsp);
					borno_die($error_sp_im);
				 }
				 if($t){
					 $newtheme->close();
					// unlink($file);
					// var_dump();
					 /*
					 *
					 *	Now work with detect theme name and activety
					 *	$vaiidthemename
					 *
					 /* */
					 //////////working
					borno_die('Theme is successfully uploaded','Success');
				 }
				
					

				}else{
					//unlink($file);
					echo 'Something is going wrong';
				}
			}

		}
	 
	 
	}
 
}