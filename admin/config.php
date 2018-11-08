<?php
/*
*	Proxy Config
*	Dont make any change of this file
*/
if(file_exists('../config.php')){
	include('../config.php');
	
	
}
else{
	header('Location:../install.php');
}