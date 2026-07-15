<?php

/** 現在ページのパーマリンクを取得する
 * ループ外で使用可能
 */
function get_current_link()
{
  return (is_ssl() ? 'https' : 'http') . '://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
}

/**
 * サムネイル画像を取得
 */
function put_thumbnail($size = 'large', $alt = '', $default_img = 'noimg.jpg')
{
  if (has_post_thumbnail()) {
    the_post_thumbnail($size);
  } else {
    echo '<img src="' . esc_url(get_theme_file_uri('assets/img/' . $default_img)) . '" alt="' . esc_attr($alt) . '">';
  }
}

/**
 * アイキャッチ画像の取得
 */
function get_thumbnail_src($size = 'large', $default_img = 'noimg.jpg')
{
  if (has_post_thumbnail()) {
    $id = get_post_thumbnail_id();
    $img_src = wp_get_attachment_image_src($id, $size);
  } else {
    $img_src = array(get_theme_file_uri('assets/img/' . $default_img));
  }

  return $img_src;
}

/**
 * アイキャッチ画像のソースとalt属性を取得する
 */
function get_thumbnail_data($size = 'large', $default_img = 'noimg.jpg', $default_alt = 'イメージがありません')
{
  $ret = array(
    'img_src' => get_theme_file_uri('assets/img/' . $default_img),
    'alt' => $default_alt
  );

  if (has_post_thumbnail()) {
    $id = get_post_thumbnail_id();
    $img_src = wp_get_attachment_image_src($id, $size)[0];
    $alt = get_post_meta($id, '_wp_attachment_image_alt', true);

    $ret['img_src'] = $img_src;
    $ret['alt'] = $alt;
  }

  return $ret;
}



/**
 * 検索結果から固定ページを除外する
 */
// function my_posts_search($search, $wp_query)
// {
//   //検索結果ページ・メインクエリ・管理画面以外の3つの条件が揃った場合
//   if ($wp_query->is_search() && $wp_query->is_main_query() && !is_admin()) {
//     // 検索結果を投稿タイプに絞る
//     $search .= " AND post_type = 'post' ";
//   }
//   return $search;
// }
// add_filter('posts_search', 'my_posts_search', 10, 2);

/**
 * 文字数制限
 */
function limit_text($text, $max_length = 25)
{
  if (mb_strlen($text) > $max_length) {
    $text = mb_substr($text, 0, $max_length) . '…';
  }
  return $text;
}


function is_mobile()
{
  $useragents = array(
    'iPhone', // iPhone
    'iPod', // iPod touch
    '^(?=.*Android)(?=.*Mobile)', // 1.5+ Android
    'dream', // Pre 1.5 Android
    'CUPCAKE', // 1.5+ Android
    'blackberry9500', // Storm
    'blackberry9530', // Storm
    'blackberry9520', // Storm v2
    'blackberry9550', // Storm v2
    'blackberry9800', // Torch
    'webOS', // Palm Pre Experimental
    'incognito', // Other iPhone browser
    'webmate' // Other iPhone browser
  );
  $pattern = '/' . implode('|', $useragents) . '/i';
  return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}


/**
 * single.phpで前後記事のタイトルとリンクを取得し、タイトル文字数制限する
 * @see https://thewppress.com/libraries/set-max-title-length-of-the-previous-and-next-post-link/
 */
function twpp_adjacent_post_link($previous = true, $max_length = 10, $trim_marker = '...')
{
  $html = '';
  $post = get_adjacent_post(false, '', $previous);

  if (!empty($post)) {
    $title = apply_filters('the_title', $post->post_title);

    if (mb_strlen($title) > $max_length) {
      $title = mb_substr($title, 0, $max_length) . $trim_marker;
    }

    $html .= sprintf(
      '<a href="%s">%s</a>',
      esc_url(get_permalink($post->ID)),
      $title
    );

    echo $html;
  }
}


/**
 * 全ての親ページをobjectで取得
 * @see https://illbenet.jp/view/wordpress-get_parent_posts
 */
function get_parent_posts($post_id)
{
  $post = get_post($post_id);
  if (empty($post_id) or $post->post_parent == '0') {
    return false;
  }
  while ($post_id) {
    $post = get_post($post->post_parent);
    $result[] = $post;
    $post_id = $post->post_parent;
  }
  $result = array_reverse($result);
  return $result;
}
