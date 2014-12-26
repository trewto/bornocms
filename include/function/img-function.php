<?php
/*
*
*	add image record to the database
*
*/
function add_img_record($img,$user_id){
	
		borno_query("CREATE TABLE IF NOT EXISTS  $img_table (
  `id` int(90) NOT NULL AUTO_INCREMENT,
  `img` text CHARACTER SET utf8 NOT NULL,
  `user_id` int(90) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

borno_query("INSERT INTO prefix_photo (`id`, `img`, `user_id`, `time`) VALUES (NULL, '$img', '$user_id', CURRENT_TIMESTAMP); ");
	
}

if(user_can("upload_image")){
	add_page('img_gal','Gallery' , 'img_gal','manage_site');
}
function img_gal(){
	include('img.php');
}