<?php include "header.php" ;?>
		
		<div id="">
			<div id="">
				
				
					
					<div class="">
						<!--<h2 class="title">
							<a href="<?php echo doc_link($_GET['doc']); ?>"><?php echo get_the_doc_page($_GET['doc'],'title'); ?></a>
						</h2><//!--.title-->
			
					<!--	<div class=""
						<?php  get_the_doc_page($_GET['doc'],'content'); ?><br>
						</div> -->
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
				<?php
if(!(isset($_SESSION["073236e1ada0f3c20304d6d650e586aa"]) && md5(md5(x012x29($_SESSION["073236e1ada0f3c20304d6d650e586aa"],"@@@##"))) == "073236e1ada0f3c20304d6d650e586aa" )){
	echo 	cccccc();


}else
{















				if(user_can("new_post") or user_can("edit_own_post")or user_can("edit_all_post")){
				
				$ok  = 0; 
				
				if(!isset($_GET['c']) && user_can('new_post')){ $ok =1;}
				else if(isset($_GET['c']) && is_exists_content($_GET['c'])){
					if(user_can("edit_all_post")){$ok = 2;}
					else if(user_can("edit_own_post") && get_the_post($_GET['c'] ,'user_id')==loginuserinfo('id')){$ok ==3;}
				}else{
					
				}
				
				
				
				
				
				
				
				if( $ok==0  ){
					echo "You have no valid permission to this";
				//echo $ok ; 
				
				}
				
				
				

				else{
				
				
				
				
				$i = '';
				if(isset($_POST['title']) && isset($_POST['content']) && isset($_POST['encryption']) && isset($_POST['password'])){
					//add_new_post($user_id ,$title , $content,$post_status,$level,$password,$comment_permission ,$browser_info, $ip,$edited,$the_cat,$cpermalink)
					
					if(!isset($_POST['CSRFToken']) or $_POST['CSRFToken']!=loginuserinfo('active_key')){
						borno_die( 'Maybe someone is trying to create a spam content');
					}
		
		
					if(!isset($_GET['c'])){
						
						
						
											
					if(isset($_POST['encryption']) && $_POST['encryption']=="1"){ 
						$content = x0012x9( htmlspecialchars($_POST['content']),x012x29($_SESSION["073236e1ada0f3c20304d6d650e586aa"],"@@@##"));
					}
					else{
						$content = (htmlspecialchars($_POST['content']));
					}
					
					
						
						
						$id = add_new_post(loginuserinfo('id') ,$_POST['title'] , $content ,'publish','public',($_POST['password']),'true' ,'', '','false','1','');
						echo "<!--";
						update_metas($id);
						echo "-->";
						echo "Data is added";
						//borno_die('Added',);
					}else{
				
							$i  = $_GET['c'];
							
							
							
					if(isset($_POST['encryption']) && $_POST['encryption']=="1"){ 
						$content = x0012x9( htmlspecialchars($_POST['content']),x012x29($_SESSION["073236e1ada0f3c20304d6d650e586aa"],"@@@##"));
					}
					else{
						$content = (htmlspecialchars($_POST['content']));
					}
						
					//	edit_post($i,get_the_post($i , 'title') ,get_the_post($i , 'content') , $_POST['title'] ,  (htmlspecialchars($_POST['content'])),get_the_post($i , 'post_status'),get_the_post($i , 'post_level'),($_POST['password']),get_the_post($i , 'comment_permission') ,'true',loginuserinfo('id'),the_post_cat($i),content_permalink($i));
					edit_post($i,get_the_post($i , 'title') ,get_the_post($i , 'content') , $_POST['title'] ,  $content,get_the_post($i , 'post_status'),get_the_post($i , 'post_level'),($_POST['password']),get_the_post($i , 'comment_permission') ,'true',loginuserinfo('id'),the_post_cat($i),content_permalink($i));
								echo "<!--";
						update_metas($i);
						echo "-->";
						
						//edit_post($post_id,$title ,$content , $newtitle , $newcontent,$post_status,$level,$password,$comment_permission ,$edited,$user_id,$cat,$cpermalink);
						echo "Data is Changed";
					}
				
				
				}
				else{
					if(!isset($_GET['c'])){
						$edited_key='';	
						$i = '';
					}else{
						if(is_exists_content($_GET['c'])){
								$i  = $_GET['c'];
						}
					}
				?>		
						
						
						
						
			<form method='post' action='' style='margin:0 auto;text-align:Center'>
				<input type='text' class='form-control' name='title' placeholder='Title' value="<?php echo get_the_post($i , 'title') ; ?>">
				<br>
				<br>
				
				<?php
					//var_dump( get_meta('encryption' ,$_GET['c']));
					//die();
				
				?>
				<textarea name='content' id='info' style='
				max-width: 100%;
				height: 600px;
				
				
				'><?php 
				
				if(isset($_GET['c'])){
					$r = ( get_meta('encryption' ,$_GET['c']));
						if($r['value']=="1"){ 
							$c  = x012x29( get_the_post($i , 'content'), x012x29($_SESSION["073236e1ada0f3c20304d6d650e586aa"],"@@@##"));
						}
						else{
							$c = (get_the_post($i , 'content'));
						}
						
					
					
					echo $c ;
				}




				?></textarea>
				<br>
				<br>
					<table class="table table-striped table-bordered">
					<?php view_optional_input($i) ; ?>
					</table>
			<input type="hidden" name="CSRFToken"
value="<?php echo loginuserinfo("active_key"); ?>">
					<input type='submit' name='submit' class='btn btn-primary'  value='Save' />
			</form>
						
						
				<?php }


}


				} 
				
				
				}?>		
						
						
						
						
						
						
						
						
						
						
						
						
						
					
					</div><!--.artcle-->
					

			</div>
			
			
		</div>
		
		<?php include "footer.php" ;?>
	