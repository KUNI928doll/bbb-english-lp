<div class="p-lowerFv">
  <div class="l-container">
    <h1 class="p-lowerFV__title"><?php echo wp_kses_post($args['title']); ?></h1>
    <?php if (!empty($args['subTitle'])) : ?>
      <p class="p-lowerFv__subTitle"><?php echo (!empty($args['subTitle']) ? wp_kses_post($args['subTitle']) : ''); ?></p>
    <?php endif; ?>
  </div>
</div>