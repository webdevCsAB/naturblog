<?php 

// sitemap template

?>
<?php ob_start('removeWhitespace'); ?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<?php echo '<?xml-stylesheet type="text/xsl" href="'.BASE_URL.VIEW_DIR.'css/sitemap.xsl"?>'; ?>

<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<url>
  <loc><?php echo BASE_URL; ?></loc>
  <changefreq>daily</changefreq>
  <lastmod><?php echo date('c', $lastItem); ?></lastmod>
  <priority>1.0</priority>
</url>
<?php if(!empty($allPostData)): ?>
<?php foreach($allPostData as $key=>$value): ?>
<url>
  <loc><?php echo BASE_URL; ?>posts/<?php echo $value["slug"]; ?></loc>
  <changefreq>weekly</changefreq>
  <lastmod><?php echo date("c", $value["created"]); ?></lastmod>
  <priority>0.9</priority>
</url>
<?php endforeach; ?>
<?php endif; ?>
</urlset><?php ob_get_flush(); ?>