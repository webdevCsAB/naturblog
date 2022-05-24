<?php

/**
 * NATÚRBLOG ENGINE 
 * Self-made Post Model Functions
 *
 * PHP Version 5
 *
 * @category PHP
 * @author   CsAB
 * @license  MIT
 */


/**
 * Simple sorting function 
 * order by filemtime() DESC
 * 
 * PARTS OF getMdFiles() FUNCTION
 *    
 * &params boolean $a, $b
 * @return array()
 */
function sortByFileMTimeDesc($a, $b) {
    return filemtime($b) - filemtime($a);
}


/**
 * Read all Markdown format (*.md) Post Files
 * from POST_DIR
 * 
 * REQUIRED: sortByFileMTimeDesc() FUNCTION  
 *    
 * &param boolean $order (def: true)
 * @return false or array()
 */
function getMdFiles($order = true) {

  $mdFilesArray = glob(BASE_DIR.MODEL_DIR.POST_DIR."*.md");
  if(empty($mdFilesArray)) {
    return false;
  }
  if($order) {
    usort($mdFilesArray, 'sortByFileMTimeDesc');
  }
  return $mdFilesArray;
}


/**
 * Read all Posts 
 * optionally with contents
 *    
 * &param boolean $withContent (def: false) 
 * &param string $filtered (def: false) 
 * @return false or array()
 */
function readAllPosts($withContent = false, $filtered = false) {

  if($filtered) {
    // no exists tags
    if(!in_array($filtered, getAllTags(true))) {
      return false;
    }
    $postsArray = getFilteredMdFiles($filtered);
  } else {
    $postsArray = getMdFiles();
  }
  
  if(empty($postsArray)) {
    return false;
  }

  // https://parsedown.org/
  // https://www.markdownguide.org/cheat-sheet/
  include_once(BASE_DIR.SYSTEM_DIR."markdown-parser/parsedown-modified.php");
  $Parsedown = new Parsedown();

  $postData = array();

  foreach ($postsArray as $key=>$postFile) {
    $postSlug = substr(basename($postFile), 0, -3);
    $postCreated = filemtime($postFile);
    $postContent = @file_get_contents($postFile);
    $postContentArray = preg_split('#\r?\n#', $postContent, 0);
    $postTitle = trim($postContentArray[0], "#");
    unset($postContentArray[0]);
    $postContent = implode("\n", $postContentArray);    
    unset($postContentArray);
    $postData[$postSlug] = array();
    $postData[$postSlug]["title"] = $postTitle;    
    $postData[$postSlug]["created"] = $postCreated;    
    $postData[$postSlug]["slug"] = $postSlug; 
    $postData[$postSlug]["markdown"] = $postContent;    
    $postData[$postSlug]["content"] = $Parsedown->text($postContent); 
    $postData[$postSlug]["reading"] = getReadTime($postData[$postSlug]["content"]); 	
    $postData[$postSlug]["adult"] = false;
    if(strstr($postData[$postSlug]["content"], "#18+")) {
      $postData[$postSlug]["adult"] = "<span class='cred'>&#x1F51E;</span> ";
    }
    if(!$withContent) {
      $postData[$postSlug]["markdown"] = ""; 
      $postData[$postSlug]["content"] = ""; 
    }
  }
  return $postData;
}


/**
 * Get/Search an unique Post by Permalink (slug)
 *    
 * &param string $slug (def: false) 
 * &param boolean $withContent (def: false) 
 * @return false or array()
 */
function getPostByPermalink($slug = false, $withContent = false) {
  if(!empty($slug)) {
    $postData = readAllPosts($withContent);
    if(isset($postData[$slug])) {
      return $postData[$slug];
    }
  }
  return false;
}


/**
 * Get all Tags from Posts 
 * optionally with contents
 *    
 * &param boolean $onlyTags (def: false)  
 * @return array()
 */
