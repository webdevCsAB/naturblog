<?php 

// footer
define("ENGINE_VERSION", "v1.0ß");
define("ENGINE_LAST_BUILD", "20220524");

?>
<footer>
 
  <a href="#top" class="gotop" title="<?php echo txt('lbl_button_go_top'); ?>...">&raquo;</a>
  
  <p>

    &copy; 2022 <?php echo BLOG_NAME; ?>. <?php echo txt('txt_all_rights'); ?>

    <span class="footer-nav">
      <a href="<?php echo BASE_URL; ?>" title="<?php echo txt('ttl_button_home'); ?>"><?php echo txt('lbl_button_home'); ?></a>
      <a title="<?php echo txt('ttl_button_tags'); ?>" href="<?php echo BASE_URL; ?>tags"><?php echo txt('lbl_button_tags'); ?></a>
      <a title="<?php echo txt('ttl_button_rss'); ?>" href="<?php echo BASE_URL; ?>rss.xml" target="_blank"><?php echo txt('lbl_button_rss'); ?></a>
      <a title="<?php echo txt('ttl_button_sitemap'); ?>" href="<?php echo BASE_URL; ?>sitemap.xml" target="_blank"><?php echo txt('lbl_button_sitemap'); ?></a>
    </span>

    <small class="muted copy"><?php echo txt('txt_powered_by'); ?>&nbsp;<a href="#">NatúrBlog Engine</a>
    //&nbsp;Dev:&nbsp;CsAB
    <br><?php echo ENGINE_VERSION; ?>&nbsp;(Build:&nbsp;<?php echo ENGINE_LAST_BUILD; ?>)</small>

  </p>
</footer>

<script src="<?php echo BASE_URL.VIEW_DIR; ?>js/main.js"></script>

<?php if(defined("DEBUG") && DEBUG == $_SERVER["REMOTE_ADDR"] && isset($_SESSION)): ?>
<pre id="debug" style="white-space:pre-wrap;"><code>
-------- $_SESSION: <?php print_r($_SESSION); ?>

-------- $_SERVER: <?php print_r($_SERVER); ?>

-------- CONSTANS: <?php 
        $c=get_defined_constants(true);
        $const_user=$c['user'];
        ksort($const_user);
        print_r($const_user);
?>
<?php foreach ($render as &$str) { $str = str_replace('<', '&lt;', $str); } ?>
-------- $render: <?php print_r($render); ?>
</code></pre>
<?php endif; ?>
