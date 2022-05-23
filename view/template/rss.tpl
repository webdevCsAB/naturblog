<?php 

// RSS FEED (Atom) template

?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<?php echo '<?xml-stylesheet type="text/xsl" href="'.BASE_URL.VIEW_DIR.'css/rss.xsl"?>'; ?>
<?php ob_start('removeWhitespace'); ?><rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
<title><?php echo $render["page"]["title"]; ?> | <?php echo BLOG_NAME; ?></title>
<link><?php echo BASE_URL; ?>?utm_source=RSS&amp;utm_medium=feed&amp;utm_content=channellink&amp;utm_campaign=RSS</link>
<description><?php echo $render["page"]["desc"]; ?></description>
<language><?php echo BASE_LANG; ?></language>
<copyright>Copyright <?php echo date("Y").", ".BLOG_NAME; ?></copyright>
<managingEditor>noreply@<?php echo SITE_DOMAIN; ?> (<?php echo BLOG_NAME; ?>)</managingEditor>
<webMaster>noreply@<?php echo SITE_DOMAIN; ?> (<?php echo BLOG_NAME; ?>)</webMaster>
<atom:link href="<?php echo BASE_URL; ?>rss" rel="self" type="application/rss+xml" />
<pubDate><?php echo date("r"); ?></pubDate>
<category><?php echo $render["page"]["keywords"]; ?></category>
<generator>text editor</generator>
<ttl>45</ttl>
<image>
  <link><?php echo BASE_URL; ?>?utm_source=RSS&amp;utm_medium=feed&amp;utm_content=channellink&amp;utm_campaign=RSS</link>
  <title><?php echo $render["page"]["title"]; ?> | <?php echo BLOG_NAME; ?></title>
  <url><?php echo BASE_URL; ?>apple-touch-icon.png</url>
  <description><?php echo $render["page"]["desc"]; ?></description>
  <width>144</width>
  <height>144</height>
</image>

<?php if(!empty($allPostData)): ?>

<?php foreach($allPostData as $key=>$value): ?>
<item>
<title><?php echo strip_tags($value["adult"]).htmlspecialchars($value["title"]); ?></title>
<link><?php echo BASE_URL; ?>posts/<?php echo $value["slug"]; ?>?utm_source=RSS&amp;utm_medium=feed&amp;utm_content=itemlink&amp;utm_campaign=RSS</link>
<guid><?php echo BASE_URL; ?>posts/<?php echo $value["slug"]; ?>?utm_source=RSS&amp;utm_medium=feed&amp;utm_content=itemlink&amp;utm_campaign=RSS</guid>
<description><![CDATA[ 

<p>

<b>
<?php if($value['adult']): ?>
  <span style="color:red;"><?php echo txt('txt_adult_content'); ?></span>
  &bull;
<?php endif; ?>

<?php echo txt("txt_reading_time"); ?>: <?php echo $value["reading"]; ?>.
</b>

<?php
// limited content display
$c = strip_tags($value["content"]);
$clen = strlen($c)*0.25;
if($clen > 500) {
  $clen = 500;
}
?>

<?php echo textShorter($c, $clen); ?>

</p>

]]></description>
<author>noreply@<?php echo SITE_DOMAIN; ?> (<?php echo AUTHOR_NICK; ?>)</author>
<pubDate><?php echo date("r", $value["created"]); ?></pubDate>
</item>
<?php endforeach; ?>

<?php endif; ?>

</channel>
</rss><?php ob_get_flush(); ?>