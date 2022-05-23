<?php 

/**
 * NATÚRBLOG ENGINE 
 * Self-made Functions
 *
 * PHP Version 5
 *
 * @category PHP
 * @author   CsAB
 * @license  MIT
 */


/**
 * Translate a text from dictionary ($dictArray)
 * $dictArray is global 
 *  
 * &param string $txt 
 * &param string $inner (def: false) 
 * @return string
 */
function txt($txt, $inner = false) {
  global $dictArray;
  if(isset($dictArray[$txt])) {
    if($inner) {
      $dictArray[$txt] = str_replace("%s", $inner, $dictArray[$txt]);
    }
    return $dictArray[$txt];
  }
return "{".$txt."}";
}


/**
 * Slugify
 * using Drupal i18n-ascii.example.txt file 
 *  
 * &param string $text 
 * @return string
 */
function slugify($text) { 
  $enc = mb_detect_encoding($text, mb_detect_order(), true);
  $text = iconv($enc, "UTF-8", $text);
  // replace non letter or digits by -
  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
  $text = trim($text, '-');
  $file = BASE_DIR.SYSTEM_DIR."i18n/i18n-ascii.example.txt";
  if(is_file($file)) {
    $translations = parse_ini_file($file);
    $output = strtr(strip_tags($text), $translations);
    $output = preg_replace("/[^A-Za-z0-9\ \-]/", "", $output); 
    $text = strtolower(preg_replace("/ /", "-", $output)); 
  }  
  if(empty($text))  {
    return 'n-a';
  }
  return strtolower($text);
}


/**
 * Validate a permalink / slug 
 * Allowed chars: 0-9 a-z - / 
 *  
 * &param string $permalink 
 * @return string
 */
function checkPermalink($permalink = "") {
  if(preg_match("/^[a-z0-9\-\/]*$/", $permalink)) {
    return true;
  }
  return false;
}

/**
 * Shorting a long text
 * I am a long long long long text 
 * I am... short 
 *  
 * &param string $text
 * &param int $length (default: 50)
 * &param string $postfix
 * @return string
 */
function textShorter($text, $length=50, $suffix="...") {
  if(mb_strlen($text) < $length) {
    return $text;
  }
  return mb_substr($text, 0, $length).$suffix;
}


/**
 * Validate an e-mail address
 *  
 * &param string $email
 * @return boolean
 */
function is_Email($email) {
  $pattern = "/^[a-zA-Z0-9\._-]+"
  . "@"
  . "[a-zA-Z0-9][a-zA-Z0-9-]*"
  . "(\.[a-zA-Z0-9_-]+)*"
  . "\.([a-zA-Z]{2,10})$/";
  return preg_match($pattern, $email);
}


/**
 * Validate a domain name
 *  
 * &param string $domain
 * @return boolean
 */
function is_domainName($domain) {
    return (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domain)
            && preg_match("/^.{2,253}$/", $domain)
            && preg_match("/^[^\.]{1,63}(\.[^\.]{2,63})*$/", $domain)
           );
}


/**
 * Get a domain name from URL or e-mail address
 *  
 * &param string $url
 * &param boolean $is_email
 * &param boolean $hide_subdomain
 * @return string
 */
function getDomainFromUrl($url, $is_email=false, $hide_subdomain=false) {
  if($is_email) {
    if(is_Email($url)) {
      $tmp = explode("@", $url);
        return $tmp[1];
    } else {
        return false;
    }
  }
  if(!filter_var($url, FILTER_VALIDATE_URL)) {
      return false;
  }
  if($hide_subdomain) {
    $host_names = explode(".", parse_url($url, PHP_URL_HOST));
    return $host_names[count($host_names)-2] . "." . $host_names[count($host_names)-1];
  }
  return parse_url($url, PHP_URL_HOST);
}


/**
 * Remove White Space
 * for HTML Code Compression 
 * except <pre><code class="...">...</code></pre> 
 *  
 * &param string $buffer
 * @return string
 */
function removeWhitespace($buffer) {
  // for source code debug
  if(defined("DEBUG") && DEBUG == $_SERVER["REMOTE_ADDR"]) {
    return false;
  }
  // pre + code :: \n replace <br>
  $parts = preg_split("/\<pre\>\s*(\<code\>.+\<\/code\>)\s*\<\/pre\>/Umsu", $buffer, -1, PREG_SPLIT_DELIM_CAPTURE);
  foreach($parts as $key => $value) {
    if(strpos($value, "code>") == 1) {
      $parts[$key] = preg_replace('/\r/u', '', $parts[$key]);  
      $parts[$key] = preg_replace('/\n/u', '<br>', $parts[$key]);
      $parts[$key] = "<pre>".$parts[$key]."</pre>";
    }
  }
  $buffer = implode('',$parts);
  unset($parts);
  $buffer = preg_replace('/\s+/u', ' ', $buffer);
  return $buffer;
}