function getAllTags($onlyTags = false) {
  $allPostsWithContent = readAllPosts(true);
  $pattern = "/\?filter\=(.+?)\"\>\#(.+?)\<\/a/";
  $allTags = array();
  foreach ($allPostsWithContent as $key=>$value) {
      $url = $value["slug"];
      $f = explode("<hr />", $value["content"]);
      $f = array_pop($f);
      preg_match_all($pattern, $f, $m);
      if(!isset($m[1]) || empty($m[1])) {
        continue;
      }
      foreach ($m[1] as $tag) {
        if(!preg_match("/^[a-z0-9\-\+]+$/", $tag)) {
          continue;
        }
        if($onlyTags) {
          $allTags[] = $tag;  
        } else {
          if(!isset($allTags[$tag])) {
            $allTags[$tag] = array();
          }
          $allTags[$tag][] = $url;
        }
      }
  }
  if($onlyTags) {
    return array_values(array_unique($allTags));
  }
  return $allTags;
}


/**
 * Get Glob Formatted Array
 * with prefix and suffix
 * 
 * PARTS OF getFilteredMdFiles() FUNCTION
 *    
 * &param array $value
 * @return array()
 */
function getGlobFormattedArray($value) {
  $prefix = BASE_DIR.MODEL_DIR.POST_DIR;
  $suffix = ".md";
  return $prefix . $value . $suffix;
}


/**
 * Read all Markdown format (*.md) Post Files
 * from POST_DIR by Filters
 * 
 * REQUIRED: getGlobFormattedArray() FUNCTION  
 *    
 * &param string $filtered (def: true)
 * &param boolean $order (def: true)
 * @return array()
 */
function getFilteredMdFiles($filtered = false, $order = true) {
  if(empty($filtered)) {
    return array();
  }
  $tags = getAllTags();
  if(isset($tags[$filtered])) {
    $a = array_map( "getGlobFormattedArray", $tags[$filtered]);
    if($order) {
      usort($a, 'sortByFileMTimeDesc');
    }
    return $a;
  }
  return array();
}


/**
 * Get the tagCloud range using a percentage
 * 
 * PARTS OF getTagCloud() FUNCTION
 *	
 * @returns int $class The respective class
 * name based on the percentage value (between 0-9)
 */
function getRangeFromPercent($percent) {
  $percent = floor($percent);
  if ($percent >= 99) {
	  $class = 9;
	} elseif ($percent >= 70) {
    $class = 8;
	} elseif ($percent >= 60) {
		$class = 7;
	} elseif ($percent >= 50) {
		$class = 6;
	} elseif ($percent >= 40) {
		$class = 5;
	} elseif ($percent >= 30) {
		$class = 4;
	} elseif ($percent >= 20) {
		$class = 3;
	} elseif ($percent >= 10) {
		$class = 2;
	} elseif ($percent >= 5) {
		$class = 1;
	} else {
		$class = 0;
  }  
	return $class;
}


/**
 * Get a TagCloud Array from Posts 
 * 
 * REQUIRED: getRangeFromPercent() FUNCTION
 *        
 * &param none 
 * @return array()
 */
function getTagCloud() {
  $allPostsWithContent = readAllPosts(true);
  if(empty($allPostsWithContent)) {
    return array();
  }
  $pattern = "/\?filter\=(.+?)\"\>\#(.+?)\<\/a/";
  $allTags = array();
  foreach ($allPostsWithContent as $key=>$value) {
      $url = $value["slug"];
      $f = explode("<hr />", $value["content"]);
      $f = array_pop($f);
      preg_match_all($pattern, $f, $m);
      if(!isset($m[1]) || empty($m[1])) {
        continue;
      }
      foreach ($m[1] as $kt => $tag) {
        if(!preg_match("/^[a-z0-9\-\+]+$/", $tag)) {
          continue;
        }
        if(!isset($allTags[$tag])) {
          $allTags[$tag] = array();
        }
        $allTags[$tag]["tag"] = $tag;
        $allTags[$tag]["title"] = $m[2][$kt];
        $allTags[$tag]["links"][$key] = $url; // $kt => $key
        $allTags[$tag]["size"] = count($allTags[$tag]["links"]);
        $allTags[$tag]["range"] = 0;
      }
  }
  $max = 0;
  foreach ($allTags as $key=>$value) {
      if($value["size"] > $max) {
        $max = $value["size"];
      }
  }
  foreach ($allTags as $key=>$value) {
    $allTags[$key]["range"] = getRangeFromPercent(($value["size"] / $max)*100);
    unset($allTags[$key]["links"]);
  }
  shuffle($allTags);
  return $allTags;
}

?>