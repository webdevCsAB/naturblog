<?php 

/**
 * Single Post Page
 *
 * INHERITED VARIABLES:
 * - $url (array), $page (posts), $permalink (posts/...) 
 * - $dark_mode (dark-mode-off), $zoom (1) 
 * - $pageNamespace (posts), $pageSlug (...)
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

$postData = getPostByPermalink($pageSlug, true); 

if(empty($postData)) {
  header("Location:".BASE_URL."error404?emptyContent");
  exit;
}

// if #18+ ==> Adult Content
if(strstr($postData["content"], "#18+")) {
  $adultContent = "&#x1F51E; ";
}

$render["page"] = array();
$render["page"]["namespace"] = $pageNamespace;
$render["page"]["slug"] = $pageSlug;
$render["page"]["permalink"] = $permalink;
$render["page"]["title"] = $postData["title"];
$render["page"]["desc"] = "";
$render["page"]["keywords"] = "";
$render["page"]["created"] = $postData["created"];
$render["page"]["markdown"] = $postData["markdown"];
$render["page"]["content"] = $postData["content"];
$render["page"]["adult"] = $postData["adult"];

$reading_time = getReadTime($render["page"]["content"]);


// if adult content
if($adultContent) {
  header("Rating: RTA-5042-1996-1400-1577-RTA");
}

include_once(BASE_DIR.TEMPLATE_DIR.'post.tpl');
exit;

?>