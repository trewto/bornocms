<?php
/*
*   All function about menu system
*   
*
*/
    
	
	
	
	/*
	*	Adding a menu page on admin panel
	*
	*/
   add_page('menu','Menu' , 'mfs_menu_function' , 'manage_site' ,true, 'admin');
   
   
   
   /*
   *	Function of the panel
   */
   function mfs_menu_function(){
       
			/*
			*	Displaying the page title
			*/
			echo '<h2>Menu Page Content</h2><br>';
       
           if(isset($_POST['title'],$_POST['link'],$_POST['mainid'])){
                /*
                *
                * Value of the menu
                */
                $title = mysqli_escape($_POST['title']);
                $link = mysqli_escape($_POST['link']);
                $parent = mysqli_escape($_POST['mainid']);
               
                /*
                * Menu Added
                */
				
					if(!Empty($_POST['title']) and !empty($_POST['link'])){
						borno_query("INSERT INTO prefix_menu (`id`, `name`, `link`, `submenu`) VALUES (NULL, '$title', '$link', '$parent');");
					}
				}
				
				
				/*
				*
				*	Delelte this menu
				*/
				
				if(isset($_GET['del'])){
					$del = mysqli_escape($_GET['del']);
					borno_query("DELETE FROM prefix_menu WHERE id =$del ");
					borno_query("DELETE FROM prefix_menu WHERE submenu =$del ");
				}
			
			/*
			*	Display all menu
			*/
			
			/*
			*	It is a menu map
			*	Diplay the menu on admin panel (debug mode)
			*/
			
			$query = borno_query("SELECT * FROM prefix_menu WHERE submenu=0 ");
            $menu = array();
            
			
			echo '<ul>';
            while($row = mysqli_fetch_array($query)){
                

                
                $link = $row['link'];
                $name = $row['name'];
                $parent=$row['submenu'];
                $id = $row['id'];
              
               echo "<li>{$name} - {$link} - [$id]";
                echo "<a href='?pages=menu&del={$id}' class='btn text-danger'>Delete</a>";
				
               $new_query = borno_query("SELECT * FROM prefix_menu WHERE submenu='{$id}'");
			   
               if(mysqli_num_rows($new_query)!=0){
                   echo '<ul>';
                     while($row2 = mysqli_fetch_array($new_query)){
							$link = $row2['link'];
                            $name = $row2['name'];
                            $parent=$row2['submenu'];
                            $id = $row2['id'];
                          echo "<li>{$name} - {$link} - [$id]";
						  echo "<a href='?pages=menu&del={$id}' class='btn text-danger'>Delete</a>";
						  
						
						$new_query_2 = borno_query("SELECT * FROM prefix_menu WHERE submenu='{$id}'");

									 if(mysqli_num_rows($new_query_2)!=0){
						   echo '<ul class="'.$sub_ul_class.'">';
							 while($row2 = mysqli_fetch_array($new_query_2)){
								   $link = $row2['link'];
									$name = $row2['name'];
									 $parent=$row2['submenu'];
									 $id = $row2['id'];
								  echo "<li class='{$sub_li_class}'>{$name} - {$link} - [$id]";
								  echo "<a href='?pages=menu&del={$id}' class='btn text-danger'>Delete</a></li>";						  
							 }
						   echo '</ul>';//triple ul
						}
								  
						  echo '</li>';//subli
						  
						  
						  
                     }
                   echo '</ul>';//subul
               }
               echo"</li>";//mainli

                
            };
            echo '</ul>';//main ul
       
	   
	   
	   
	   
	   
	   
	   
	   
	   
		/*
			Add new menu form
		*/
		 echo "<form method='POST' action=''>"
				   . "<hr><h3> Add a new menu</h3><br>Menu Name<br> <input type='text' name='title' value=''/><br>"
				   . "Link<br> <input type='text' name='link' value=''/><br>"
				   . "Submenu<br><input type='text' name='mainid' value='0'/><br>"
				   . " <input type='submit' name='submit' class='btn btn-submit' value='Submit'/>"
				   . "</form>";
   }
    
	
	
	
	
	
	
	/*
	*
	*	Display the menu
	*
	*	Display your menu by view_menu();
	*/
	
	
	function  view_menu($ul_class='mainul nav',$main_li_class='mainli',$main_li_sub='',$sub_ul_class='subul',$sub_li_class='subli nav',$deep_ul_class='nav deel_ul',$deel_li_class='deep_li'){
			
			
			/**
			*	$query
			*
			*/
			$query = borno_query("SELECT * FROM prefix_menu WHERE submenu=0 ");
            $menu = array();
            
			
			/*
			*	Display menu , submenu and more deep submenu
			*
			*/
			echo '<ul id="nav" class="'.$ul_class.'">';
			
			
            while($row = mysqli_fetch_array($query)){
			
                
				/*
				*	Data
				**/
                
                $link = $row['link'];
                $name = $row['name'];
                $parent=$row['submenu'];
                $id = $row['id'];
              
			  
			  /*
			  *
			  *	Display Main menu
			  *
			  */
			  $new_query = borno_query("SELECT * FROM prefix_menu WHERE submenu='{$id}'");

			if(mysqli_num_rows($new_query)!=0){		 
               echo "<li class='{$main_li_class} {$main_li_sub}'>";
			  }else{
			     echo "<li class='{$main_li_class}'>";
			  }
               echo "<a href='{$link}'";
			   	if(mysqli_num_rows($new_query)!=0){	
					echo ' class="dropdown-toggle " data-toggle="dropdown"';
				}
			   echo ">$name";
			   	if(mysqli_num_rows($new_query)!=0){		
					echo ' <b class="caret"></b>';
				}
				echo "</a>";
				
			   
			   
			   /*
			   *	Display Submenu
			   **/
               if(mysqli_num_rows($new_query)!=0){
			   
			   
                   echo '<ul class="'.$sub_ul_class.'">';
				   
                     while($row2 = mysqli_fetch_array($new_query)){
					 
					 
					 
							$link = $row2['link'];
                            $name = $row2['name'];
                            $parent=$row2['submenu'];
							$id = $row2['id'];
							
							/*
							**
							*/
							echo "<li class='{$sub_li_class}'>";
							echo "<a href='{$link}'>$name</a>";						  
                    	
						
						
						$new_query_2 = borno_query("SELECT * FROM prefix_menu WHERE submenu='{$id}'");

						 if(mysqli_num_rows($new_query_2)!=0){
						   echo '<ul class="'.$deep_ul_class.'">';
							 while($row2 = mysqli_fetch_array($new_query_2)){
								   $link = $row2['link'];
									$name = $row2['name'];
									 $parent=$row2['submenu'];
									 $id = $row2['id'];
								  echo "<li class='{$deep_li_class}'>";
								  echo "<a href='{$link}'>$name</a></li>";						  
							 }
						   echo '</ul>';//triple ul end
					   }

						echo '</li>';//subli end







					}
                   echo '</ul>';//submenu ul end
               }
			   
               echo"</li>";//main menu li end

                
            };
			
            echo '</ul>';//main ul end
       
	   
	
	}