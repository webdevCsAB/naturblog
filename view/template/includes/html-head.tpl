<?php 

// html head

?>
<!DOCTYPE html>
<html lang="<?php echo BASE_LANG; ?>" dir="<?php echo TEXT_DIRECTION; ?>">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $adultContent.htmlspecialchars($render["page"]["title"]); ?> | <?php echo BLOG_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL.VIEW_DIR; ?>css/main.min.css">

    <?php if($adultContent): ?>
      <meta name="age_hu" content="18">
      <meta name="RATING" content="RTA-5042-1996-1400-1577-RTA">
      <meta name="rating" content="mature">
    <?php endif; ?>
