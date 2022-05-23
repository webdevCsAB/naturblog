<?php 

// paginator 

?>
<?php if(!empty($paginatorArray["total_pages"]) && $paginatorArray["total_pages"] > 1): ?>

  <p class="text-center muted">
    <?php if($paginatorArray["actual_page"] == $paginatorArray["total_pages"]): ?>
      <em><?php echo txt("txt_reached_end"); ?></em>
    <?php else: ?>
      <em><?php echo txt("txt_dont_stop_now"); ?></em>
    <?php endif; ?>
  </p>

<?php endif; ?>

<p class="text-right small"><?php echo txt("txt_totals"); ?>: <strong><?php echo $paginatorArray["total_items"]; ?></strong></p>

<?php if(!empty($paginatorArray["total_pages"]) && $paginatorArray["actual_page"] && $paginatorArray["total_pages"] > 1): ?>

<p class="paginator">

    <?php if($paginatorArray["actual_page"] == 1): ?>
      <span class="page-item page-item-disabled">
        &laquo;
      </span>
    <?php else: ?>
      <span class="page-item">
        <a class="page-link" title="<?php echo txt("ttl_button_first_page"); ?>" href="?page=1<?php if($paginatorArray["param"]): ?>&amp;filter=<?php echo urlencode($paginatorArray["param"]); ?><?php endif; ?>">&laquo;</a>
      </span>
    <?php endif; ?>
  
    <?php if($paginatorArray["actual_page"] == 1): ?>
      <span class="page-item page-item-disabled">
        &lsaquo;
      </span>
    <?php else: ?>
      <span class="page-item">
        <a class="page-link" title="<?php echo txt("ttl_button_prev_page"); ?>" href="?page=<?php echo $paginatorArray["actual_page"] - 1; ?><?php if($paginatorArray["param"]): ?>&amp;filter=<?php echo urlencode($paginatorArray["param"]); ?><?php endif; ?>">&lsaquo;</a>
      </span>
    <?php endif; ?>
  
    <span class="page-item page-item-active">
      <strong class="page-item-actual"><?php echo $paginatorArray["actual_page"]; ?></strong> / <?php echo $paginatorArray["total_pages"]; ?>
    </span>
  
    <?php if($paginatorArray["actual_page"] == $paginatorArray["total_pages"]): ?>
      <span class="page-item page-item-disabled">
        &rsaquo;
      </span>
    <?php else: ?>
      <span class="page-item">
        <a class="page-link" title="<?php echo txt("ttl_button_next_page"); ?>" href="?page=<?php echo $paginatorArray["actual_page"] + 1; ?><?php if($paginatorArray["param"]): ?>&amp;filter=<?php echo urlencode($paginatorArray["param"]); ?><?php endif; ?>">&rsaquo;</a>
      </span>
    <?php endif; ?>
  
    <?php if($paginatorArray["actual_page"] == $paginatorArray["total_pages"]): ?>
      <span class="page-item page-item-disabled">
        &raquo;
      </span>
    <?php else: ?>
      <span class="page-item">
        <a class="page-link" title="<?php echo txt("ttl_button_last_page"); ?>" href="?page=<?php echo $paginatorArray["total_pages"]; ?><?php if($paginatorArray["param"]): ?>&amp;filter=<?php echo urlencode($paginatorArray["param"]); ?><?php endif; ?>">&raquo;</a>
      </span>
    <?php endif; ?>

</p>

<?php endif; ?>