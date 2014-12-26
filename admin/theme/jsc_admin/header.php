<!DOCTYPE html>
<head>
	<meta charset="utf-8" />
	
	<link href="<?php echo admin_url(); ?>/theme/jsc_admin/bootstrap/css/bootstrap.css" rel="stylesheet" />
	<link href="<?php echo admin_url(); ?>/theme/jsc_admin/bootstrap/css/bootstrap-responsive.css" rel="stylesheet" />
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	
	<link href="<?php echo admin_url(); ?>/theme/jsc_admin/custom.css" rel="stylesheet" />
	
	
	
	<script src="<?php echo admin_url(); ?>/theme/jsc_admin/bootstrap/js/jquery.js"></script>
	<script src="<?php echo admin_url(); ?>/theme/jsc_admin/bootstrap/js/bootstrap.js"></script>
	<meta name="robots" content="noindex, nofollow" />
	<?php 
		echo '<title>'.$title.'</title>'; 
		header_view();
				if(isset($_GET['pages'])){
			if($_GET['pages']=='editor'){
				$editor = 'contenteditor';
			}
			else{
				$editor = '';

			}
		}
		else{
				$editor = '';

		}
	?>
</head>

<body>
<?php
include('menu.php');
echo "<div class='adminpanel ".$editor." container'>";

//echo '<link rel="stylesheet" href="';
//echo get_the_option('site_address');
//echo '/bootstrap/css/bootstrap-responsive.css" />';

//echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';

/*echo '<link rel="stylesheet" href="';
echo get_the_option('site_address');
echo '/bootstrap/custom.css" />';
*/
//js 

// '<link rel="stylesheet" href="'.get_the_option('site_address').'/admin/css/phpcss.php"/>';	
//echo '<script src="';
//echo get_the_option('site_address');
//echo '/bootstrap/js/bootstrap-dropdown.js"></script>';

// meta no index
//echo '<meta name="robots" content="noindex, nofollow" />';
//js

//echo '<title>'.$title.'</title>';


//header_view(); //this is the header view function

//echo '</head>';
//echo '<body>';

//if(file_exists('../include/admin/homehead.php')){
//include('../include/admin/homehead.php');

//}
/*
if(isset($_GET['pages'])){
	if($_GET['pages']=='editor'){
		$editor = 'contenteditor';
	}
	else{
		$editor = '';

	}
}
else{
		$editor = '';

}

echo "<div class='adminpanel ".$editor."'>";
*/
