<?php
/*
*	Session Class
*	You can view season , change or create
*	season , unset single or  destroy  all
*	season by this class
*
*
*
*/

/*
*
*	if not already started season than start
*	session.
*
*/
if(!isset($_SESSION)){
	session_start();
}

/*
*
*	The session class
*
*
*/
class the_session{
	
	
	 
	/**
     * Display $_session[$data]
     *
     * @param mixed $data the field of 
	 * session you wanted to display
     * @return mixed
     */ 
	public function view($data=false){
	
	  /**
	  *
	  *	if $data is false display full session
	  *
	  *
	  */
      if(!$data){
	  
		return $_SESSION;
		
	  }
	  /**
	   *
	   *	Display the spefic session if isset
	   *
	   */
	  else{
		return isset($_SESSION[$data]) ? $_SESSION[$data] : false ;
	  }
		
    }
	
	
	/**
     * adding or change session
     *
     * @param string $sessionid the field of 
	 * session you wanted to change or create
	 * @param mixed $value the value for session
     * @return mixed
     */ 
	public function change($sessionid,$value){
		
		$_SESSION[$sessionid]= $value ; 
	
    }
	
	/*
	*	Remove or destroy session
	*	if $sessionname is false destroy full session
	*	else unset the spefic session
	*	@param mixed $sessionname the session field to destroy
	*/
	public function remove($sessionname=false){
	
		if(!$sessionname){
			session_destroy();
		}
		else{
			if(isset($_SESSION[$sessionname])){
				unset($_SESSION[$sessionname]);
			}
		}
	}


}


