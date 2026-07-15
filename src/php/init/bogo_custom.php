<?php
//bogo 国旗アイコンを削除
add_filter('bogo_use_flags', 'bogo_use_flags_false');
function bogo_use_flags_false()
{
  return false;
}


//Bogoを使ってカスタム投稿タイプを多言語化
function my_localizable_post_types($localizable)
{
  $args = array(
    'public'   => true,
    '_builtin' => false
  );
  $custom_post_types = array_values(get_post_types($args, 'names', 'and'));
  return array_merge($localizable, $custom_post_types);
}
add_filter('bogo_localizable_post_types', 'my_localizable_post_types', 10, 1);

/**
 * language_switcher
 */

function my_language_switcher($args = '')
{
  $args = wp_parse_args($args, array(
    'echo' => false,
  ));

  // 並び替えるための言語コード順序　左から表示させたい順
  $order = ['ja', 'en_US'];

  $links = bogo_language_switcher_links($args);
  $total = count($links);
  $count = 0;


  // 並び替え
  usort($links, function ($a, $b) use ($order) {
    return array_search($a['locale'], $order) - array_search($b['locale'], $order);
  });


  $output = '';

  foreach ($links as $link) {
    $count += 1;
    $class = array();
    $class[] = bogo_language_tag($link['locale']);
    $class[] = bogo_lang_slug($link['locale']);

    if (get_locale() === $link['locale']) {
      $class[] = 'current';
    }

    if (1 == $count) {
      $class[] = 'first';
    }

    if ($total == $count) {
      $class[] = 'last';
    }

    $class = implode(' ', array_unique($class));

    $label = $link['native_name'] ? $link['native_name'] : $link['title'];
    $title = $link['title'];

    if (empty($link['href'])) {
      $li = esc_html($label);
    } else {
      $atts = array(
        'rel' => 'alternate',
        'hreflang' => $link['lang'],
        'href' => esc_url($link['href']),
        'title' => $title,
      );

      if (get_locale() === $link['locale']) {
        $atts += array(
          'class' => 'current',
          'aria-current' => 'page',
        );
      }

      $li = sprintf(
        '<a %1$s>%2$s</a>',
        bogo_format_atts($atts),
        esc_html($label)
      );
    }

    $li = sprintf(
      '<span class="bogo-language-name">%s</span>',
      $li
    );

    if (apply_filters('bogo_use_flags', true)) {
      $country_code = bogo_get_country_code($link['locale']);

      $flag = sprintf(
        '<span class="bogoflags bogoflags-%s"></span>',
        $country_code ? strtolower($country_code) : 'zz'
      );

      $li = sprintf('<li class="%1$s">%3$s %2$s</li>', $class, $li, $flag);
    } else {
      $li = sprintf('<li class="%1$s">%2$s</li>', $class, $li);
    }

    $output .= $li . "\n";
  }

  $output = sprintf(
    '<ul class="bogo-language-switcher list-view">%s</ul>',
    $output
  );

  $output = apply_filters('my_language_switcher', $output, $args);

  if ($args['echo']) {
    echo $output;
  } else {
    return $output;
  }
}
// ショートコードを変更
remove_shortcode('bogo', 'bogo_language_switcher'); // 元のショートコード削除
add_shortcode('bogo', 'my_language_switcher'); // 新しい関数をショートコードに登録


function overwrite_language_switcher($output)
{
  $output = str_replace("日本語", "ja", $output);
  $output = str_replace("English", "en", $output);
  return $output;
}
add_filter('my_language_switcher', 'overwrite_language_switcher', 10, 1);



// 「Custom Field Suite」と「Duplicate Post」を併用したときのバグ解消
function update_customfield($post_id, $post)
{
  $types = get_post_types(array('public'  => true, '_builtin' => false));
  if (!in_array($post->post_type, $types) || $post->post_status == 'auto-draft')
    return;
  $field_data = CFS()->get(false, $post_id, array('format' => 'raw'));
  if (is_array($field_data)) {
    foreach ($field_data as $key => $value) {
      delete_post_meta($post_id, $key);
    }
  }
  $post_data = array('ID' => $post_id);
  CFS()->save($field_data, $post_data);
  return;
}
add_action('save_post', 'update_customfield', 10, 2);
