<?php 

// Copy URL and SHARE button (with)

// filtered and pure link
$copy_link = BASE_URL.$permalink;
$params = array();
if(isset($render["page"]["filter"]) && $render["page"]["filter"]) {
  $params["filter"] = $render["page"]["filter"]; 
}
if(isset($paginatorArray["actual_page"]) && $paginatorArray["actual_page"]) {
  $params["page"] = $paginatorArray["actual_page"]; 
}
$params = http_build_query($params);
if(!empty($params)) {
  $copy_link .= "?".$params;
}

?>
<div>

  <a title="<?php echo txt('ttl_button_url_copy'); ?>" href="#ctcbd" class="btn hidden-print" id="ctcbd" data-button-def="&#128279;&nbsp;<?php echo txt('lbl_button_url_copy'); ?>" data-button-copied="&#10004;&nbsp;<?php echo txt('lbl_button_url_copied'); ?>" data-clipboard-text="<?php echo htmlspecialchars($copy_link); ?>" onclick="copyToClipboard();">&#128279;&nbsp;<?php echo txt('lbl_button_url_copy'); ?></a> 
  <a title="<?php echo txt('ttl_button_share'); ?>..." href="https://www.addthis.com/bookmark.php?v=15&amp;winname=addthis&amp;s=more&amp;url=<?php echo urlencode($copy_link); ?>&amp;title=<?php echo urlencode($render["page"]["title"].' | '.BLOG_NAME); ?>" class="btn hidden-print" target="_blank">+&nbsp;<?php echo txt('lbl_button_share'); ?></a>

</div>