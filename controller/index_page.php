<?php 

/**
 * Home Page
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

$filtered = false; // false or string

// change dark mode / light mode
if(isset($_GET["change-mode"])) {

  if(isset($_SESSION["darkMode"]) && $_SESSION["darkMode"] == " dark-mode ") {
    $_SESSION["darkMode"] = " dark-mode-off ";
  } else {
    $_SESSION["darkMode"] = " dark-mode ";
  }
  $dark_mode = $_SESSION["darkMode"];
  if(isset($_SERVER["HTTP_REFERER"]) && $_SERVER["HTTP_REFERER"]
  && getDomainFromUrl($_SERVER["HTTP_REFERER"]) == SITE_DOMAIN) {
    header("Location:".$_SERVER["HTTP_REFERER"]);
    exit;
  }

}

// change font size / zoom
if(isset($_GET["change-fontsize"])) {
  $zoom++;
  if($zoom > 4) {
    $zoom = 1;
  }
  if(isset($_SESSION["zoomLevel"]) && $_SESSION["zoomLevel"]) {
    $_SESSION["zoomLevel"] = $zoom;
  } else {
    $_SESSION["zoomLevel"] = 2;
  }
  if(isset($_SERVER["HTTP_REFERER"]) && $_SERVER["HTTP_REFERER"]
  && getDomainFromUrl($_SERVER["HTTP_REFERER"]) == SITE_DOMAIN) {
    header("Location:".$_SERVER["HTTP_REFERER"]);
    exit;
  }

}

// load model
include_once(BASE_DIR.MODEL_DIR.'post_model.php');

// search active filter
if(isset($_GET["filter"]) && $_GET["filter"]) {
  if(!preg_match("/^[0-9a-z\-]+$/", $_GET["filter"])) {
    header("Location:".BASE_URL."error404?badFilterFormat");
    exit;
  }
  $filtered = trim(strip_tags($_GET["filter"])); 
}

$render["page"] = array();
$render["page"]["filter"] = $filtered;

// load all posts by DESC order
$render["page"]["post_items"] = readAllPosts(false, $filtered); 

// paginator
$paginatorArray = array();
$paginatorArray["source"] = $render["page"]["post_items"]; 
unset($render["page"]["post_items"]);
$paginatorArray["param"] = $filtered;
include_once(BASE_DIR.CONTROLLER_DIR.'includes/paginator.inc');
$render["page"]["post_items"] = $paginatorArray["paginated_source"];
unset($paginatorArray["source"]);
unset($paginatorArray["paginated_source"]);

$render["page"]["namespace"] = "";
$render["page"]["slug"] = "";
$render["page"]["permalink"] = $permalink;

$render["page"]["title"] = txt('txt_posts');
if($filtered) {
  $render["page"]["title"] = txt('txt_search').": ".str_replace("-", " ", mb_strtoupper($filtered));  
}
$render["page"]["desc"] = "";
$render["page"]["keywords"] = "";
$render["page"]["created"] = "";
$render["page"]["markdown"] = "";
$render["page"]["content"] = "";

include_once(BASE_DIR.TEMPLATE_DIR.'index.tpl');
exit;

?>