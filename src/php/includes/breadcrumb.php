<div class="p-breadcrumb<?php echo esc_attr(!empty($args['addClass']) ? ' ' . $args['addClass'] : ''); ?>">
  <div class="p-breadcrumb__inner l-container">
    <?php if (function_exists('bcn_display')) {
      bcn_display();
    } ?>
  </div>
</div>
