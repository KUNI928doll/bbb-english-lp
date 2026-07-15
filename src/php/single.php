<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
  <?php get_header(); ?>
</head>

<body <?php body_class(['p-single', 'p-' . get_post_type() . 'Single']); ?>>
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
            <div class="l-container l-container--narrow p-section__content">

              <div class="p-article__header">
                <div class="p-article__meta">
                  <time datetime="<?php the_time('c'); ?>" class="p-article__date p-article__date--published c-beforeIcon c-beforeIcon--clock"><?php the_time(get_option('date_format')); ?></time>
                  <?php if (get_the_modified_time('c') !== get_the_time('c')) : ?>
                    <time datetime="<?php the_modified_time('c') ?>" class="p-article__date p-article__date--updated c-beforeIcon c-beforeIcon--updated"><?php the_modified_time(get_option('date_format')); ?></time>
                  <?php endif; ?>
                  <?php
                  $this_taxonomies = array_keys(get_the_taxonomies());
                  if (!empty($this_taxonomies)) :
                    $taxonomy_name = $this_taxonomies[0];
                    if (get_the_terms(get_the_ID(), $taxonomy_name)) :
                  ?>
                      <div class="p-article__metaTaxonomies">
                        <?php put_terms('p-article__metaLabel c-label', $taxonomy_name); ?>
                      </div>
                  <?php
                    endif;
                  endif;
                  ?>
                </div>
                <h1 class="p-article__title"><?php the_title(); ?></h1>
                <?php put_thumbnail('large'); ?>
              </div>

              <div class="p-article__body clearfix">
                <?php the_content(); ?>

                <?php
                // 改ページを有効にするための記述
                wp_link_pages(
                  array(
                    'before' => '<nav class="p-article__links">',
                    'after' => '</nav>',
                    'link_before' => '',
                    'link_after' => '',
                    'next_or_number' => 'number',
                    'separator' => '',
                  )
                );
                ?>
              </div>

              <div class="p-article__footer">
                <a href="<?php echo get_post_type_archive_link(get_post_type()); ?>" class="c-beforeIcon c-beforeIcon--arrowLeft"><?php echo esc_html(get_post_type_object(get_post_type())->label); ?>一覧に戻る</a>
                <div class="p-article__footer">
                  <div class="p-article__paginateLink p-article__paginateLink--prev">
                    <?php previous_post_link('<span>&lt;</span> %link', 'prev'); ?>
                  </div>
                  <a class="p-article__previousBtn c-previousBtn" href="<?php echo get_post_type_archive_link(get_post_type()); ?>">
                    <?php echo esc_html(get_post_type_object(get_post_type())->label); ?>一覧に戻る
                  </a>
                  <div class="p-article__paginateLink p-article__paginateLink--next">
                    <?php next_post_link('%link <span>&gt;</span>', 'next'); ?>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </article>

      </main>
    <?php endwhile; ?>
  <?php else : ?>
    <p>投稿がありません</p>
  <?php endif;  ?>

  <?php get_template_part('includes/foot'); ?>
  <?php get_footer(); ?>
</body>

</html>
