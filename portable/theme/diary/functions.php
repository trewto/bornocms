<?php

//password C12

function jerry_event(){



	if(((isset($_GET['search']) and !empty($_GET['search']))  or isset($_GET['profile']) or isset($_GET['cat']))){ ?>
<div class='event'>
		<?php if (isset($_GET['search']) and !empty($_GET['search'])) { ?>
		
		<?php echo search_result_count($_GET['search']);?> Result found
		
		<?php }if(isset($_GET['profile'])){
		
			$id =   the_user_by_username($_GET['profile'],'id');
			echo display_name($id)."'s Profile";
			
			echo "<br>";
			echo   the_user_by_username($_GET['profile'],'about');

							
		} ?>
		
		<?php if(isset($_GET['cat'])){
		
		echo get_the_cat($_GET['cat'],'name');
		
		 } ?>

		 

 </div>
	<?php } 

}


function x0012x9($string,$key="My key") {
$hash = '';
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
    for ($i = 0,$j=0; $i < $strLen; $i++) {
        $ordStr = ord(substr($string,$i,1));
        if ($j == $keyLen) { $j = 0; }
        $ordKey = ord(substr($key,$j,1));
        $j++;
        $hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));
    }
    return $hash;
}

function x012x29($string,$key="My key") {
$hash = '';
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
    for ($i = 0,$j=0; $i < $strLen; $i+=2) {
        $ordStr = hexdec(base_convert(strrev(substr($string,$i,2)),36,16));
        if ($j == $keyLen) { $j = 0; }
        $ordKey = ord(substr($key,$j,1));
        $j++;
        $hash .= chr($ordStr - $ordKey);
    }
    return $hash;
}




function cccccc(){
if(!user_logged_in()){
	return "Dummy Page";
}

$d = "";

if(isset($_SESSION["073236e1ada0f3c20304d6d650e586aa"]) && md5(md5(x012x29($_SESSION["073236e1ada0f3c20304d6d650e586aa"],"@@@##"))) == "073236e1ada0f3c20304d6d650e586aa" )
{

	return "Ok";
}
if(isset($_POST['code'])){
	if(md5(md5($_POST['code']))=="073236e1ada0f3c20304d6d650e586aa"){
		$_SESSION["073236e1ada0f3c20304d6d650e586aa"] = x0012x9($_POST['code'],"@@@##") ; 
	}
	//$d .=  x012x29($_SESSION["073236e1ada0f3c20304d6d650e586aa"],"@@@##");
}

if(1==2){

}else{

$d .= "Please input code
			<form method='post' action='' style=''>
				<br>
				<input type='text' class='form-control' name='code' placeholder='#code'>
				
				<br>
					<input type='submit' name='submit' class='btn btn-primary'  value='Submit' />
			</form>";
			
			return $d;
}

}
		
		
add_shortcode("CRYPT",cccccc());






add_optional_content_input("encryption","Encryption","select",array("True"=>"1","False" => "0")) ;
add_optional_content_input("password","Password","input") ;

