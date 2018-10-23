<?php
/*
*
*	Plugin Name: Upload plugin
*
*/


add_page('upload_plugin','Upload plugin' , 'upload_plugin_func','manage_site',true,'admin');





function upload_plugin_func(){

	/**
	**	The Form
	*/
	echo '<h1>Upload Plugin Packge</h1><form action="" method="post" enctype="multipart/form-data">

	<input type="file" name="file" id="file" />

	<input type="submit" name="Submit" class="btn btn-submit" value="Submit" />
	 
	</form>';


$plugok = false;

	if(isset($_POST,$_FILES) and isset($_FILES['file'])){

		//checking error
		if ($_FILES["file"]["error"] > 0){
			borno_die('Error Detected'); 
		}
		 
		//if error not found 
		else
		{
			//var_dump($_FILES);
			if(!$_FILES['file']['type']=='application/zip'){
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
					
					$newplugin = New ZipArchive();
					$newplugin->open($file);
			//		echo $newplugin->filename;
//					echo $newplugin->comment;
			$errorsp = array();
			$vaiidpluginname = array();
			$tfile = array();
			$filearea = '../portable/plugin/';
				for( $i = 0; $i < $newplugin->numFiles; $i++ ){
				
					$stat = $newplugin->statIndex( $i );
				//	print_r( basename( $stat['name'] ) . PHP_EOL );
					$tfile = ( basename( $stat['name'] ) . PHP_EOL );
					var_dump($stat);
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
							/*$substrphp4 = substr($stat['name'],-11);
							if($substrphp=='/plug.css' ){
								$csspack[] = 'style.css';
							}*/
							
								$substrphp4 = substr($stat['name'],-9);
								if($substrphp4=='/plug.php' ){
									$plugok = true;
								}

						}else{
							//nothing
							$substrphp = substr($stat['name'],-4);
								if($substrphp=='.php'){
								$vaiidpluginname = $stat['name'];
								}
						}
						
							$substrphp4 = substr($stat['name'],-9);
								if($substrphp4=='/plug.php' ){
									$plugok = true;
								}
					}
				}
				//var_dump($plugok);
				
				
				if(!$plugok){
					borno_die('Not a valid plug-in. plug.php is not found');
				}
				
					//var_dump($tfile);
					if(count($errorsp)==0){
				 $t = $newplugin->extractTo('../portable/plugin');
				 }else{
				  $newplugin->close();
					$error_sp_im = implode('<br>',$errorsp);
					borno_die($error_sp_im);
				 }
				 if($t){
					// $newplugin->close();
					// unlink($file);
					// var_dump();
					 /*
					 *
					 *	Now work with detect plugin name and activety
					 *	$vaiidpluginname
					 *
					 /* */
					 //////////working
					borno_die('Plug-in is successfully uploaded','Success');
				 }
				
					

				}else{
					//unlink($file);
					echo 'Something is going wrong';
				}
			}

		}
	 
	 
	}
 
}