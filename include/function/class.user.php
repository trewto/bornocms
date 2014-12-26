<?php
/*
*
*	User account class
*	You can manage user by this class . you can
*	display any user data by view ()  function.
*	You can also update user account by this class
*	change() function
*/

class user_account{

	/**
     * A private variable
     *
     * @var integer stores user_id for the class
     */
	private $user_id;
	 
	 
	/**
     * Sets $user_id to a new value 
     *
     * @param integer $user a value required for the class
     * @return void
     */ 
	public function __construct($user){
	
        $this->user_id = $user;
		
    }
	
	/**
     * Display the user information
     *
     * @param string $obj field name - display the user information 
     * @return mixed the user information
     */ 
	public	function view($obj){
	
		return the_user($this->user_id,$obj);
	
	}
	
	/**
     * Change the user information
     *
     * @param string $field field name 
     * @param string $new_value the new value
     * @return mixed with the new value
     */ 
	public	function change($field,$new_value){
	
		return update_user($this->user_id,$field,$new_value);
		
	}
} 