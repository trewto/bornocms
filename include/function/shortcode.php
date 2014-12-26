<?php
/* This is the shortcode page
*@@User can add shortcode form the post and display that {shortcode}
*
*
*/
class shortcode{
	public $shortcode_name;
	public $output;
	/*
	$data  = > array(
		role_id =>
		rolename =>
		array =>
	)
	
	*/
	

	public function __construct($x,$y){
		$this->shortcode_name =  $x;
		$this->output =  $y;
	}
	

}
$shortcoder= NULL;

function add_shortcode($x,$y){
	global $shortcoder;
	$shortcoder[] = new shortcode($x,$y);
}










////freeway sortcode
class freewayshortcode{
	public $shortcode_name;
	public $output;
	/*
	$data  = > array(
		role_id =>
		rolename =>
		array =>
	)
	
	*/
	

	public function __construct($x,$y){
		$this->shortcode_name =  $x;
		$this->output =  $y;
	}
	

}
$freewayshortcodeshortcoder= NULL;

function add_freewayshortcode($x,$y){
	global $freewayshortcodeshortcoder;
	$freewayshortcodeshortcoder[] = new freewayshortcode($x,$y);
}









/*
*	Comment shortcode
*	Shortcode in comment
*
*/

class comment_shortcode{
	public $shortcode_name;
	public $output;
	/*
	$data  = > array(
		role_id =>
		rolename =>
		array =>
	)
	
	*/
	

	public function __construct($x,$y){
		$this->shortcode_name =  $x;
		$this->output =  $y;
	}
	

}
$comment_shortcodeer= array();

function add_comment_shortcode($x,$y){
	global $comment_shortcodeer;
	$comment_shortcodeer[] = new comment_shortcode($x,$y);
}