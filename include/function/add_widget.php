<?php
/*
*
*	since on version 1.0.7
*
*/

class widget{

	public $widget_title;//widget title
	public $function_name;//function to include
	public $widget_display_title;//widget display title
	

	public function __construct($widget_title,$function_name,$widget_display_title=''){
	
		$this->widget_title =  $widget_title;//title
		
		$this->function_name =  $function_name;//function to include
		
		//select title
		if(empty($widget_display_title)){
			$this->widget_display_title =  $widget_title;
		}else{
			$this->widget_display_title =  $widget_display_title;
		}
		
	}
	

}



/*
*	Don't re-use of $widget
*/
$widget = array();



/*
*
*	By this function developer can easily add widget 
*
*/
function add_widget($widget_title,$function_name,$widget_display_title=''){
	global $widget;
	$widget[] = new widget($widget_title,$function_name,$widget_display_title);
}



/*
*	Check the widget
*
*/
function check_widget_function($name){
	global $widget;
	$n = 0 ;
		foreach ($widget as $woop){
			if($name == $woop->function_name){
				$n++;
			}
		}
		return $n;
}


/*
*
*	Get the widget function
*
*/
function get_name_by_function($name,$type="widget_title"){
global $widget;

		foreach ($widget as $woop){
			if($name == $woop->function_name){
				return $woop->$type;
				
			}
		}
}






/*
add_widget('test title','test_funcs');
add_widget('Login WIdget','test_funcas');
add_widget('Side WIdget','test_funcawr');
function test_funcs(){
	echo 'this is an sample plugin';
}
*/