<?php

/**
 * home_url
 */
add_shortcode('home_url', function ($atts, $content = '') {
  return esc_url(home_url($content));
});

/**
 * get_theme_file_uri
 */
add_shortcode('theme_file_uri', function ($atts, $content = '') {
  return esc_url(get_theme_file_uri($content));
});

/**
 * ボタンのショートコード
 *
 * @param array $atts ショートコードの引数
 * @param string $content ショートコードのコンテンツ
 * @return string ボタンのHTMLタグ
 * @codex https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/add_shortcode
 */
function my_shortcode($atts, $content = '')
{
  return '<div class="entry-btn"><a class="btn" href="' . $atts['link'] . '">' . $content . '</a></div>';
}
// add_shortcode('btn', 'my_shortcode');


/**
 * ストライプのショートコード
 * 引数の初期値設定
 */
function do_stripe($attr)
{
  $attr = shortcode_atts(array(
    "direction" => 'right',
    "length" => '400'
  ), $attr);

  return '<div class="stripe-' . $attr['direction'] . '" style="width: calc(' . $attr['length'] . ' / 16 * 1rem);"></div>';
}
// add_shortcode('stripe', 'do_stripe');
