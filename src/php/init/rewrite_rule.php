<?php

/**
 * リライトルールの確認
 */
function check_rewrite()
{
  global $wp_rewrite;
  echo '<pre>';
  print_r($wp_rewrite->wp_rewrite_rules());
  echo '</pre>';
  exit;
}
// add_action('init', 'check_rewrite');
