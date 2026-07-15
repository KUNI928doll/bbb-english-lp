<meta charset="<?php bloginfo('charset'); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,shrink-to-fit=yes">
<meta name="format-detection" content="telephone=no">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<?php if (is_404() || is_page('confirm') || is_page('thanks')) : ?>
  <meta name="robots" content="noindex, nofollow">
<?php elseif (is_single() || is_page()) : ?>
  <?php if (get_post_meta($post->ID, "noindex", true)) : ?>
    <meta name="robots" content="noindex, nofollow" />
  <?php endif; ?>
<?php endif; ?>
<?php wp_head(); ?>