<?php
	/*
	 *	This is the custom php css file for admin panel
	 *
	 *
	 *
	 *
	 *
	 *
	 */
header('Content-type:text/css');
include('../../../../functions.php');
?>

@font-face {
  font-family: 'open-san';
  font-style: normal;
  font-weight: 400;
  src: local('open-san'), local('open-san'), url(<?php echo admin_url() ?>/theme/sb_admin/fonts/open-san.woff) format('woff');
}



body , input , textarea{
  font-family: 'open-san',Siyam Rupali;

}
.containermenu{
	max-width:960px;
	margin:0 auto ;
}
.homeheadmargin{

}
.admin_top_menu{
	margin-bottom:5px;

}

ul li{
	list-style:none;
}
	
	
	
.idcardavatar {
     background:  white ;
	 border: 1px solid #cccccc;
     height: 90px;
     padding: 5px;
     width: 90px;
}

#page-wrapper{
	min-height:100vh;
	
}


/* custom color scheme */

<?php if ( isset($_COOKIE['admin_theme'])){ 

$panel_theme = $_COOKIE['admin_theme'];

if($panel_theme=='warm'){

echo "
.navbar-cls-top .navbar-brand{
	background:#DC3D24;
}
.navbar-cls-top .navbar-brand:hover{
	background:#DC3D24;
}
.navbar-cls-top .navbar-brand:focus{
	background:#DC3D24;
}
#wrapper{
	background:#DC3D24;
}
.navbar , .navbar-side , .navbar-side li {
	background:#DC3D24;
}

.sidebar-collapse .nav > li > a {
     background: none repeat scroll 0% 0% #DC3D24;
}
.sidebar-collapse .nav > li > a:hover{
     background: none repeat scroll 0% 0% #C90000;
}
.sidebar-collapse .nav > li > a:focus{
     background: none repeat scroll 0% 0% #C90000;
}


a{
	color : #DC3D24;
}
a:hover{
	color:#C90000;
	text-decoration:none;
}

a:focus{
	color:#C90000;
	text-decoration:none;
}
"; }



else if( $panel_theme == 'cold') {
echo "


.navbar-cls-top .navbar-brand{
	background:#009B95;
	}
.navbar-cls-top .navbar-brand:hover{
	background:#009B95;
}
.navbar-cls-top .navbar-brand:focus{
	background:#009B95;
}

#wrapper{
	background:#009B95;
}
.navbar , .navbar-side , .navbar-side li {
	background:#009B95;
}

.sidebar-collapse .nav > li > a {
     background: none repeat scroll 0% 0% #009B95;
}
.sidebar-collapse .nav > li > a:hover{
     background: none repeat scroll 0% 0% #1D7471;
}
.sidebar-collapse .nav > li > a:focus{
     background: none repeat scroll 0% 0% #1D7471;
}


a{
	color:#009999;
}
a:hover{
	color:#006363;
	text-decoration:none;
}

a:focus{
	color:#006363;
	text-decoration:none;
}
"; }


else if($panel_theme == 'tree'){


echo "
.navbar-cls-top .navbar-brand{
	background:#34D800;
	}
.navbar-cls-top .navbar-brand:hover{
	background:#34D800;
}
.navbar-cls-top .navbar-brand:focus{
	background:#34D800;
}

#wrapper{
	background:#34D800;
}
.navbar , .navbar-side , .navbar-side li {
	background:#34D800;
}

.sidebar-collapse .nav > li > a {
     background: none repeat scroll 0% 0% #34D800;
}
.sidebar-collapse .nav > li > a:hover{
     background: none repeat scroll 0% 0% #228D00;
}
.sidebar-collapse .nav > li > a:focus{
     background: none repeat scroll 0% 0% #228D00;
}


a{
	color:#34D800;
}
a:hover{
	color:#228D00;
	text-decoration:none;
}

a:focus{
	color:#228D00;
	text-decoration:none;
}


";}




else if($panel_theme =='w3'){

echo "
.navbar-cls-top .navbar-brand{
	background:#7309AA;
	}
.navbar-cls-top .navbar-brand:hover{
	background:#7309AA;
}
.navbar-cls-top .navbar-brand:focus{
	background:#7309AA;
}

#wrapper{
	background:#7309AA;
}
.navbar , .navbar-side , .navbar-side li {
	background:#7309AA;
}

.sidebar-collapse .nav > li > a {
     background: none repeat scroll 0% 0% #7309AA;
}
.sidebar-collapse .nav > li > a:hover{
     background: none repeat scroll 0% 0% #612580;
}
.sidebar-collapse .nav > li > a:focus{
     background: none repeat scroll 0% 0% #612580;
}


a{
	color:black;
	font-weight:bold;
}
a:hover{
	color:#4A036F;
	text-decoration:none;
}

a:focus{
	color:#4A036F;
	text-decoration:none;
}

"; }



else if($panel_theme == 'w4' ){

echo "


.navbar-cls-top .navbar-brand{
	background:#FF8E00;
	}
.navbar-cls-top .navbar-brand:hover{
	background:#FF8E00;
}
.navbar-cls-top .navbar-brand:focus{
	background:#FF8E00;
}

#wrapper{
	background:#FF8E00;
}
.navbar , .navbar-side , .navbar-side li {
	background:#FF8E00;
}

.sidebar-collapse .nav > li > a {
     background: none repeat scroll 0% 0% #FF8E00;
}
.sidebar-collapse .nav > li > a:hover{
     background: none repeat scroll 0% 0% #A65C00;
}
.sidebar-collapse .nav > li > a:focus{
     background: none repeat scroll 0% 0% #A65C00;
}


a{
	color:#FF8E00;
	font-weight:bold;
}
a:hover{
	color:#A65C00;
	text-decoration:none;
}

a:focus{
	color:#A65C00;
	text-decoration:none;
}
";

} 
else if( $panel_theme =='jerry'){

echo "



.navbar-cls-top .navbar-brand{
	background:#111;
	}
.navbar-cls-top .navbar-brand:hover{
	background:#111;
}
.navbar-cls-top .navbar-brand:focus{
	background:#111;
}



#wrapper{
	background:#658dbb;
}
.navbar , .navbar-side , .navbar-side li {
	background:#111;
}

