<?php 

// paginator 

$paginatorArray["actual_page"] = 1;

$paginatorArray["total_items"] = 0;  

if(!empty($paginatorArray["source"])) {
  $paginatorArray["total_items"] = count($paginatorArray["source"]);
}

if(!empty($paginatorArray["source"])) {

  // if exists param page
  if(isset($_GET["page"]) && is_numeric($_GET["page"])) {
    
    // out of limits
    if($_GET["page"] < 1 || $_GET["page"] > 9999) {
      header("Location:".BASE_URL."error404?wrongPageNum");
      exit;
    }

    // set actual Page Number
    $paginatorArray["actual_page"] = intval($_GET["page"]);
    
    // remove ?page=1 from params
    if($paginatorArray["actual_page"] == 1) {
      
      if(isset($url["query"])) {

        parse_str($url["query"], $output);
        unset($output["page"]);
        $params = http_build_query($output);
        if(empty($params)) {
          header("Location:".BASE_URL);
          exit;
        }
        header("Location:".BASE_URL."?$params");
        exit;

      }
      
    }
    
  }
  
  // count total pages
  $paginatorArray["total_pages"] = (int)(ceil($paginatorArray["total_items"] / PAGINATION_ITEMS_PER_PAGE));
  
  // validate total pages minimum
  if($paginatorArray["total_pages"] < 1) {
    $paginatorArray["total_pages"] = 1;
  }
  
  // validate total pages maximum
  if($paginatorArray["actual_page"] && $paginatorArray["actual_page"] > $paginatorArray["total_pages"]) {
    header("Location:".BASE_URL."error404?pageNumOver");
    exit;
  }
  
  $paginatorArray["paginated_source"] = array();
  $item_count = 1;
  $min_item_key = 0; 
  $max_item_key = PAGINATION_ITEMS_PER_PAGE;
  
  foreach($paginatorArray["source"] as $source_item) {
      
      // paginate
      if($paginatorArray["actual_page"] && $paginatorArray["actual_page"] > 1) {
        $min_item_key = (($paginatorArray["actual_page"] - 1) * PAGINATION_ITEMS_PER_PAGE) + 1;
        $max_item_key = $min_item_key + PAGINATION_ITEMS_PER_PAGE - 1;
      } else {
        $max_item_key = $min_item_key + PAGINATION_ITEMS_PER_PAGE;
      }
  
      if($paginatorArray["actual_page"] && ($item_count < $min_item_key || $item_count > $max_item_key)) {
          $item_count++;
          continue;
      }

      $paginatorArray["paginated_source"][$item_count] = $source_item;
    
      $item_count++;
    
  }

} else {

  $paginatorArray["paginated_source"] = $paginatorArray["source"];

}