<?php
/*
*	Register some defult widget of the cms
*
*
*
*/
	add_widget('Lasted Comment','aw_w__add_comment');
//add_widget('Popular Content','aw_w__popular_content');
	add_widget('Lasted Content','aw_w__lasted_content');
	add_widget('User Panel','aw_w_login');
	add_widget('Search','a_w_w__search_widget');
	add_widget('Menu','view_menu');
	add_widget('Lasted Content Only Title ','lasted_content_with_out_text',"Lasted Content");
	//add_widget('Popular Content Only Title ','popularpost_without_text',"Popular Content");
	add_widget('Document ','doc_dd_widget',"Document");
	add_widget('Category ','ddaww_cat_list_widget',"Category");
	
	function ddaww_cat_list_widget(){
		//cat_list($start,$end,$linestart,$lineend,$link=false)
		cat_list("ul","ul","li","li",true);
	}
	
	function aw_w__add_comment(){
		lasted_comment(5);
	}
	function aw_w__popular_content(){
		popularpost(5);
	}
	function aw_w__lasted_content(){
		lasted_content(5);
	}
	function aw_w_login(){
		login_widget(5);
	}
	
	function  a_w_w__search_widget(){
	?>	
		
	<center>
		<form method="get" class="center" action="<?php echo get_the_option('site_address');?>">
			<input type="text" name="search" class="span11 form-control" value="<?php if(isset($_GET['search'])){echo htmlspecialchars($_GET['search']);}?>"/>
			<button class="btn btn-submit" type="submit">Search!</button>
		</form>
		</center>
				
	<?php
	}
	
	
?>