/**
 * Show Long Date(Time) (in specified language) string format 
 * based on Unix Timestamp 
 * 
 * REQUIRED: is_Date() FUNCTION
 * REQUIRED: getMonthNamebyNumber() FUNCTION
 *   
 * &param int $unix_timestamp
 * &param boolean $show_time
 * @return string
 */
function timestamp2LongDateTime($unix_timestamp = 0, $show_time = false) {
  if(!is_numeric($unix_timestamp)) {
    return "N/A";   
  }
  $smp = txt("cnf_date_format");
  if(!$show_time) {
    $tmp = strpos($smp,"@");
    $smp = substr($smp, 0, -1*(strlen($smp) - $tmp)); 
  }
  $m = date("n", $unix_timestamp);
  $smpM = getMonthNamebyNumber($m);
  $smp = str_replace("F", '\\#', $smp);
  $tmp = date($smp, $unix_timestamp);
  return str_replace("#", $smpM, $tmp);
}
// @TODO testing
// var_dump(timestamp2LongDateTime(time(), true));exit;
// var_dump(timestamp2LongDateTime());exit;


/**
 * Get the name of month (in specified language) 
 * based on the number of Months 
 * 
 * PART OF timestamp2LongDateTime() FUNCTION  
 *   
 * &param int $monthNumber
 * @return string
 */
function getMonthNamebyNumber($monthNumber=13) {
  if($monthNumber < 0 || $monthNumber > 12) {
    return "N/A";
  }
  $monthNumber -= 1;
  $monthNameArray = explode(",", txt("cnf_date_months"));
  return trim($monthNameArray[$monthNumber]);
}


/**
 * Validate a specified string format Date
 * February 29, 2022 is false 
 *  
 * &param string $date 
 * &param string $format (def: Y-m-d H:i:s) 
 * @return boolean
 */
function is_Date($date = "", $format = 'Y-m-d H:i:s') {
  $timestamp = strtotime($date);
  $test = date($format, $timestamp);
  if($test == $date) {
    return true;
  }
  return false;
}
// @TODO testing
// var_dump(is_Date('2022-02-28', 'Y-m-d')); exit;
// var_dump(is_Date('2022-02-29', 'Y-m-d')); exit;
// var_dump(is_Date('2022-02-30', 'Y-m-d')); exit;


/**
 * Show Relative Time from NOW
 *  
 * &param int $unix_timestamp
 * @return boolean
 */
function relativeTime($unix_timestamp = false) {
	if(!is_numeric($unix_timestamp) || $unix_timestamp < 1) {
   	echo txt("txt_from_recently");
		return false;
	}
	if ($unix_timestamp > time()) {
   	echo txt("txt_from_recently");
		return false;
	}
	
  $defSecond = 1;
  $defMinute = 60 * $defSecond;
  $defHour = 60 * $defMinute;
  $defDay = 24 * $defHour;
  $defMonth = 30 * $defDay;

	$delta = strtotime(date('r')) - $unix_timestamp;
 
	if ($delta < 2 * $defMinute) {
		return txt("txt_from_recently");
	} else if ($delta < 45 * $defMinute) {
		return txt("txt_from_minutes", floor($delta / $defMinute));
	} else if ($delta < 90 * $defMinute) {
		return txt("txt_from_hour");
	} else if ($delta < 24 * $defHour) {
		return txt("txt_from_hours", floor($delta / $defHour));
	} else if ($delta < 48 * $defHour) {
		return txt("txt_from_yesterday");
	} else if ($delta < 30 * $defDay) {
		return txt("txt_from_days", floor($delta / $defDay));
	} else if ($delta < 12 * $defMonth) {
		$months = floor($delta / $defDay / 30);
		return $months <= 1 ? txt("txt_from_month") : txt("txt_from_months", $months);
	} else {
		$years = floor($delta / $defDay / 365);
		return $years <= 1 ? txt("txt_from_year") : txt("txt_from_years", $years);
	}
	return true;
}


/**
 * Replace the spaces and hyphens
 * to non-breakable chars in text
 *   
 * &param string $text
 * @return string
 */
function replaceNonBreakable($text = "") {
  $text = str_replace(" ", "&nbsp;", $text);
  return str_replace("-", "&#8209;", $text);
}


/**
 * Show Nice file size (eg. KB, MB ... PB)
 *  
 * &param int $bytes
 * &param int $rounded (def: 2)
 * @return string
 */
function getNiceFileSize($bytes, $rounded=2) {
            $unit=array('B','KB','MB','GB','TB','PB');
            if ($bytes==0) return '0 ' . $unit[0];
            return @round($bytes/pow(1024,($i=floor(log($bytes,1024)))),$rounded) .' '. (isset($unit[$i]) ? $unit[$i] : 'B');
}


/**
 * Calculate Reading Time
 *  
 * &param string $string 
 * @return string
 */
function getReadTime($string = "") {
  if(empty($string)) {
    return "N/A";
  }
  $word = str_word_count(strip_tags($string));
  $m = ceil($word / 200);
  $est = "$m&nbsp;". ($m == 1 ? txt("cnf_date_minute") : txt("cnf_date_minutes"));
  return $est;
}

?>