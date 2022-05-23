<?php 

// error404 template

?>
<?php ob_start('removeWhitespace'); ?><?php include_once(BASE_DIR.TEMPLATE_DIR."includes/html-head.tpl"); ?>
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">    
</head>
<body class="not-front page<?php echo $dark_mode; ?>page-<?php echo slugify($render["page"]["title"]); ?> zoom-<?php echo $zoom; ?>">

<?php include_once(BASE_DIR.TEMPLATE_DIR."includes/header.tpl"); ?>

<main>

<?php include_once(BASE_DIR.TEMPLATE_DIR."includes/ux.tpl"); ?>

<article class="text-center">

<div class="page-title">
  <h2><?php echo txt('err_error404_title'); ?></h2>
</div>

<img src="https://picsum.photos/id/237/800/320.jpg" alt="Watch dog">

<p>
<strong>ERROR 404:</strong> <?php echo txt('err_error404_message'); ?>
</p>

<br>

<p>
<code><small>HTTP 404 - Not Found</small></code> 
</p>

</article>

</main>

<?php include_once(BASE_DIR.TEMPLATE_DIR."includes/footer.tpl"); ?>
  
 </body>
</html><?php ob_get_flush(); ?>