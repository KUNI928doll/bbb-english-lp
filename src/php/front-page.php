<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
  <?php get_header(); ?>
</head>

<body <?php body_class(['p-topPage', 'fadeIn']); ?>>
  <?php wp_body_open(); ?>
  <?php get_template_part('includes/loading'); ?>
  <?php get_template_part('includes/head'); ?>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

      <div class="p-fv"></div>

      <main class="l-main"></main>


    <?php endwhile; ?>
  <?php else : ?>

    <p>投稿がありません</p>
  <?php endif;  ?>

  <?php get_template_part('includes/foot'); ?>
  <?php get_footer(); ?>
</body>

</html>
