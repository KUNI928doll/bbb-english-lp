<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
  <?php get_header(); ?>
</head>

<body <?php body_class(['p-' . get_post_type(), 'p-' . $post->post_name . 'Page']); ?>>
  <?php wp_body_open(); ?>
  <?php get_template_part('includes/head'); ?>
  <?php get_template_part('includes/breadcrumb'); ?>
  <?php
  $args = [
    'title' => get_the_title(),
    'subTitle' => $post->post_name
  ];
  get_template_part('includes/lowerFv', null, $args);
  ?>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

      <main class="l-main">

        <article <?php post_class(array('p-article')); ?>>
          <section class="p-section">
            <div class="l-container p-section__content">

              <div class="p-article__header">
                <h1 class="p-article__title"><?php the_title(); ?></h1>
                <?php put_thumbnail('large'); ?>
              </div>

              <div class="p-article__body clearfix">
                <?php the_content(); ?>
              </div>
            </div>
          </section>
        </article>

      </main>
    <?php endwhile; ?>
  <?php endif;  ?>

  <?php get_template_part('includes/foot'); ?>
  <?php get_footer(); ?>
</body>

</html>
