<?php

/**
 * メジャーアップデート無効
 */
add_filter('allow_major_auto_core_updates', '__return_false');

/**
 * テーマセットアップ
 * 参考：https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/add_theme_support#HTML5
 */
add_action('after_setup_theme', function () {
  add_theme_support('post-thumbnails');
  add_theme_support('automatic-feed-links');
  add_theme_support('title-tag');
  add_theme_support('custom-logo'); // カスタムロゴを使用可能にする
  add_theme_support('wp-block-styles');  //Default block styles を有効に

  add_theme_support(
    'html5',
    array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    )
  );
});

/**
 * ブロックエディタ内のスタイル
 */
// add_action('enqueue_block_editor_assets', function () {
//   wp_enqueue_style('editor-style', get_theme_file_uri('assets/css/style-editor.css'), array(), date('YmdGis', filemtime(get_theme_file_path('assets/css/style-editor.css'))), 'all');
// });


/**
 * CSS, JavaScript
 */
add_action('wp_enqueue_scripts', function () {
  $theme_title = 'my-theme';
  /* CSS */
  // wp_enqueue_style('swiper', get_theme_file_uri('assets/css/app/swiper.min.css'), array(), '1.0.0', 'all');
  // wp_enqueue_style('googleMPlusRound', 'https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@400;700&display=swap', array(), '1.0.0', 'all');
  // wp_enqueue_style('googleNotoSerif', 'https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@200..900&display=swap', array(), '1.0.0', 'all');
  wp_enqueue_style($theme_title, get_theme_file_uri('assets/css/style.css'), array(), date('YmdGis', filemtime(get_theme_file_path('assets/css/style.css'))), 'all');
  // ページごとに読み込む場合
  // if (is_front_page() || is_home()) {
  //   if (is_file(get_theme_file_path('assets/css/top.css')) && file_exists(get_theme_file_path('assets/css/top.css'))) {
  //     wp_enqueue_style('top_css', get_theme_file_uri('assets/css/top.css'), array('common_css'), date('YmdGis', filemtime(get_theme_file_path('assets/css/top.css'))), 'all');
  //   }
  // }
  // if (is_page()) {
  //   global $post;
  //   $slugName = $post->post_name;
  // } elseif (is_archive()) {
  //   $slugName = get_queried_object()->name;
  // } elseif (is_singular()) {
  //   $slugName = get_queried_object()->post_type;
  // }
  // if (!empty($slugName)) {
  //   if (is_file(get_theme_file_path('assets/css/' . $slugName . '.css')) && file_exists(get_theme_file_path('assets/css/' . $slugName . '.css'))) {
  //     wp_enqueue_style($theme_title . $slugName, get_theme_file_uri('assets/css/' . $slugName . '.css'), array($theme_title), date('YmdGis', filemtime(get_theme_file_path('assets/css/' . $slugName . '.css'))), 'all');
  //   }
  // }

  /* JS */
  // wp_enqueue_script('swiper', get_theme_file_uri('assets/js/app/swiper-bundle.min.js'), array('jquery'), '1.0.0', true);
  wp_enqueue_script('gsap', get_theme_file_uri('assets/js/app/gsap.min.js'), array('jquery'), '1.0.0', true);
  wp_enqueue_script('scrollTrigger', get_theme_file_uri('assets/js/app/ScrollTrigger.min.js'), array('gsap'), '1.0.0', true);
  wp_enqueue_script('svgxuse', get_theme_file_uri('assets/js/app/svgxuse.min.js'), array('jquery'), '1.0.0', true);
  wp_enqueue_script('browserswitcher', get_theme_file_uri('assets/js/app/b_browser_switcher.js'), array('jquery'), '1.0.0', true);
  wp_enqueue_script($theme_title, get_theme_file_uri('assets/js/script.js'), array('jquery'), date('YmdGis', filemtime(get_theme_file_path('assets/js/script.js'))), true);
});


/**
 * GTM
 */
function add_gtm_head_tag()
{
  get_template_part('includes/gtm-head');
}
add_action('wp_head', 'add_gtm_head_tag');
function add_gtm_body_tag()
{
  get_template_part('includes/gtm-body');
}
add_action('wp_body_open', 'add_gtm_body_tag');


remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');


