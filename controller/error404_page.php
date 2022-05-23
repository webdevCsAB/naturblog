<?php 

/**
 * ERROR404 Page
 *
 * INHERITED VARIABLES:
 * - $url (array), $page (error404), $permalink (error404) 
 * - $dark_mode (dark-mode-off), $zoom (1) 
 * - and constans: BASE_URL, BASE_DIR, etc.  
 *
 * PHP Version 5
 *
 * @category PHP
 * @author   CsAB
 * @license  MIT
 */

$render["page"] = array();
$render["page"]["namespace"] = "";
$render["page"]["slug"] = "error404";
$render["page"]["permalink"] = $permalink;

$render["page"]["title"] = "ERROR404";
$render["page"]["desc"] = "";
$render["page"]["keywords"] = "";
$render["page"]["created"] = "";
$render["page"]["markdown"] = "";
$render["page"]["content"] = "";

header("HTTP/1.0 404 Not Found");

include_once(BASE_DIR.TEMPLATE_DIR.'error404.tpl');
exit;

?>