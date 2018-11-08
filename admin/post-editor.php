<?php
/*
*
*
*	This is the (post/content)-editor
*
*
*/

if(user_can('edit_own_post') or user_can('edit_all_post') or user_can('new_post') ){//check the role

//default variable
$permission='false';
$edited_id='';
$edited_title='';
$edited_content='';
$edited_status='';		
$edited_level='';		
$edited_password='';		
$edited_comment='';		
$edited_key='';	
$hidden_value='';	
$t_cat='';	
$submit_key='submit';


if(isset($_GET['edit_id'])){ // check that this page is editable page or not

	$permission ='';
	
	$edit_id = $_GET['edit_id'];
	
	 if(!filter_var($edit_id, FILTER_VALIDATE_INT)) // check the id 
	 {
		$msg = 'invalid post id';
		//not done
	 }
	 else
	 {
		//next progress
		$query = borno_query("SELECT * FROM $prefix_contents WHERE id='$edit_id'"); //query
		$count = mysqli_num_rows($query);
			if($count==1){
			
				if(user_can('edit_own_post')){//check the role
				
					$row = mysqli_fetch_array($query);
					
					if(loginuserinfo('id')==$row['user_id']){
					
						//then edit permission action
						if($row['post_status']=='trash'){
							$msg = 'post trash';
						}else{
						 $permission ='ok';
						 }
						 
					}
					
					else{	
						if(!user_can('edit_all_post')){
						$msg = 'You can not edit another post';
						}
					}
				}
				if(user_can('edit_all_post')){
				
					//permission true
					 $permission ='ok';
					 
				}
				if(!user_can('edit_own_post') and user_can('edit_all_post')){//again check the role
				
					$row = mysqli_fetch_array($query);
					
					$user_id = loginuserinfo('id');
					
					if($row['user_id']==$user_id){
						$permission ='false';
						borno_die('You can not even edit your own article');
					}else{
						$permission = 'ok';
					}
				
				
				
				}
				
			}
			else{
				$msg = 'No article found';
			}	
	}
	
		if( user_can('edit_own_post') or user_can('edit_all_post')){//check the role
			$abc = true;
		}
		else{
			$abc = false;
		}
		
	if(	$abc == false and isset($_GET['edit_id'])){
	
		borno_die('you can not edit any article');//it's mean you can't edit any content 
	
	}
	##########STEP 2
	if($permission=='ok' and isset($row)){
	
		// get permission to edit this docoment
		//echo 'permission granted';
		//new editable variable
		$edited_id=$row['id'];
		$edited_title=($row['title']);
		$edited_content=htmlspecialchars($row['content']);
		$edited_status=$row['post_status'];		
		$edited_level=$row['post_level'];		
		$edited_password=$row['post_password'];		
		$edited_comment=$row['comment_permission'];		
		$edited_key=$row['active_key'];	
		$p_id = $row['id'];
		$hidden_value='';	
		
		///get the category
		$query = borno_query("SELECT * FROM $prefix_cm WHERE post_id='$p_id'");
		$count =  mysqli_num_rows($query);
		if($count==0){
			$t_cat=1;
		}
		else{
			$row= mysqli_fetch_array($query);
			$t_cat=$row['cat_id'];
		}
			
		
		///submit key
		 $submit_key='update';

	}
	if( isset ($msg)){
		borno_die($msg);
	
	}

}


##############add new post or edit
///////////// add new post
/////////////add a new post

if(user_can('new_post') or $permission='ok'){
if(isset($_POST['submit'])){



	//check the input
	if(!isset($_POST['title'])){borno_die('Something is going wrong');}
	if(!isset($_POST['content'])){borno_die('Something is going wrong');}
	if(!isset($_POST['privacy'])){borno_die('Something is going wrong');}
	if(!isset($_POST['comment'])){borno_die('Something is going wrong');}
	if(!isset($_POST['post_stats'])){borno_die('Something is going wrong');}
	if(!isset($_POST['password'])){borno_die('Something is going wrong');}
	if(!isset($_POST['password'])){borno_die('Something is going wrong');}
	
	//trim the title && content
	$trim_title = trim($_POST['title']);
	$trim_content = trim($_POST['content']);

		
	if(empty($trim_title) or empty($trim_content))
	{
	
			echo  '<div class="alert alert-block alert-warning fade in sinnup-warning">
            <strong>Error. Fill the form correctly.</strong></div>';
			borno_die('You can\'t submit a blank query');
	}
	else{
		$user_id =  loginuserinfo('id');//user id
		$title = ($_POST['title']);//title
		$content = $_POST['content'];//content
		$level = $_POST['privacy'];//public or private
		$comment_permission = $_POST['comment'];// true or flase
		$post_status =$_POST['post_stats'];// publish or private or pending
		$password= htmlentities($_POST['password']);//if post have passsword
		$user_agent = $browser_info = $_SERVER['HTTP_USER_AGENT'];//browser info
		$ip = $user_ip = $_SERVER['REMOTE_ADDR'];// ip
		$edited = 'false';// never edited
		if(isset($_POST['thecat'])){
			$the_cat=$_POST['thecat'];
		}
		else{
			$the_cat=1;
		}
	
	// pending system
if(get_the_option('pendingpost')=='true' ){
	if(user_can('approved_post')){
		if($_POST['post_stats']=='publish'){
			$post_status= 'publish';
		}
		else if($_POST['post_stats']=='pending'){
			$post_status= 'pending';	
		}
		else{
			$post_status= 'draft';
		}
	}
	if(!user_can('approved_post')){
		if($_POST['post_stats']=='pending'){
			$post_status= 'pending';
		}
		else{
			$post_status= 'draft';
		}
	}
	
}
if(get_the_option('pendingpost')=='false'){
		if(user_can('approved_post')){
		if($_POST['post_stats']=='publish'){
			$post_status= 'publish';
		}
		else if($_POST['post_stats']=='pending'){
			$post_status= 'pending';	
		}
		else{
			$post_status= 'draft';
		}
	}
	if(!user_can('approved_post')){
		if($_POST['post_stats']=='publish'){
			$post_status= 'publish';
		}
		else{
			$post_status= 'draft';
		}
	}
}

//pending system end

		
		//other
		//$pending= 'false';
	$cpermalink = isset($_POST['cpermalink']) ? $_POST['cpermalink'] : '' ;
	if(user_can('new_post')){

	$add_new = add_new_post($user_id ,$title , $content,$post_status,$level,$password,$comment_permission ,$browser_info, $ip,$edited,$the_cat,$cpermalink);
	
	}
	
	if($add_new){
	$go_id  = $add_new;
	}
	update_metas($go_id);
;
		if(get_the_post($go_id , 'post_status')=='publish'){
		//	borno_die("Content successfully publish <a href='" . the_post_link($go_id,false)."'>View</a>" ,'Done');
			header("Location:".admin_url()."/?pages=editor&edit_id={$go_id}&msg=nw");
							
		}else{
			borno_die('Progressing','The post is Progressed');
		}
		
		
	}
	
}
	else if(isset($_POST['update'])){
	
	//check the content
	if(!isset($_POST['title'])){borno_die('Something is going wrong');}
	if(!isset($_POST['content'])){borno_die('Something is going wrong');}
	if(!isset($_POST['privacy'])){borno_die('Something is going wrong');}
	if(!isset($_POST['comment'])){borno_die('Something is going wrong');}
	if(!isset($_POST['post_stats'])){borno_die('Something is going wrong');}
	if(!isset($_POST['password'])){borno_die('Something is going wrong');}
	if(!isset($_POST['password'])){borno_die('Something is going wrong');}
	
	
		$trim_title = trim($_POST['title']);
		$trim_content = trim($_POST['content']);
		
		
		if(empty($trim_title) or empty($trim_content))
			{
				echo  '<div class="alert alert-block alert-danger fade in sinnup-warning">
				<strong>Please fill with content</strong></div>';
				borno_die('You can\'t submit a blank query');
			}
		else{
		
			
	// pending system
if(get_the_option('pendingpost')=='true' ){
	if(user_can('approved_post')){
		if($_POST['post_stats']=='publish'){
			$post_status= 'publish';
		}
		else if($_POST['post_stats']=='pending'){
			$post_status= 'pending';	
		}
		else{
			$post_status= 'draft';
		}
	}
	if(!user_can('approved_post')){
		if($_POST['post_stats']=='pending'){
			$post_status= 'pending';
		}
		else{
			$post_status= 'draft';
		}
	}
	
}
if(get_the_option('pendingpost')=='false'){
		if(user_can('approved_post')){
		if($_POST['post_stats']=='publish'){
			$post_status= 'publish';
		}
		else if($_POST['post_stats']=='pending'){
			$post_status= 'pending';	
		}
		else{
			$post_status= 'draft';
		}
	}
	if(!user_can('approved_post')){
		if($_POST['post_stats']=='publish'){
			$post_status= 'publish';
		}
		else{
			$post_status= 'draft';
		}
	}
}

//pending system end



		//check the update
			if(isset($_POST['active_key']) and isset($_POST['edited_id'])){
				$get_active_key = $_POST['active_key'];
				$get_post_id = $_POST['edited_id'];
					 if(filter_var($get_post_id, FILTER_VALIDATE_INT))
					{
						$query = borno_query("SELECT * FROM $prefix_contents WHERE id='$get_post_id' and active_key='".mysqli_escape($get_active_key)."'");
						$count = mysqli_num_rows($query);
						if($count==1){
							//echo 'done';
							$row = mysqli_fetch_array($query);
							// info from include db
								$post_id = $row['id'];
								$title = $row['title'];
								$content = $row['content'];

							//new info
								$newtitle = $_POST['title'];
								$newcontent = $_POST['content'];
								$post_status = $_POST['post_stats'];
								$level = $_POST['privacy'];
								$password = htmlentities($_POST['password']);
								$comment_permission = $_POST['comment'];
								$edited ='true';
								/////////////////////////////////
								///////cat_function/////////////
									$cat	= $_POST['thecat'];
								///////////////////////////////////////
								///////////////////////////////////////
							//user id
							$user_id =  loginuserinfo('id');
							
							$cpermalink = isset($_POST['cpermalink']) ? $_POST['cpermalink'] : '' ;

								
								
							///than updatem
							if( user_can('edit_own_post') or user_can('edit_all_post')){
								edit_post($post_id,$title ,$content , $newtitle , $newcontent,$post_status,$level,$password,$comment_permission ,$edited,$user_id,$cat,$cpermalink);
								
								
							}
							//header('Location:index.php');
							
							update_metas($row['id']);
							
							/*echo ( '<div class="alert alert-success">You successfully edited the post 
							<a href="'.the_post_link($row['id'],false).'"  target="_blank" class="btn btn-success" style="background:green;color:white;text-decoration:none;border-radius:5px;padding:2px;">View Post</a>
							</div>');*/
							
							header("Location:".admin_url()."/?pages=editor&edit_id={$row['id']}&msg=edt");
							
						}
						else{
						borno_die( '//error no post in this name//');
						}
					}
					else{
					borno_die( 'Int error .update fail . (2)' );
					}
			}
			
			else{
			borno_die( 'update error (1)' );
			
			}
		
		}	


	}	
	





	$editor_panel = isset($_COOKIE['editor']) ? $_COOKIE['editor'] : 'Tinymce';
	if($editor_panel=="Ckeditor"){
			?>
			
			  <script src="<?php echo get_the_option('site_address'); ?>/assets/ckeditor/ckeditor.js"></script>

			<?php 
	}
	
	else{
	
	
	
?>




<script src="<?php echo get_the_option('site_address'); ?>/assets/tinymce/tinymce.min.js"></script>

<script>
tinymce.init({
    selector: "textarea#content",
    theme: "modern",
		  skin: 'light',

  //  width: 300,
    height: 350,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak media",
        // "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking",
         //"save table contextmenu directionality template paste textcolor"
         "save contextmenu directionality template paste textcolor"
   ],
      relative_urls : false,
    convert_urls : false,
   content_css: "css/content.css",
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor" ,
 /*style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
       // {title: 'Table styles'},
     //   {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ]*/
 }); tinymce.init({
    autosave_interval: "3s"
});
</script>
<?php  } ?>

<script type="text/javascript">

  var popit = true;
     window.onbeforeunload = function() { 
      if(popit == true) {
           popit = true;
           return "Are you sure you want to leave?"; 
      }
 }
 
 function unhook() {
        popit=false;
      }
function validate_title(field,alerttxt)
{
with (field)
{
apos=value.length;

if (apos<4 || 350<apos) 
  {alert(alerttxt);return false;}
else {}
}
}

/*
function validate_content(field,alerttxt)
{
with (field)
{
apos=value.length;

if (apos<25) 
  {alert(alerttxt);return false;}
else {}
}
}
*/

function validate_content(){
 var myTextField = document.getElementById('content');
 var apos=myTextField.value.length;

	if (apos<25) 
	  {alert('You must write minimam digit of content');myTextField.focus();return false;}
	else {}
 

}
//////////////////////////////////////
function validate_form(thisform)
{
with (thisform)
{


  if (validate_title(title,"Use maximum or minimum digit of title!")==false)
  {title.focus();return false;}
   /*if (validate_content(content,"You must write minimum 25 letter airticle!")==false)
  {content.focus();return false;}
*/

}
}
</script>
<?Php 	
	if( user_can('edit_own_post') or user_can('edit_all_post')){
			$abc = true;
		}
		else{
			$abc = false;
		}

		if($submit_key=='update' and $abc == false){
			borno_die('You can not update your own post !');
		}
		if($submit_key=='submit' and !user_can('new_post')){
			borno_die('You can not add a new post');
		}
		
		if(isset($_GET['msg']) && $edited_id!=0){
			if($_GET['msg']=='edt'){
					echo ( '<div class="alert alert-success">You successfully edited the post 
							<a href="'.the_post_link($edited_id,false).'"  target="_blank" class="btn btn-success" style="background:green;color:white;text-decoration:none;border-radius:5px;padding:2px;">View Post</a>
							</div>');
				}
			if($_GET['msg']=='nw'){
					echo ( '<div class="alert alert-success">You successfully added the post 
							<a href="'.the_post_link($edited_id,false).'"  target="_blank" class="btn btn-success" style="background:green;color:white;text-decoration:none;border-radius:5px;padding:2px;">View Post</a>
							</div>');
				}
			
		
		}
?>

<form method="POST" action="" onsubmit="return validate_form(this);">
<!-- place in body of your html document -->
<label for="editortitle">Title :</label>
<input type="text" id="editortitle"  value="<?php if(isset($_POST['title'])){echo htmlspecialchars($_POST['title']);}else{echo $edited_title;} ?>" class=" etitle" id="title " name="title" placeholder="Your Title"/>
<br>
<label for="content">Content :</label>

<textarea id="content" name="content"><?php if(isset($_POST['content'])){echo htmlspecialchars($_POST['content']);}else{echo $edited_content;}?></textarea><br>
<hr>

<?php
if($editor_panel=="Ckeditor"){ ?>
      <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'content' );
            </script>
			
			<?php } ?>
<?php
include('img.php');
?>
<table class="table table-striped table-bordered">
    
              <tbody>
                <tr>
                  <td>Privacy</td>
                  <td><select name="privacy" class="form-control">
				  <?php 
				  if (isset($_POST['privacy'])){
					$edited_level = $_POST['privacy'];
				  }
				   if (isset($_POST['comment'])){
					$edited_comment = $_POST['comment'];
				  }
				    if (isset($_POST['post_stats'])){
					$edited_status = $_POST['post_stats'];
				  }  if (isset($_POST['password'])){
					$edited_password = $_POST['password'];
				  }
				  
				  ?>
<option  value="public" <?php if ($edited_level=='public') {echo "selected='selected'";}?>>Public</option>
<option  value="loginuser" <?php if ($edited_level=='loginuser') {echo "selected='selected'";}?>>Members</option>
<option value="private" <?php if ($edited_level=='private') {echo "selected='selected'";}?>>Only Me</option>
</select></td>
                </tr>
                <tr>
                  <td>Comment </td>
                  <td><select name="comment" class="form-control">
<option  value="true" <?php if ($edited_comment=='true') {echo "selected='selected'";}?>>User can comment</option>
<option value="false" <?php if ($edited_comment=='false') {echo "selected='selected'";}?>>User can't comment</option>
</select></td>
                </tr>
   <tr>
                  <td>Type  <?Php //echo $edited_status;?></td>
                  <td><select name="post_stats" class="form-control">
				 
<?php if(get_the_option('pendingpost')=='true' and (user_can('approved_post'))){?>
<option  value="publish" <?php if ($edited_status=='publish') {echo "selected='selected'";}?>>Publish</option>
<?php } //edited_status?> 
<?php if( !user_can('approved_post') && get_the_option('pendingpost')=='true' && $edited_status=='publish' ){?>
<option  value="publish" <?php if ($edited_status=='publish') {echo "selected='selected'";}?>>Publish</option>
<?php } ?>
<?php if(get_the_option('pendingpost')=='false'){ ?>
<option  value="publish" <?php if ($edited_status=='publish') {echo "selected='selected'";}?>>Publish</option>
<?php } ?>
<?php if(get_the_option('pendingpost')=='true' or user_can('approved_post')){?>
				  
<option  value="pending" <?php if ($edited_status=='pending') {echo "selected='selected'";}?>>Pending</option>
<?php } ?>
<?php if(get_the_option('pendingpost')=='false' && !user_can('approved_post') && $edited_status=='pending'){?>
<option  value="pending" <?php if ($edited_status=='pending') {echo "selected='selected'";}?>>Pending</option>

<?php } ?>
<option value="draft" <?php if ($edited_status=='draft') {echo "selected='selected'";}?>>Draft</option>
</select></td>
                </tr>				
              
				

				<tr>
                  <td>Select Your category</td>
                  <td>
						<select name="thecat"  class="form-control">
							<?php
							$query = borno_query("SELECT * FROM $prefix_cat");
							$count = mysqli_num_rows($query);
							if($count==0){
								?><option value="1" >Uncategory</option><?php
							
							}
							else{
							while($row=mysqli_fetch_array($query)){?>
							<?php if(isset($_POST['thecat'])){?>
								<option value="<?php echo $row['id'] ;?>" <?php if ($_POST['thecat']==$row['id']) {echo "selected='selected'";}?>><?php echo $row['name'] ;?></option>
							<?php } else{ ?>
							<option value="<?php echo $row['id'] ;?>" <?php if ($t_cat==$row['id']) {echo "selected='selected'";}?>><?php echo $row['name'] ;?></option>
							<?php
							
							}
							
							?>
							<?php }
								}?>
						</select>
				  </td>
                </tr>
				
				  <tr>
                  <td>Post Password <!--(if you want keep protect the post)--></td>
                  <td> <input type="text" class="" value="<?php
				  if(isset($_POST['password'])){
				  echo htmlentities($_POST['password']);}
				  else{echo $edited_password;}?>" name="password"/>
				</td>
                </tr>
				
				
				<tr>
				  
                  <td>Slug</td>
                  <td> <input type="text" class="" value="<?php echo content_permalink($edited_id);  ?>" name="cpermalink"/>
				</td>
                </tr>
				
				
				
				<?php view_optional_input($edited_id) ; ?>

				</tbody>
            </table>








<input type="submit" name="<?php echo $submit_key;?>" class="btn btn-default btn-medium" value="Submit" onClick="unhook()"/>
<input type="hidden" name="active_key" class="hide  hidden" value="<?php echo $edited_key;?>" />
<input type="hidden" name="edited_id" class="hide  hidden" value="<?php echo $edited_id;?>" />

<?php 
if($submit_key=='update'){
	if(user_can('trash_all_post')){
	
		echo '<a href="#deletethis" role="button" class="btn btn-danger" data-toggle="modal">Trash</a>';
				?>
 
<!-- Modal -->

		<?php
	}
	else if(user_can('trash_own_post')){
		
		echo '<a href="#deletethis" role="button" class="btn btn-danger" data-toggle="modal">Trash</a>';

	}
	
	?>
	
	
	
	
	
	
	
	
	
	
	

	<!-- TRASH MSG-->


 <div class="panel-body">
	
	
	<div class="modal fade" id="deletethis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Are you sure about trashing this content?</h4>
				</div>
				<div class="modal-body">

<h3 id="myModalLabel">By trashing this, you might not be able to recover it.</h3>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<?php echo '<a href="trash.php?trashtype=post&id='.$edited_id.'" class="btn btn-danger">Delete this </a>';//trash link ?>
				</div>
			</div>
		</div>
	</div>
 </div>













	
	<?php

}

?>
<!--<input type="submit" class="btn btn-danger btn-medium" value="Delete" />
--></form>
<?php

}
else{
die();
}

}