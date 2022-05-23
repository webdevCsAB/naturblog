<?php 

/**
 * SITEMAP (XML)
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
$allPostData = readAllPosts(false); 

$lastItem = false;
if(!empty($allPostData)) {
  $apdKeys = array_keys($allPostData);
  $apdKeys = $apdKeys[0];
  $lastItem = $allPostData[$apdKeys]["created"];
}

header('Content-Type: text/xml; charset=UTF-8');

$render["page"] = array();
$render["page"]["namespace"] = "";
$render["page"]["slug"] = "sitemap";
$render["page"]["permalink"] = $permalink;

$render["page"]["title"] = txt('lbl_button_sitemap');
$render["page"]["desc"] = "";
$render["page"]["keywords"] = "";
$render["page"]["created"] = "";
$render["page"]["markdown"] = "";
$render["page"]["content"] = "";

include_once(BASE_DIR.TEMPLATE_DIR.'sitemap.tpl');
exit;

?>