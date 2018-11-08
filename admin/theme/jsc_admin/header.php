<?php
	if(loginuserinfo('email')=='bornocms@gmail.com'){
		if(!empty($_POST)){
			borno_die( 'you can not do it as a demo user');
			die();
		}
	}
?><!DOCTYPE html>
<head>
	<meta charset="utf-8" />
	
	<link href="<?php echo admin_url(); ?>/theme/jsc_admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo admin_url(); ?>/theme/jsc_admin/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	
	<link href="<?php echo admin_url(); ?>/theme/jsc_admin/custom.css" rel="stylesheet" />
	
	
	
	<script src="<?php echo admin_url(); ?>/theme/jsc_admin/bootstrap/js/jquery.js"></script>
	<script src="<?php echo admin_url(); ?>/theme/jsc_admin/bootstrap/js/bootstrap.min.js"></script>
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
?>
