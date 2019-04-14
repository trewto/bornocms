<?php
/*
	This is optional input for post & doc
*/


///create table ** Complete

$POST_DOC_OPTIONAL_INPUT = array();

//class
class optional_input{
	public $text;//text
	public $input_name;//input name
	public $input_type;
	public $type_array;
	
	function __construct($input_name,$text,$input_type,$type_array){
		$this->input_name=$input_name;
		$this->text=$text;
		$this->input_type=$input_type;
		$this->type_array=$type_array;
	}
	
}

// add optional input
function add_optional_content_input($input_name,$text,$input_type="input",$type_array=array()){
	global $POST_DOC_OPTIONAL_INPUT;
	$POST_DOC_OPTIONAL_INPUT[] = new optional_input($input_name,$text,$input_type,$type_array);
}


/*
//add_optional_content_input("color","Example input","input");
$options = array(
				//value , name
				"red"=>"Red color",
				"blue"=>"Blue color"
				
	
			);
//add_optional_content_input("color","Example input","select",$options);
//add_optional_content_input($input_name,$text,$input_type="",$input_type_array()=array(),$type="post")
//display input

*/
function view_optional_input($id){
	global $POST_DOC_OPTIONAL_INPUT;
	
	foreach ($POST_DOC_OPTIONAL_INPUT as $field){
		$p_id = $id ;
		$row = get_meta($field->input_name ,$p_id);
		$value = $row['value'];
	
		echo "<tr>";
		echo "<td>";
		echo $field->text;;
		echo "</td>";
		echo "<td>";
			if($field->input_type=="input"){
				echo "<input name='{$field->input_name}' value='$value' type='text'/>";/////////////////
			}else if($field->input_type=="select"){
				
				$namearray = array();
				$valuearray = array();
				foreach($field->type_array as $t=>$d){
					$namearray[] = $t;
					$valuearray[] = $d;
				}
				$select_value = $value;
				echo  "<select name='{$field->input_name}'>";
				echo display_select_options($namearray,$valuearray,$select_value);
				echo "</select>";
			}
		echo "</td>";
		echo "</tr>";
	
	}
	
}




function get_meta($field ,$type_id){
	$type_id = $type_id<1 ? 0 : $type_id  ; 
	$q = borno_query("SELECT * FROM prefix_meta where field='$field' and type='post' and type_id=$type_id");
	$row  = mysqli_fetch_array($q);
	return $row ;
}


function get_meta_by_id($id){
	$q = borno_query("SELECT * FROM prefix_meta where id=$id");
	$row  = mysqli_fetch_array($q);
	return $row ;
}

function create_metas($field,$value,$type,$type_id){
	$sql = "INSERT INTO borno_meta (`id`, `field`, `value`, `type`, `type_id`) VALUES (NULL, '$field', '$value', '$type', '$type_id');";
	$query = borno_query($sql,1,1);

}


function update_metas($id){
	
	global $POST_DOC_OPTIONAL_INPUT;
//var_dump($POST_DOC_OPTIONAL_INPUT);
	
	foreach($POST_DOC_OPTIONAL_INPUT as $pd){
	
	 $field = $pd->input_name;
	
	 if(isset($_POST[$field])){
			//if exits than update
			if(get_meta($field ,$id)){
				borno_query("UPDATE borno_meta SET `value` = '{$_POST[$field]}' WHERE type_id=$id and field='{$field}'");
			}else{
			//if not exists than create
				
					create_metas($field,$_POST[$field],'post',$id);
			
			}
		}
	}

	


}


function view_metas_of_post($field,$post_id){
	$q = borno_query("SELECT * FROM prefix_meta where field='$field' and type='post' and type_id=$post_id");
	$row  = mysqli_fetch_array($q);
	return isset($row['value']) ? $row['value']: 0 ;
}

