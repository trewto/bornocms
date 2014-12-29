<?php
/*
	Plugin Name: CMS Updater
	Detail: The plugin help you to update core file of this cms automatically 
	Author:Trewto Roy

*/


//creating a  page

add_page('core_updater','Updates' , 'core_updater','manage_site');


///function
function core_updater(){
	
	if(isset($_GET['check']) && $_GET['check']="update"){
				///check server config file && current version
				$serverconfig  = file_get_contents("https://raw.githubusercontent.com/trewto/bornocms/master/update.json");
				
				$serverconfig = json_decode($serverconfig);
				
				$server_version = $serverconfig->version;
				
							
				$serverconfig->detail ;
				
				
				if(VERSION == $server_version){
					echo "<h3>You are Updated</h3>";
				}else{
					if(isset($_GET['update']) && $_GET['update']="true"){
						////yah update just start :D
						
					
						
							foreach( $serverconfig->updater as $upversion=>$decode_data ){
								if(VERSION<$upversion){
									//than action 
											echo "Update start <br>";
											$source = $decode_data->src ."/" ; 
										
											if(is_array($decode_data->update)){
												echo "Upgrading to $upversion <br>";
											
												foreach ( $decode_data->update as $update ){
													echo "Updating $update <br>";	
													
													if($myfile = fopen("../$update", "w")){
														$txt = file_get_contents($source.$update);;
														fwrite($myfile, $txt);
														fclose($myfile);
													}

													
												
												}
											}
											//create new file
											
											if(is_array($decode_data->create)){
												
												foreach ( $decode_data->create as $create ){
														echo "Creating $create <br>";
														if($myfile = fopen("../$create", "w")){
															$txt = file_get_contents($source.$create);;
															fwrite($myfile, $txt);
															fclose($myfile);
														}
												}
											}
											
											
											//delete file
											if(is_array($decode_data->remove)){
											
												foreach ( $decode_data->remove as $remove ){
													echo "Removing $remove <br>";
													unlink("../".$remove);//unlink file
												}
											}
											
											
											echo "Upgrading Compleate to $upversion  :) ";
	
									
									
								}
								
							}
												
					
					}else{
					
					
						echo "You are backdated...
						<br>
							Your version is ".VERSION." <br> but lasted version is $server_version <br>
							$server_version : {$serverconfig->detail} <br>
						
						";
						echo '<a href="?pages=core_updater&check=update&update=true" class="btn btn-success">Update Now </a>
						<br>
						Warning ! Do not close the window while uploading ...
						<br>
						It may takes some minutes but it works !';
					}
				
				}
				
				
	
	
	}
	
	else{
	
	
		echo '
			<h2>Welcome to core updater page</h2>
			<a href="?pages=core_updater&check=update" class="btn btn-submit btn-success">Check for update</a>
	
		';
	}


}

/////////////////////////////////////////////////////////////////
/*	$array = array(
				"version" => "1.0",
				
				"detail"=>"Nothing",
				
				"updater" => array(
								"1.0"=>array(
											"src"=> "https://raw.githubusercontent.com/trewto/bornocms/master/",
								
											"update" => array(
															
														),
											"create" => array(
														"CHANGELOG.php"
													),
											"remove" => array(
													
													
													),
										),
									
										
							)
							
							
							
							
				
			);
			
			
echo json_encode($array) ; 
*/
/*
$v = "1.1";
foreach( $d->updater as $e=>$r ){
	if($v<$e){
		echo  "$e<br>";
	}
}*/