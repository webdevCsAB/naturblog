<?php 

// Single Post Meta Information

?>
<div>
    <small>
      <a href="<?php echo BASE_URL; ?>" class="txuc"><b>&lArr;&nbsp;<?php echo txt('txt_posts'); ?></b></a>
      <br>
      <?php echo relativeTime($render["page"]["created"]); ?> &bull;
      <?php /** 
      <?php echo date('Y-m-d H:i', $render["page"]["created"]); ?> &bull;
       **/ ?>
      <b title="<?php echo txt("txt_author"); ?>"><?php echo htmlspecialchars(AUTHOR_NICK); ?></b> &bull;
      <?php echo txt("txt_reading_time"); ?>: <?php echo $reading_time; ?>
      
      <?php if(defined("COMMENTO_COMMENTS") && COMMENTO_COMMENTS): ?>
       &bull;&nbsp;<a href="#commento">0 comments</a>
      <?php endif; ?>
      
    </small>
</div>