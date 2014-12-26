<?php
/*
*	New Doc page
*
*/
	//adding new doc.
	//only admin can access this
	if(!user_can('manage_doc')){
		die('You can not access this page');
	}

/*
*	Doc element
*/
$doc_id='';
$doc_title='';
$doc_content='';
$doc_status='';
$doc_user='';
$doc_key='';	
$doc_submit='submit';	
$permission = "";

/*
*	Check role
*/
if(user_can('manage_doc')){ 
	if(isset($_GET['editdoc'])){
	
		$permission = "";
		$edit_id = $_GET['editdoc'] ;
		 if(!filter_var($edit_id, FILTER_VALIDATE_INT)){
			borno_die('Invalid post id');
		 }
		 else{
		 
			$query = borno_query("SELECT * FROM $prefix_doc WHERE id='$edit_id'");
			
			$count = mysqli_num_rows($query);
			if($count=='1'){
				$row = mysqli_fetch_array($query);
				$permission = 'ok';
			}
			else{
				borno_die( 'No doc found in this id ');
			}
		 
		 }
		 
	 
	}
if($permission=='ok'){
/*
*	if edit doc content , than add edit info
*/
$doc_id=$row['id'];
$doc_title=$row['title'];
$doc_content=$row['content'];
$doc_status=$row['doc_status'];
$doc_user=$row['user_id'];
$doc_key=$row['active_key'];	
$doc_submit='update';	

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
    selector: "textarea#doceditor",
    theme: "modern",
	  skin: 'light',
  //  width: 300,
    height: 350,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars  fullscreen insertdatetime media nonbreaking",
         //"save table contextmenu directionality template paste textcolor"
         "save contextmenu directionality template paste textcolor"
   ],
    relative_urls : false,
    convert_urls : false,
   content_css: "css/content.css",
   toolbar: "insertfile undo redo | styleselect | bold italic underline| alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview  fullpage | forecolor backcolor" ,
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

<?php  } 


	#doc php
	
	if(isset($_POST['submit'])){
	
	
		if(isset($_POST['docname']) && isset($_POST['doc_content']) && isset($_POST['doc_status'])){

				$title = $docname= htmlspecialchars($_POST['docname']);
				$doc_content =$doccontent =$_POST['doc_content'];
				$post_status = $docstatus = htmlspecialchars($_POST['doc_status']);
				$user = loginuserinfo('id');
			//funtions add_doc	
			
									$dpermalink = isset($_POST['dpermalink']) ? $_POST['dpermalink'] : '';

			add_doc($title,$doc_content,$user,$post_status,$dpermalink);
			header('Location:?pages=managedoc&msg=newdoc');
		}
		else{
			borno_die( 'You can not do this' );
	
	
		}		
	
	}
	if(isset($_POST['update'])){
		if(!isset($_POST['doc_id'])){borno_die('Something is going wrong');}
		if(!isset($_POST['active_key'])){borno_die('Something is going wrong');}
		if(!isset($_POST['doc_status'])){borno_die('Something is going wrong');}
		if(!isset($_POST['docname'])){borno_die('Something is going wrong');}
		if(!isset($_POST['doc_content'])){borno_die('Something is going wrong');}
			if(filter_var($_POST['doc_id'], FILTER_VALIDATE_INT)){
				$get_doc_id=	$_POST['doc_id'];
				$get_active_key = $_POST['active_key'];
			$query = borno_query("SELECT * FROM $prefix_doc WHERE id='$get_doc_id' and active_key='".mysqli_escape($get_active_key)."'");
						$count = mysqli_num_rows($query);
						if($count==1){
						$edited = 'true';
						$user_id = loginuserinfo('id');
						
						$dpermalink = isset($_POST['dpermalink']) ? $_POST['dpermalink'] : '';
						
						edit_doc($get_doc_id,$doc_title ,$doc_content , $_POST['docname'] , $_POST['doc_content'],$_POST['doc_status'],$edited,$user_id,$dpermalink);

						echo '<div class="alert alert-success">You successfully edited the Doc ||
							<a href="'.doc_link($row['id']).'"  target="_blank">View Post</a>
							</div>';
							
							
						}
						else{
						echo 'You can not do this';
						}
			}
			else{
				echo 'invalid post id';
			}			
		
	}


?>
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

if (apos<3 || 350<apos) 
  {alert(alerttxt);return false;}
else {}
}
}
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

function validate_form(thisform)
{
with (thisform)
{


  if (validate_title(docname,"Use maximum or minimum digit of title!")==false)
  {docname.focus();return false;}
   if (validate_content(doc_content,"You must write minimum 25 letter airticle!")==false)
  {doc_content.focus();return false;}


}
}
</script>
<form id="" method="post" action="" onsubmit="return validate_form(this);">

	<input type="text"  class="etitle" name="docname" value="<?php if(isset($_POST['docname'])){echo htmlspecialchars($_POST['docname']);}else{echo $doc_title;}?>" placeholder="Document Name Here" /><br>
	<textarea id="doceditor" name="doc_content">
	<?php if(isset($_POST['doc_content'])){echo $_POST['doc_content'];}else{echo $doc_content;}?>
	</textarea>
	
<?php
if($editor_panel=="Ckeditor"){ ?>
      <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'doceditor' );
            </script>
			
			<?php } ?>
	<br>
	
<?php
include('img.php');
?>
	<br>
	<table class="table  table-bordered">
		<tbody>
			<tr>
				<td>Status</td>
				<td>	<select name="doc_status"  class="form-control">
				<?php 
					if(isset($_POST['doc_status'])){
						$doc_status = $_POST['doc_status'];
					}
				?>
						<option  value="publish" <?php  if ($doc_status=='publish') {echo "selected='selected'";}?>>Publish</option>
						<option value="draft" <?php if ($doc_status=='draft') {echo "selected='selected'";}?>>Draft</option>
						</select>
				</td>
			</tr>
			
			<tr>
				<td>Slug</td>
				<td> <input type="text" class="" value="<?php echo doc_permalink($doc_id);  ?>" name="dpermalink"/>
				</td>
			</tr>

		</tbody>
	</table>

	<input class="btn btn-success" type="submit" name="<?php echo $doc_submit; ?>" value="Submit" onClick="unhook()" />
	<input type="hidden" name="active_key" class="hide  hidden" value="<?php echo $doc_key;?>" />
<input type="hidden" name="doc_id" class="hide  hidden" value="<?php echo $doc_id;?>" />
</form>

<?php 
if($doc_submit=='update'){
?><script type="text/javascript">
function validate_del(field,alerttxt)
{
with (field)
{

	var answer=confirm(alerttxt);
	if(answer){
	}
	else{
  return false;}
  }
}

//password match end

function validate_form(thisform)
{
with (thisform)
{
   if (validate_del(e,"Are you sure? You Sure to delete this doc ?")==false)
  {e.focus();return false;}

}
}
</script>
<form method="POST"  action="del.php?type=doc&id=<?php echo $doc_id ;?>" onsubmit="return validate_form(this)">
<input type="submit" name="e" class="btn btn-danger btn-mini" value="Delete"/>
</form>

<?php

}
 }
 else{
 borno_die('Access denied');
 }