.sidebar-collapse .nav > li > a {
     background: none repeat scroll 0% 0% #658dbb;
}
.sidebar-collapse .nav > li > a:hover{
     background: none repeat scroll 0% 0% #3B8DBD;
}
.sidebar-collapse .nav > li > a:focus{
     background: none repeat scroll 0% 0% #3B8DBD;
}


a{
	color:#658dbb;
}
a:hover{
	color:#3B8DBD;
	text-decoration:none;
}

a:focus{
	color:#3B8DBD;
	text-decoration:none;
}
";

}
else if( $panel_theme =='midnight'){

echo "



.navbar-cls-top .navbar-brand{
	background:#111;
	}
.navbar-cls-top .navbar-brand:hover{
	background:#111;
}
.navbar-cls-top .navbar-brand:focus{
	background:#111;
}



#wrapper{
	background:#111;
}
.navbar , .navbar-side , .navbar-side li {
	background:#111;
}

.sidebar-collapse .nav > li > a {
     background: none repeat scroll 0% 0% #111;
}
.sidebar-collapse .nav > li > a:hover{
     background: none repeat scroll 0% 0% #D2322D;
}
.sidebar-collapse .nav > li > a:focus{
     background: none repeat scroll 0% 0% #D2322D;
}


a{
	color:#658dbb;
}
a:hover{
	color:#3B8DBD;
	text-decoration:none;
}

a:focus{
	color:#3B8DBD;
	text-decoration:none;
}
";

}

}


if ( isset($_COOKIE['headerenable'])){ 

$header = $_COOKIE['headerenable'];

	if($header == 2) {
		echo ".navbar-cls-top {display:none}";
	
	}

}

?>
