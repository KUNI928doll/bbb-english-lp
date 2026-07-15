<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
  <?php get_header(); ?>
</head>

<body <?php body_class(['p-' . get_queried_object()->name . 'Archive', 'p-archive']); ?>>
  <?php wp_body_open(); ?>
  <?php get_template_part('includes/head'); ?>
  <?php
  $post_type = get_queried_object();
  $args = [
    'title' => $post_type->name,
    'subTitle' => get_the_archive_title() . '一覧'
  ];
  get_template_part('includes/lowerFv', null, $args);
  ?>


  <main class="l-main p-archive__main">

    <?php get_template_part('includes/breadcrumb'); ?>

    <div class="l-container">
      <div class="p-archive__wrap">
        <h2 class=""><?php echo esc_html(get_the_archive_title()); ?></h2>
        <?php if (have_posts()) : ?>

          <div class="p-archive__content">

            <?php while (have_posts()) : the_post(); ?>

              <article class="p-archive__item p-archiveItem">
                <a href="<?php echo the_permalink(); ?>" class="p-archiveItem__link">
                  <figure class="p-archiveItem__img"><?php put_thumbnail(); ?></figure>
                  <div class="p-archiveItem__body">
                    <time class="p-archiveItem__date" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_date(get_option('date_format')); ?></time>
                    <h2 class="p-archiveItem__title"><?php the_title(); ?></h2>
                  </div>
                </a>
              </article>

            <?php endwhile; ?>

          </div>

          <?php if (paginate_links()) : ?>
            <div class="p-archive__footer">
              <?php get_template_part('includes/pagination'); ?>
            </div>
          <?php endif; ?>

        <?php else : ?>

          <p>投稿がありません</p>
        <?php endif;  ?>
      </div>
    </div>


  </main>

  <?php get_template_part('includes/foot'); ?>
  <?php get_footer(); ?>
</body>

</html>