function remove_dashboard_widgets()
{
  global $wp_meta_boxes;
  // unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']); // 現在の状況
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']); // アクティビティ
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // 最近のコメント
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']); // 被リンク
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); // プラグイン
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']); // クイック投稿
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']); // 最近の下書き
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); // WordPressブログ
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); // WordPressフォーラム
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');
remove_action('welcome_panel', 'wp_welcome_panel');

/**
 * メニューを非表示
 */
function remove_menus()
{
  // remove_menu_page('index.php'); // ダッシュボード.
  // remove_menu_page('edit.php'); // 投稿.
  // remove_menu_page('upload.php'); // メディア.
  // remove_menu_page('edit.php?post_type=page'); // 固定.
  remove_menu_page('edit-comments.php'); // コメント.
  // remove_menu_page('themes.php'); // 外観.
  // remove_menu_page('plugins.php'); // プラグイン.
  // remove_menu_page('users.php'); // ユーザー.
  // remove_menu_page('tools.php'); // ツール.
  // remove_menu_page('options-general.php'); // 設定.
}
add_action('admin_menu', 'remove_menus', 999);

/**
 * サブメニューを非表示
 */
function remove_submenus()
{
  // remove_submenu_page('index.php', 'index.php'); // ダッシュボード / ホーム.
  // remove_submenu_page('index.php', 'update-core.php'); // ダッシュボード / 更新.

  // remove_submenu_page('edit.php', 'edit.php'); // 投稿 / 投稿一覧.
  // remove_submenu_page('edit.php', 'post-new.php'); // 投稿 / 新規追加.
  // remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category'); // 投稿 / カテゴリー.
  // remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag'); // 投稿 / タグ.

  // remove_submenu_page('upload.php', 'upload.php'); // メディア / ライブラリ.
  // remove_submenu_page('upload.php', 'media-new.php'); // メディア / 新規追加.

  // remove_submenu_page('edit.php?post_type=page', 'edit.php?post_type=page'); // 固定 / 固定ページ一覧.
  // remove_submenu_page('edit.php?post_type=page', 'post-new.php?post_type=page'); // 固定 / 新規追加.

  // remove_submenu_page('themes.php', 'themes.php'); // 外観 / テーマ.
  // remove_submenu_page('themes.php', 'customize.php?return=' . rawurlencode($_SERVER['REQUEST_URI'])); // 外観 / カスタマイズ.
  // remove_submenu_page('themes.php', 'nav-menus.php'); // 外観 / メニュー.
  // remove_submenu_page('themes.php', 'widgets.php'); // 外観 / ウィジェット.
  // remove_submenu_page('themes.php', 'theme-editor.php'); // 外観 / テーマエディタ.

  // remove_submenu_page('plugins.php', 'plugins.php'); // プラグイン / インストール済みプラグイン.
  // remove_submenu_page('plugins.php', 'plugin-install.php'); // プラグイン / 新規追加.
  // remove_submenu_page('plugins.php', 'plugin-editor.php'); // プラグイン / プラグインエディタ.

  // remove_submenu_page('users.php', 'users.php'); // ユーザー / ユーザー一覧.
  // remove_submenu_page('users.php', 'user-new.php'); // ユーザー / 新規追加.
  // remove_submenu_page('users.php', 'profile.php'); // ユーザー / あなたのプロフィール.

  // remove_submenu_page('tools.php', 'tools.php'); // ツール / 利用可能なツール.
  // remove_submenu_page('tools.php', 'import.php'); // ツール / インポート.
  // remove_submenu_page('tools.php', 'export.php'); // ツール / エクスポート.
  // remove_submenu_page('tools.php', 'site-health.php'); // ツール / サイトヘルス.
  // remove_submenu_page('tools.php', 'export_personal_data'); // ツール / 個人データのエクスポート.
  // remove_submenu_page('tools.php', 'remove_personal_data'); // ツール / 個人データの消去.

  // remove_submenu_page('options-general.php', 'options-general.php'); // 設定 / 一般.
  // remove_submenu_page('options-general.php', 'options-writing.php'); // 設定 / 投稿設定.
  // remove_submenu_page('options-general.php', 'options-reading.php'); // 設定 / 表示設定.
  // remove_submenu_page('options-general.php', 'options-discussion.php'); // 設定 / ディスカッション.
  // remove_submenu_page('options-general.php', 'options-media.php'); // 設定 / メディア.
  // remove_submenu_page('options-general.php', 'options-permalink.php'); // 設定 / メディア.
  // remove_submenu_page('options-general.php', 'privacy.php'); // 設定 / プライバシー.
}
add_action('admin_menu', 'remove_submenus', 999);

