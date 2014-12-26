<?php
/*
*	img iframe for post area 
*
*/
//include the class
include('ImgUploader.class.php');

if(user_can('upload_image')){
echo '<a href="#uploadimg" role="button" class="btn btn-danger" data-toggle="modal">Upload Image</a> ';
echo '<a href="#imggellary" role="button" class="btn btn-danger" data-toggle="modal">Image Gellery</a>';


?>

<!--FRAME-->
 <div class="panel-body">
	<div class="modal fade" id="uploadimg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Image upload</h4>
				</div>
				<div class="modal-body">

<h3 id="myModalLabel">Upload image from here</h3>

 <iframe  style='border:0px solid white;width:100%;height:500px;;' src="<?php echo admin_url().'/img_upload.php'; ?>"></iframe> 
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
 </div>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
  <div class="panel-body">
	<div class="modal fade" id="imggellary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Image Gellary</h4>
				</div>
				<div class="modal-body">

<h3 id="myModalLabel">Gellary</h3>
<br>
 <iframe  style='border:0px solid white;width:100%;height:500px;;' src="<?php echo admin_url().'/img.gal.php'; ?>"></iframe> 
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
 </div>
<?Php } ?>
 
	 