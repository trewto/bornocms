<?php
/*
*
*	This is the about page of Borno CMS
*
*
*/

add_page("about","About" , 'b_about_page','all');
	
	
function b_about_page(){
	//this is the about page
	
	?>
	<h2>Welcome to Borno CMS</h2>
	<i>Version : <?php echo VERSION ; ?></i><br>
	
	<?php

}
