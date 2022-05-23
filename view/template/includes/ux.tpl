<?php 

// Font Size + Dark Mode + RSS Feed 

?>
<div class="text-center hidden-print">
    <a title="<?php echo txt('ttl_button_font_size'); ?>" href="/?change-fontsize" class="btn">Aa: <?php echo $zoom; ?></a>
    <a title="<?php echo txt('ttl_button_dark_light_mode'); ?>" href="/?change-mode" class="btn"><?php if($dark_mode !== " dark-mode "): ?>&#9733;&nbsp;<?php echo txt('lbl_button_dark_mode'); ?><?php else: ?>&#9728;&nbsp;<?php echo txt('lbl_button_light_mode'); ?><?php endif; ?></a>
    <a title="<?php echo txt('ttl_button_rss'); ?>" href="<?php echo BASE_URL; ?>rss.xml" target="_blank" class="btn"><?php echo txt('lbl_button_rss'); ?></a>
</div>