/**
 * 外観のヘッダーと背景を非表示
 */
function my_setup()
{
  remove_theme_support('custom-header');
  remove_theme_support('custom-background');
}
add_action('after_setup_theme', 'my_setup');


/**
 * 投稿編集画面のタグをチェックボックスにする
 */
// function change_tag_to_checkbox()
// {
//   $args = get_taxonomy('post_tag');
//   $args->hierarchical = true; // Gutenberg用
//   $args->meta_box_cb = 'post_categories_meta_box'; // クラシックエディタ用
//   register_taxonomy('post_tag', 'post', $args);
// }
// add_action('init', 'change_tag_to_checkbox', 1);

/**
 * カスタムタクソノミーをチェックボックスで選択できるようにする
 */
// function change_term_to_checkbox() {
// 	$taxonomy_slug = 'product_label';
// 	$post_type_slug = 'faq';
//   $args = get_taxonomy($taxonomy_slug);//★カスタムタクソノミー名
//   $args -> hierarchical = true;//Gutenberg用
//   $args -> meta_box_cb = 'post_categories_meta_box';//Classicエディタ用
//   register_taxonomy( $taxonomy_slug, $post_type_slug, $args);//★カスタムタクソノミー名、カスタム投稿タイプ名
// }
// add_action( 'init', 'change_term_to_checkbox', 999 );

/**
 * 抜粋
 */
add_filter('excerpt_more', function ($more) {
  return '...';
});
add_filter('excerpt_mblength', function () {
  // 抜粋を80文字に制限
  return 80;
});

/**
 * メニュー
 */
// add_action('init', function () {
//   register_nav_menus(array(
//     'global' => 'ヘッダーメニュー',
//     'drawer' => 'ドロワーメニュー',
//     'footer' => 'フッターメニュー'
//   ));
// });

/**
 * ウィジェットの登録
 *
 * @codex http://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/register_sidebar
 */
// function my_widget_init()
// {
//   register_sidebar(
//     array(
//       'name' => 'サイドバー', // 表示するエリア名
//       'id' => 'sidebar', // id
//       'before_widget' => '<div id="%1$s" class="widget %2$s">',
//       'after_widget' => '</div>',
//       'before_title' => '<div class="widget-title">',
//       'after_title' => '</div>'
//     )
//   );
// }
// add_action('widgets_init', 'my_widget_init');




/* the_archive_title 余計な文字を削除 */
add_filter('get_the_archive_title', function ($title) {
  if (is_category()) {
    $title = single_cat_title('', false);
  } elseif (is_tag()) {
    $title = single_tag_title('', false);
  } elseif (is_tax()) {
    $title = single_term_title('', false);
  } elseif (is_author()) { // 作者アーカイブの場合
    $title = get_the_author();
  } elseif (is_post_type_archive()) {
    $title = post_type_archive_title('', false);
  } elseif (is_date()) {
    $title = get_the_time(get_option('date_format'));
  } elseif (is_search()) {
    $title = '検索結果：' . esc_html(get_search_query(false));
  } elseif (is_404()) {
    $title = '「404」ページが見つかりません';
  } else {
  }
  return $title;
});


/**
 * 投稿の個別ページのみパーマリンクを変更
 * @see https://yuki.world/wordpress-post-permalink-customize/
 *
 * @param string $permalink
 * @return string
 */
function add_article_post_permalink($permalink)
{
  $permalink = '/news' . $permalink;
  return $permalink;
}
// add_filter('pre_post_link', 'add_article_post_permalink');

function add_article_post_rewrite_rules($post_rewrite)
{
  $return_rule = array();
  foreach ($post_rewrite as $regex => $rewrite) {
    $return_rule['news/' . $regex] = $rewrite;
  }
  return $return_rule;
}
// add_filter('post_rewrite_rules', 'add_article_post_rewrite_rules');


// // ※検索機能がないサイトでは有効化推奨
// //検索結果ページ「/?s=keyword」のリクエストがあったら404ページを表示する
// function free_keyword_search_function_invalidation($query, $error = true)
// {
//   if (is_search()) {
//     $query->is_search = false;
//     $query->query_vars['s'] = false;
//     $query->query['s'] = false;
//     if ($error == true)
//       $query->is_404 = true;
//   }
// }
// add_action('parse_query', 'free_keyword_search_function_invalidation');