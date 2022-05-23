<?php 

/**
 * All Tags / Tag Cloud Page
 * List all tag 
 *
 * INHERITED VARIABLES:
 * - $url (array), $page (posts), $permalink (posts) 
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

$render["page"] = array();
$render["page"]["namespace"] = "";
$render["page"]["slug"] = "tags";
$render["page"]["permalink"] = $permalink;
$render["page"]["title"] = txt('ttl_button_tags')." / ".txt('lbl_button_tags');
$render["page"]["desc"] = "";
$render["page"]["keywords"] = "";
$render["page"]["created"] = "";
$render["page"]["markdown"] = "";
$render["page"]["content"] = "";
$render["page"]["tagcloud"] = getTagCloud();

include_once(BASE_DIR.TEMPLATE_DIR.'tags.tpl');
exit;

?>