<?php

/**
 * 投稿者一覧ページを自動で生成されないようにする
 */
add_filter('author_rewrite_rules', '__return_empty_array');

/**
 * アクセスを止める
 */
// if (!is_admin()) {
// // default URL format
// if (preg_match('/\bauthor=([0-9]*)/i', $_SERVER['QUERY_STRING'])) die();
// add_filter('redirect_canonical', 'my_shapespace_check_enum', 10, 2);
// }
// function my_shapespace_check_enum($redirect, $request)
// {
// // permalink URL format
// if (preg_match('/\?author=([0-9]*)(\/*)/i', $request)) die();
// else return $redirect;
// }
/**
 * /?author=1 などでアクセスしたらリダイレクトさせる
 * @see https://www.webdesignleaves.com/pr/wp/wp_user_enumeration.html
 */
//Simple SEO でトップページにリダイレクト処理すると不要？
function disable_author_archive_query()
{
  if (preg_match('/\bauthor=([0-9]*)/i', $_SERVER['QUERY_STRING'])) {
    wp_safe_redirect(home_url());
    exit;
  }
}
add_action('init', 'disable_author_archive_query');


/**
 * WordPress REST API によるユーザー情報を隠す
 */
function my_filter_rest_endpoints($endpoints)
{
  if (isset($endpoints['/wp/v2/users'])) {
    unset($endpoints['/wp/v2/users']);
  }
  if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
    unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
  }
  return $endpoints;
}
add_filter('rest_endpoints', 'my_filter_rest_endpoints', 10, 1);



// Headタグ内から削除
remove_action('wp_head', 'wp_generator'); // WordPressのバージョン
remove_action('wp_head', 'wp_shortlink_wp_head'); // 短縮URLのlink
remove_action('wp_head', 'wlwmanifest_link'); // ブログエディターのマニフェストファイル
remove_action('wp_head', 'rsd_link'); // 外部から編集するためのAPI
remove_action('wp_head', 'feed_links_extra', 3); // フィードへのリンク
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'print_emoji_detection_script', 7); // 絵文字に関するJavaScript
remove_action('wp_head', 'rel_canonical'); // カノニカル
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_print_styles', 'print_emoji_styles'); // 絵文字に関するCSS
remove_action('admin_print_scripts', 'print_emoji_detection_script'); // 絵文字に関するJavaScript
remove_action('admin_print_styles', 'print_emoji_styles'); // 絵文字に関するCSS

// CSS, JSのバージョンを消す
function remove_cssjs_ver2($src)
{
  if (strpos($src, 'ver='))
    $src = remove_query_arg('ver', $src);
  return $src;
}
add_filter('style_loader_src', 'remove_cssjs_ver2', 9999);
add_filter('script_loader_src', 'remove_cssjs_ver2', 9999);
