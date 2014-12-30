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
	<i>Author : Trewto Roy </i><br>
	<i>This is the first version of Borno CMS. I am sure that you will be happy to use it</i>
	<!--<hr>
		Features:
	<hr>
	<div class="alert alert-warning">Updated Issue</div>
	<table class="table table-bordered">
		<tbody>
			<tr>
				<td>Fixed</td>
				<td>New</td>
				<td>Coming</td>
			</tr>
			<tr>
				<td>...</td>
				<td>Everything is new</td>
				<td>...</td>
			</tr>
		
		</tbody>
	</table>-->
	<?php

}
