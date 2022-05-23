<?php 

/**
 * RSS FEED (XML)
 *
 * INHERITED VARIABLES:
 * - $url (array), $page (index), $permalink (empty) 
 * - $dark_mode (dark-mode-off), $zoom (1) 
 * - and constans: BASE_URL, BASE_DIR, etc.  
 *
 * PHP Version 5
 *
 * @category PHP
 * @author   CsAB
 * @license  MIT
 */

// load model
include_once(BASE_DIR.MODEL_DIR.'post_model.php');

// load all posts by DESC order
$allPostData = readAllPosts(true); 

header('Content-Type: text/xml; charset=UTF-8');

$render["page"] = array();
$render["page"]["namespace"] = "";
$render["page"]["slug"] = "rss";
$render["page"]["permalink"] = $permalink;

$render["page"]["title"] = txt('txt_posts')." - RSS";
$render["page"]["desc"] = txt('txt_rss_desc', BLOG_NAME);
$render["page"]["keywords"] = "blog,".txt('txt_posts').",".txt('txt_articles');
$render["page"]["created"] = "";
$render["page"]["markdown"] = "";
$render["page"]["content"] = "";

include_once(BASE_DIR.TEMPLATE_DIR.'rss.tpl');
exit;

?>