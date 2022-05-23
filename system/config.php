<?php 

/**
 * NATÚRBLOG ENGINE 
 * Constant settings
 *
 * PHP Version 5
 *
 * @category PHP
 * @author   CsAB
 * @license  MIT
 */

// debug :: yourIP | false
define("DEBUG", "127.0.0.1x");

// domain
define("SITE_DOMAIN", "naturblog.brum");
define("SITE_PROTOCOL", "http");
define("BASE_URL", SITE_PROTOCOL."://".SITE_DOMAIN."/");

// language :: hu | en | de ... etc
// Need .ini file (!)
define("BASE_LANG", "en");

// user
define("AUTHOR_NICK", "CsAB");
define("ADMIN_USERNAME", "admin"); // not used yet
define("ADMIN_PASSWORD", "password"); // not used yet

// dirs
define("SYSTEM_DIR", "system/");
define("MODEL_DIR", "model/");
define("VIEW_DIR", "view/");
define("TEMPLATE_DIR", VIEW_DIR."template/");
define("CONTROLLER_DIR", "controller/");
define("LANG_DIR", "languages/");
define("POST_DIR", "posts/");

// blog
define("BLOG_NAME", "DEMO BLOG");
// site logo :: recommend SVG :: don't forget to replace the apple-touch-icon.png and favicon.ico files
define("SITE_LOGO", "/view/img/logo.svg");
define("PAGINATION_ITEMS_PER_PAGE", 5);

// 3rd party comment system :: registration required
// https://commento.io/
define("COMMENTO_COMMENTS", false);

?>