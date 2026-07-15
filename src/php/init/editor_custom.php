<?php
add_action('after_setup_theme', function () {
  /**
   * @see https://www.webdesignleaves.com/pr/wp/wp_blockeditor_styles.html#h4_index_5
   */
  // add_theme_support('align-wide');  // 画像メディアに全幅オプション追加
  // add_theme_support('responsive-embeds');  // YouTube などのメディアのコンテンツをレスポンシブ対応

  // テーマの独自のカラーパレットを設定 スタイルを定義必要
  // add_theme_support('editor-color-palette', array(
  //   array(
  //     'name' => '深い緑',
  //     'slug' => 'dark-green',
  //     'color' => '#0A4D17',
  //   ),
  //   array(
  //     'name' => '明るい緑',
  //     'slug' => 'bright-green',
  //     'color' => '#3DBF38',
  //   ),
  //   array(
  //     'name' => 'とても薄い灰色',
  //     'slug' => 'very-light-gray',
  //     'color' => '#eee',
  //   ),
  //   array(
  //     'name' => 'とても暗い灰色',
  //     'slug' => 'very-dark-gray',
  //     'color' => '#444',
  //   ),
  // ));

  // add_theme_support('disable-custom-colors');  // カラーピッカー（カスタムカラー）を無効化
  // テーマの独自のフォントサイズを設定
  // add_theme_support('editor-font-sizes', array(
  //   array(
  //     'name' => '極小',
  //     'size' => 10,
  //     'slug' => 'x-small'
  //   ),
  //   array(
  //     'name' => '小',
  //     'size' => 13,
  //     'slug' => 'small'
  //   ),
  //   array(
  //     'name' => '標準',
  //     'size' => 16,
  //     'slug' => 'regular'
  //   ),
  //   array(
  //     'name' => '大',
  //     'size' => 24,
  //     'slug' => 'large'
  //   ),
  //   array(
  //     'name' => '特大',
  //     'size' => 36,
  //     'slug' => 'x-large'
  //   ),
  //   array(
  //     'name' => '超特大',
  //     'size' => 50,
  //     'slug' => 'huge'
  //   )
  // ));
  // add_theme_support('disable-custom-font-sizes');  // カスタムフォントサイズ（数値で直接指定するサイズ）の設定を無効
});


// add_action('wp_enqueue_scripts', function () {
//   wp_register_style('my-block-style', get_theme_file_uri('assets/css/my-block-style.css'), '', '1.0.0');
// });
// register_block_style(
//   'core/paragraph',  // wp-includes/blocks/{block-name}/block.jsonから確認
//   array(
//     'name'  => 'box-pink', // is-style-{name} でスタイルを書く
//     'label' => 'ボックス（ピンク）',
//     'style_handle' => 'my-block-style',
//     // 'inline_style' => '.is-style-box-pink{
//     // 	background: #ffc0cb;
//     // 	border: 1px solid #ff00ff;
//     // 	padding: 1em;
//     // }',
//   )
// );
// register_block_style(
//   'core/button',  // wp-includes/blocks/{block-name}/block.jsonから確認
//   array(
//     'name'  => 'large',
//     'label' => '大きいボタン',
//     'style_handle' => 'my-block-style',
//   )
// );
