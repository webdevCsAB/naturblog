<?php 

/**
 * All Post / Posts Page
 * Redirect to Home Page 
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

// too many parameters
if(count($permalinkArray) > 2) {
  header("Location:".BASE_URL."error404?tooManyBackSlash");
  exit;
}

// redirect home page
// if /posts --> home page 
if(count($permalinkArray) == 1) {
  header("Location:".BASE_URL, true, 301);
  exit;
}

$pageNamespace = "posts"; 
$pageSlug = $permalinkArray[1]; 

// load single post
include_once(BASE_DIR.CONTROLLER_DIR."post_page.php");
exit;

?>