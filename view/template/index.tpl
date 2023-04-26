<?php 

// index template

?>
<?php ob_start('removeWhitespace'); ?><?php include_once(BASE_DIR.TEMPLATE_DIR."includes/html-head.tpl"); ?>
</head>
<body class="front page<?php echo $dark_mode; ?>home-page zoom-<?php echo $zoom; ?>">

<?php include_once(BASE_DIR.TEMPLATE_DIR."includes/header.tpl"); ?>

<main>

<?php include_once(BASE_DIR.TEMPLATE_DIR."includes/ux.tpl"); ?>

<article>

<div class="page-title">
  <h2 class="txuc"><?php if($render["page"]["filter"]): ?><?php echo txt('txt_filtered'); ?> <?php endif; ?><?php echo txt('txt_posts'); ?></h2>
</div>

<div class="meta">

  <div<?php if($render["page"]["filter"]): ?> class="filtered"<?php endif; ?>>

<?php if($render["page"]["filter"]): ?>
  <?php echo txt('txt_search'); ?>: <b class="blink"><a href="<?php echo BASE_URL; ?>?filter=<?php echo htmlspecialchars($render["page"]["filter"]); ?>"><?php echo htmlspecialchars(str_replace("-", " ", mb_strtoupper($render["page"]["filter"]))); ?></a></b>  
  <a href="<?php echo BASE_URL; ?>" class="btn" title="<?php echo txt('ttl_button_remove_filter'); ?>">×&nbsp;<?php echo txt('lbl_button_remove_filter'); ?></a>
<?php else: ?>
    &nbsp;
<?php endif; ?>

  </div>

<?php include_once(BASE_DIR.TEMPLATE_DIR."includes/copy_share.tpl"); ?>

</div>

<?php if(empty($render["page"]["post_items"])): ?>

<p class="alert alert-danger text-center">
<?php echo txt('err_no_posts'); ?>
</p>

<?php else: ?>

<?php foreach($render["page"]["post_items"] as $value): ?>

<div class="post">
  <h2 class="hyphens-auto"><a href="<?php echo BASE_URL; ?>posts/<?php echo $value['slug']; ?>" title="<?php echo htmlspecialchars($value['title']); ?>"><?php echo fixWidowWord($value['adult'].htmlspecialchars($value['title'])); ?></a></h2>

  <p>
  <?php echo relativeTime($value["created"]); ?> &bull;
  <?php /**
  <?php echo date('Y-m-d H:i', $value["created"]); ?> &bull;
  **/ ?>
  
  <b><?php echo htmlspecialchars(AUTHOR_NICK); ?></b> &bull;
  <?php echo txt("txt_reading_time"); ?>: <?php echo $value["reading"]; ?>
  
<?php if($value['adult']): ?>
  &bull;
  <span class="cred"><?php echo txt('txt_adult_content'); ?></span>
<?php endif; ?>
  
  </p>

</div>

<?php endforeach; ?>

<?php endif; ?>


</article>

<?php include_once(BASE_DIR.TEMPLATE_DIR."includes/paginator.tpl"); ?>

</main>

<?php include_once(BASE_DIR.TEMPLATE_DIR."includes/footer.tpl"); ?>
  
 </body>
</html><?php ob_get_flush(); ?>