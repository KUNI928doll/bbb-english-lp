<?php

/**
 * titleタグの上書き
 */
function overwrite_ssp_title($ssp_title)
{
  if (is_page('book')) {
    // 特定のページでのみ、特別な設定で書き換えたい場合
    $ssp_title = "Your title";
  }
  // 特定のページ以外はそのまま出力
  return $ssp_title;
}
// add_filter('ssp_output_title', 'overwrite_ssp_title');


/**
 * robotsタグの上書き
 */
function overwrite_ssp_robots($ssp_robots)
{
  if (is_page('book')) {
    $ssp_robots = "Your robots";
  }
  return $ssp_robots;
}
// add_filter('ssp_output_robots', 'overwrite_ssp_robots');


/**
 * ディスクリプションの上書き
 */
function overwrite_ssp_description($ssp_description)
{
  if (is_post_type_archive('property')) {
    $ssp_description = '';
  }
  return $ssp_description;
}
// add_filter('ssp_output_description', 'overwrite_ssp_description');

/**
 * ディスクリプションの文字数を変更
 */
function overwrite_ssp_description_word_count($length)
{
  if (is_page('book')) {
    $length = 30;
  }
  return $length;
}
// add_filter('ssp_description_word_count', 'overwrite_ssp_description_word_count');

/**
 * keywordsタグの上書き
 */
function overwrite_ssp_keyword($ssp_keyword)
{
  if (is_page('book')) {
    $ssp_keyword = "Your keyword";
  }
  return $ssp_keyword;
}
// add_filter('ssp_output_keyword', 'overwrite_ssp_keyword');

/**
 * canonicalタグの上書き
 */
function overwrite_ssp_canonical($ssp_canonical)
{
  if (is_page('book')) {
    $ssp_canonical = "https://your-canonical.com";
  }
  return $ssp_canonical;
}
// add_filter('ssp_output_canonical', 'overwrite_ssp_canonical');


// その他フック
// ssp_output_og_title
// ssp_output_og_description
// ssp_output_og_url
// ssp_output_og_locale
// ssp_output_og_type
// ssp_output_og_site_name（Ver. 2.0.0 以降）
// ssp_output_og_image （Ver. 2.0.0 以降）
// ssp_output_tw_site
// ssp_output_tw_card
// ssp_output_fb_appid
// ssp_output_fb_admins
// ssp_output_fb_publisher
