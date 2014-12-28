<?php 
/*
*	Rss Feed
*	You can displaying RSS feed by this page
*/

include('functions.php');
include('include/function/feed_class.php');


$sSQL = borno_query("SELECT * FROM prefix_content Where post_status='publish' and post_level ='public' ORDER BY `id` DESC  LIMIT 0 , 10");




$rss_channel = new rssGenerator_channel();
$rss_channel->atomLinkHref = '';
$rss_channel->title = get_the_option('site_name');;
$rss_channel->link = get_the_option('site_address');;
$rss_channel->description =  get_the_option('site_description');;
$rss_channel->language = 'en-us';
$rss_channel->generator = 'PHP RSS Feed Generator';


$item = array();

while($row = mysqli_fetch_array($sSQL)){

	$item = new rssGenerator_item();
	$item->title = $row['title'];
	$item->description = ' '.str_replace('&nbsp;','',the_excerpt($row['content'],50)).' ';
	$item->link = the_post_link($row['id'],false);
	$item->guid = the_post_link($row['id'],false);
	$item->pubDate = $row['times'];
	$rss_channel->items[] = $item;

	
}



$rss_feed = new rssGenerator_rss();
$rss_feed->encoding = 'UTF-8';
$rss_feed->version = '3.0';
header('Content-Type: text/xml');
echo $rss_feed->createFeed($rss_channel);

?>
