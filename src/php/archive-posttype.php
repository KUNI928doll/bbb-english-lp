<?php
$this_term_id = 0;
if (is_category() || is_tag() || is_tax()) {
  // タクソノミーアーカイブ
  $this_term_id = get_queried_object_id();
}

$post_type = get_queried_object();
$args = [
  'title' => $post_type->name,
  'subTitle' => $post_type->label . '一覧'
];
get_template_part('includes/lowerFv', null, $args);
