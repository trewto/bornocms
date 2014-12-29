<?php
/*
	Plugin Name : SEO PACK <1.0>
	Author:Trewto Roy
	detail : Meta , Google analytic
*/

add_page('sub_seo','Seo Pack' , 'ss_seo_function','manage_site');

/*
*	Seo page on admin panel
*
*/
function ss_seo_function(){
	if(count($_POST)){
		echo 'Updated';
	}
	echo '<form action="" method="post">';
	echo '<br>Meta Keyword ( separate by comma )<br>';
	echo _site_option_auto_update_display('meta_key',true,true);	
	echo '<br>Google Analytic Ex: UA-XXXXX-X<br>';
	echo _site_option_auto_update_display('google_analytic',true,true);	

	
	echo ' 
			<br><input type="submit" class="btn btn-submit" name="" value="SUBMIT"/><br>
		</form>';


}


/*
*
*	SEO Description
*
*
*//*
if(!function_exists('is_single')){
	return ;
}
*/
if(!is_admin()){
	
	/*
	*
	*	Set all those title to description
	*
	*/
	if(is_single()){
		$description = post_excerpt($post_id,0,0); 
	}else if(is_doc()){
		$description =	get_the_doc_page($_GET['doc'],'title');
	}else if(is_search){
		$description = search_result_count($_GET['search'])." Result found ";
	}else if(is_profile()){
		$description =the_user_dispay_name($_GET['profile']);
	}else if(is_cat()){
		$description = get_the_cat($_GET['cat'],'name') ;
	}else {
		$description = get_the_option('site_title').' || '.get_the_option('site_description');
	}

	
	/*
	*
	*	data	
	*
	*/

		$data = '<meta name="description" content="'.$title.'">
				<meta name="keywords" content="'.get_the_option('meta_key').'">';

	/*
	*	Add data to header
	*
	*/
	add_header($data) ;
	

}




/*
*
*	Google analytic
*
*/
// Include the Google Analytics Tracking Code (ga.js)
// @ https://developers.google.com/analytics/devguides/collection/gajs/

function google_analytics_tracking_code($propertyID='UA-XXXXX-X'){

return "
		<script type='text/javascript'>
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', '$propertyID']);
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		</script>";

}


$ga = trim(get_the_option('google_analytic'));
if(!empty($ga)){
	add_footer(google_analytics_tracking_code($ga));
}