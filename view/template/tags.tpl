<?php 

// Tags / Tag Cloud template

?>
<?php ob_start('removeWhitespace'); ?><?php include_once(BASE_DIR.TEMPLATE_DIR."includes/html-head.tpl"); ?>
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">    
</head>
<body class="not-front page<?php echo $dark_mode; ?>page-<?php echo slugify($render["page"]["title"]); ?> zoom-<?php echo $zoom; ?>">

<?php include_once(BASE_DIR.TEMPLATE_DIR."includes/header.tpl"); ?>

<main>

<?php include_once(BASE_DIR.TEMPLATE_DIR."includes/ux.tpl"); ?>

<article>

<div class="page-title">
  <h2><?php echo htmlspecialchars($render["page"]["title"]); ?></h2>
</div>

<div class="tags">
  <?php if(!empty($render["page"]["tagcloud"]) && is_array($render["page"]["tagcloud"])): ?>
  
    <?php foreach ($render["page"]["tagcloud"] as $key => $value): ?>
      <a class="t<?php echo $value['range']; ?>" href="<?php echo BASE_URL; ?>?filter=<?php echo urlencode($value['tag']); ?>" title="<?php echo htmlspecialchars($value['title']); ?>">
        <?php echo htmlspecialchars($value['title']); ?>
      </a>
    <?php endforeach; ?>
  
  <?php else: ?>
  
    <p class="alert alert-danger text-center">
      <?php echo txt('err_no_posts'); ?>
    </p>
  
  <?php endif; ?>
</div>

</article>

</main>

<?php include_once(BASE_DIR.TEMPLATE_DIR."includes/footer.tpl"); ?>
  
 </body>
</html><?php ob_get_flush(); ?>