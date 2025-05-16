<?php 

// pager 

?>
<ul class="pager hidden-print">
    <?php if(empty($render["page"]["pager"]["prev"])): ?>
      <li class="previous"><a href="javascript:;" class="btn disabled">&laquo;&nbsp;<?php echo txt("ttl_button_prev"); ?></a></li>
    <?php else: ?>
      <li class="previous"><a href="<?php echo BASE_URL; ?>posts/<?php echo $render["page"]["pager"]["prev"]["slug"]; ?>" class="btn" title="<?php echo htmlspecialchars($render["page"]["pager"]["prev"]["title"]); ?>">&laquo;&nbsp;<?php echo txt("ttl_button_prev"); ?></a></li>
    <?php endif; ?>
    <!-- 
      <li class="home"><a href="<?php echo BASE_URL; ?>" class="btn" title="<?php echo txt("ttl_button_home"); ?>"><?php echo txt("lbl_button_home"); ?></a></li>
    //-->
    <?php if(empty($render["page"]["pager"]["next"])): ?>
      <li class="next"><a href="javascript:;" class="btn disabled"><?php echo txt("ttl_button_next"); ?>&nbsp;&raquo;</a></li>
    <?php else: ?>
      <li class="next"><a href="<?php echo BASE_URL; ?>posts/<?php echo $render["page"]["pager"]["next"]["slug"]; ?>" class="btn" title="<?php echo htmlspecialchars($render["page"]["pager"]["next"]["title"]); ?>"><?php echo txt("ttl_button_next"); ?>&nbsp;&raquo;</a></li>
    <?php endif; ?>
</ul>
