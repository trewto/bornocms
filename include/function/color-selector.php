<?php
	/*
	*
	*
	*	Adding a new color selector page
	*	10/6/2014
	*	@trewto
	*/
	
	add_page("panel_theme","Panel Theme" , 'color_selector','all',true,'profile');
	
	
	
	function color_selector(){
	
	
		if(isset($_POST['submit'])){
			if(isset($_POST['theme'])){
				setcookie('admin_theme', $_POST['theme'] , 60*60*24*30+time());//30 day 
				$new  = $_POST['theme'];
			}
			if(isset($_POST['headerenable'])){
				setcookie('headerenable', $_POST['headerenable'] , 60*60*24*30+time());//30 day 
				$newheader = $_POST['headerenable'];
			}
				if(isset($_POST['editor'])){
				setcookie('editor', $_POST['editor'] , 60*60*24*30+time());//30 day 
				$eeditor = $_POST['editor'];
			}
			
			
			
		echo '<div class="alert alert-success">Save Changed</div> ';

		
		}
		?>
		
		<form method='post' action=''>
			<!--Please Select your custom theme
			<select name='theme'>
			
				<?php 
				
					$select_value = isset($_COOKIE['admin_theme']) ? $_COOKIE['admin_theme'] : '';
					$select_value = isset($new) ? $new : $select_value;
					$namearray = array("Default ","Warm","Cold",'Mid Night','Jerry') ; 
					$valuearray = array("def ","warm","cold",'midnight','jerry') ; 
					echo display_select_options($namearray,$valuearray,$select_value)
				?>
			</select>
			
			Header Enable ?
			<select name='headerenable'>
			
				<?php 
				
					$select_value = isset($_COOKIE['headerenable']) ? $_COOKIE['headerenable'] : '';
					$select_value = isset($new) ? $newheader : $select_value;
					$namearray = array("Yes","No") ; 
					$valuearray = array("1","2") ; 
					echo display_select_options($namearray,$valuearray,$select_value)
				?>
			</select>
			-->
			
			Editor
			<select name='editor'>
			
				<?php 
				
					$select_value = isset($_COOKIE['editor']) ? $_COOKIE['editor'] : 'Tinymce';
					$select_value = isset($eeditor) ? $eeditor : $select_value;
					$namearray = array("Tinymce","Ckeditor") ; 
					$valuearray = array("Tinymce","Ckeditor") ; 
					echo display_select_options($namearray,$valuearray,$select_value)
				?>
			</select>
			
			
			
			
			<input name='submit' value='Submit' type='submit' class='btn btn-submit'/>
		</form>
		
		
		<?php
	
	}