<?php 

/**
 * NATÚRBLOG ENGINE
 * index.php 
 *
 * PHP Version 5
 *
 * @category PHP
 * @author   CsAB
 * @license  MIT
 */

// ==============================================
// == SETTINGS ==
// ==============================================

header("Content-Type: text/html; charset=UTF-8");

// header("Expires: Fri, 10 Aug 2007 15:05:23 GMT");
// header("Last-Modified: " . gmdate("r"));
// header("Cache-Control: no-store, no-cache, must-revalidate");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");

set_time_limit(30);

ini_set('display_errors', '0');
error_reporting(0);
 
ini_set('memory_limit', '24M');
mb_internal_encoding("utf-8");
mb_regex_encoding('utf-8');

// detect and set BASE_DIR 
$pwd =  rtrim(str_replace("\\", "/", getcwd()), "/");
define("BASE_DIR", $pwd."/");

// alerts :: accept & error messages
$accept = false; 
$acceptmessages = false;
$error = false;
$errormessages = false;

// ==============================================
// == CONFIG == DEBUG ==
// ==============================================

// check and load config
$config_file = BASE_DIR.'system/config.php';
if(!is_file($config_file) ) {
    header("HTTP/1.0 503 Service unavailable"); 
    include_once(BASE_DIR."error503.html");
    echo "ERROR CODE: #001 :: Missing config file";
    exit;
} else {
    require_once($config_file);
}

// check BASE_URL
if(!defined("BASE_URL")) {
    header("HTTP/1.0 503 Service unavailable"); 
    include_once(BASE_DIR."error503.html");
    echo "ERROR CODE: #002 :: Bad config file";
    exit;
}

// check DEBUG
if(defined("DEBUG") && DEBUG == $_SERVER["REMOTE_ADDR"]) {
  ini_set('display_errors', '1');
  error_reporting(E_ALL); 
}

// session
session_start();

// ==============================================
// == LANGUAGES == LOAD FUNCTIONS ==
// ==============================================

// set language & load lang.ini
if(!defined("BASE_LANG")) {
  define("BASE_LANG", "en");
}
$language_file = BASE_DIR.LANG_DIR.BASE_LANG.".ini";
if(!is_file($language_file)) {
    header("HTTP/1.0 503 Service unavailable"); 
    include_once($pwd."/error503.html");
    echo "ERROR CODE: #003 :: Missing ".BASE_LANG.".ini file";
    exit;
}
// make a dictionary array
$dictArray = parse_ini_file(BASE_DIR.LANG_DIR.BASE_LANG.".ini");

// load functions
require_once(BASE_DIR.SYSTEM_DIR.'functions.php');

// set language specs
define('LANGUAGE', txt("cnf_lang_name"));
define("BASE_LOCALE", txt("cnf_lang_locale"));
define("TEXT_DIRECTION", txt("cnf_lang_txt_dir"));
date_default_timezone_set(txt("cnf_lang_timezone")); 
setlocale(LC_ALL, BASE_LOCALE.'.utf8');

// ==============================================
// == TEMPLATE DEFAULTS ==
// ==============================================

$render = array();
$adultContent = false;

// dark & light mode
$dark_mode = " dark-mode-off ";
if((date("G") >= 18 && date("G") <= 24) || (date("G") >= 0 && date("G") <= 6)) {
  $dark_mode = " dark-mode ";
} 
if(!isset($_SESSION["darkMode"])) {
  $_SESSION["darkMode"] = $dark_mode;
}
// darkMode load and override from session
if(isset($_SESSION["darkMode"]) && $_SESSION["darkMode"]) {
  $dark_mode = $_SESSION["darkMode"];
}

// zoom / fontSize
$zoom = 1;
if(!isset($_SESSION["zoomLevel"])) {
  $_SESSION["zoomLevel"] = $zoom;
}
// zoomLevel load and override from session
if(isset($_SESSION["zoomLevel"]) && $_SESSION["zoomLevel"]) {
  $zoom = $_SESSION["zoomLevel"];
}

// ==============================================
// == ROUTING == CALLING CONTROLLERS ==
// ==============================================

// set defaults
$permalink = false;
$page = false;

// get path & query from url
$url = parse_url($_SERVER['REQUEST_URI']);

if(isset($url["path"]) && $url["path"]) {
    $permalink = $url["path"];
} else {
    header("HTTP/1.0 400 Bad Request");
    include_once($pwd."/error500.html");
    echo "ERROR CODE: #004";    
    exit;
}

// remove first and last slash 
$permalink = strtolower(trim($permalink, "/"));

// validate permalink
if(!checkPermalink($permalink)) {
  header("Location:".BASE_URL."error404?invalidPermalink");
  exit;
}

$permalinkArray = explode("/", $permalink);
if($permalinkArray[0] == "") {
  $page = "index"; 
} else {
  $page = $permalinkArray[0];
}

// exclude pages, eg. /index
$exludePages = array("index", "post");
if(in_array($permalink, $exludePages)) {
  header("Location:".BASE_URL."error404?excludePage");
  exit;
} 

// search contoller/page file
$controller_file = BASE_DIR.CONTROLLER_DIR.$page."_page.php";
if(is_file($controller_file)) {
  include_once($controller_file);
  exit;
} 

// ==============================================
// == ERROR 404 ==
// ==============================================

// if no controller/page file
header("Location:".BASE_URL."error404?notFound");
exit;

?>