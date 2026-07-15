<?php if (paginate_links()) : ?>

  <div class="p-pagination">
    <div class="p-pagination__inner">
      <?php
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $max = $wp_query->max_num_pages;

      // 最初ページ
      if ($paged > 1) {
        echo '<a class="page-numbers" href="' . esc_url(get_pagenum_link(1)) . '">&lt;&lt;</a>';
      }


      echo wp_kses_post(
        paginate_links(
          array(
            'end_size' => 1,
            'mid_size' => 1,
            'prev_next' => true,
            // 'prev_text' => '<i class="fas fa-chevron-left"></i>',
            // 'next_text' => '<i class="fas fa-chevron-right"></i>',
            'prev_text' => '&lt;',
            'next_text' => '&gt;',
          )
        )
      );

      // 最後ページ
      if ($paged < $max) {
        echo '<a class="page-numbers" href="' . esc_url(get_pagenum_link($max)) . '">&gt;&gt;</a>';
      }
      ?>
    </div>
  </div>

<?php endif; ?>