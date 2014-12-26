<?php
/*
	Plugin Name Widget and sidebar
	since on version 1.0.7

*/

include('add_widget.php');
include('managesidebar.php');
include('display_widget.php');

add_page('widget','Widget' , 'manage_widget','manage_site',true,'admin');


function manage_widget(){
	global $widget;
	global $sidebar;
	
	$n = 1;
	if(!is_array($sidebar) or count($sidebar)==0){
		echo 'There are no sidebar';
		return;
	}
	if(!is_array($widget) or count($widget)==0){
		echo 'There are no Widget';
		exit();
	}
	if(count($_POST)){
		foreach($sidebar as $save){
			$sidename = $save->sidebarname;

			if(isset($_POST['fld_'.$sidename])){
			
				$field = $_POST['fld_'.$sidename];
				
				if(!is_array($field) or count($field)==0){
					update_option( 'widget_field_'.$sidename,''  );
				}else{
					$implode = implode('*',$field);
					update_option( 'widget_field_'.$sidename,$implode  );
				 }
			}else{
				update_option( 'widget_field_'.$sidename,''  );
				//echo "$sidename removed";
			}
			

		}
		echo '<div class="alert alert-success">
		<button data-dismiss="alert" class="close" type="button">×</button>
		Your Widget setting is updated
    </div>';
	}
	echo '<h2>Widget panel</h2>';
	
	echo '<form method="post" class="widget">';

	foreach($sidebar as $side){
	
	$sidename = $side->sidebarname;
	
	echo "<br><br><h2>$sidename</h2>";
	
	
	/*
	if(isset($_POST['fld_'.$sidename])){
		$field = $_POST['fld_'.$sidename];
		
		$implode = implode('*',$field);
		 update_option( 'widget_field_'.$sidename,$implode  );
		 
		 borno_die('Updated');
	}
	*/
	
	$data = get_the_option('widget_field_'.$sidename);
	$func =  explode('*',$data) ; // array
	
	
	$new_array = array();
	
	foreach($func  as $f){
		if(check_widget_function($f)){
			$name = get_name_by_function($f);
			$new_array[] = array($f , $name);
		}
	}
	

	
	$out = ''; 
//	echo '<form method="post" class="widget">';
	
	foreach($new_array as $single){
	
		$func_name = $single[0];
		$title  = $single[1];
	
		echo	"<p class='widget_{$n}'>";
		echo  "<select name='fld_".$sidename."[]'> ";
		foreach ($widget as $woop){
			if($woop->function_name==$func_name){
			echo "<option value='{$woop->function_name}' selected='selected'>".$woop -> widget_title. "</option>";
			}else{
			echo "<option value='{$woop->function_name}' >".$woop -> widget_title. "</option>";
			 
			}
		}
		echo  "</select>";
		echo "<span onclick='return del_in($n);' class='label label-danger'>Remove</span>";
		 echo'</p>';

	$n++;

		
	}








	'<p>';
	 "<select name='fld_".$sidename."[]'>";
	foreach ($widget as $woop){
		 "<option value='{$woop->function_name}'>".$woop -> widget_title. "</option>";
		$out.= "<option value='{$woop->function_name}'>".$woop -> widget_title. "</option>";
	
	}
	 "</select>";
	 '</p>';
	
	
	
	echo '<span class="endin_'.$sidename.'"></span>';
	echo "<span class='add_box_$sidename' style='color:green' >Add Widget</span>";
	
	//echo '<br><input type="submit" value="Submit"/>';
	//echo '</form>'
	?>
	
<script>
var i = $('.widget p').size() + 1; // total input

	$('.add_box_<?php echo $sidename ;?>').click(function(){
		
		$( ".endin_<?php echo $sidename; ?>" ).before( "<p class='widget_"+i+"'><select name='fld_<?php echo $sidename; ?>[]' ><?php echo $out;?></select><span onclick='return del_in("+i+");' class='label label-info'>Remove</span></p>" );
		
		i++ ;

	});
	
function del_in(e){
	var f = '.widget_'+e // del class 
	$(f).remove();
	   
}

</script>







<?php
		
	
	}
	
	echo '<br><input type="submit" class="btn" name="submit" value="Submit"/>';
	echo '</form>';
	
}