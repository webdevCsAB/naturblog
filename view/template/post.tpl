<?php 

// post template

?>
<?php ob_start('removeWhitespace'); ?><?php include_once(BASE_DIR.TEMPLATE_DIR."includes/html-head.tpl"); ?>
</head>
<body class="not-front page<?php echo $dark_mode; ?>page-post zoom-<?php echo $zoom; ?>">

<?php include_once(BASE_DIR.TEMPLATE_DIR."includes/header.tpl"); ?>

<main>

<?php include_once(BASE_DIR.TEMPLATE_DIR."includes/ux.tpl"); ?>

<article>

<div class="page-title">
  <h2><?php echo $render["page"]["adult"].htmlspecialchars($render["page"]["title"]); ?></h2>
</div>

<div class="meta">

<?php include_once(BASE_DIR.TEMPLATE_DIR."includes/post-meta.tpl"); ?>
<?php include_once(BASE_DIR.TEMPLATE_DIR."includes/copy_share.tpl"); ?>

</div>

<?php echo $render["page"]["content"]; ?>

<?php include_once(BASE_DIR.TEMPLATE_DIR."includes/comments.tpl"); ?>

</article>

</main>

<?php include_once(BASE_DIR.TEMPLATE_DIR."includes/footer.tpl"); ?>

<?php include_once(BASE_DIR.TEMPLATE_DIR."includes/adult-alert.tpl"); ?>
  
 </body>
</html><?php ob_get_flush(); ?>