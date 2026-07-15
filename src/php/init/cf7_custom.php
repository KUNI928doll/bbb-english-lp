<?php
/**
 * Contact Form 7 のフィールドに動的に値を設定する
 */
function dynamic_field_values($tag, $unused)
{
  if (is_admin()) {
    return $tag;
  }
  if (($tag['name'] == 'property_post_id') || ($tag['name'] == 'property_post_title') || ($tag['name'] == 'property_post_permalink') || ($tag['name'] == 'postId')) { // Contact Form 7内に記入するフィールド名（独自のフォームタグ名）

    if ($tag['name'] == 'property_post_id') {
      // $tag['value'] = get_the_ID();
      // $tag['raw_values'][] =  get_the_ID();
      $tag['values'][] =  get_the_ID();
      // $tag['labels'][] =  get_the_ID();
    } elseif ($tag['name'] == 'property_post_title') {
      // $tag['value'] = get_the_title();
      // $tag['raw_values'][] =  get_the_title();
      $tag['values'][] =  get_the_title();
      // $tag['labels'][] =  get_the_title();
    } elseif ($tag['name'] == 'property_post_permalink') {
      // $tag['value'] = get_the_permalink();
      // $tag['raw_values'][] =  get_the_permalink();
      $tag['values'][] =  get_the_permalink();
      // $tag['labels'][] =  get_the_permalink();
    } elseif ($tag['name'] == 'postId') {
      $tag['values'][] =  get_the_ID();
    }
  }

  return $tag;
}
// add_filter('wpcf7_form_tag', 'dynamic_field_values', 30, 2);

// Contact Form 7の自動pタグ無効
add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');
function wpcf7_autop_return_false()
{
  return false;
}

// Contact Form 7のオートコンプリート（自動補完機能）を無効化
add_filter('wpcf7_form_autocomplete', function ($autocomplete) {
  $autocomplete = 'off';
  return $autocomplete;
}, 10, 1);


/**
 * contact form 7 でメール送信完了時のメッセージを消す
 */
// function disable_success_message_cf7($output, $class, $content, $instance, $status){
//   if($status == 'mail_sent') $output = '';
//   return $output;
// }
// add_filter('wpcf7_messages', 'disable_success_message_cf7');
// add_filter('wpcf7_form_response_output', 'disable_success_message_cf7', 10, 5);


/**
 * ContactForm7 サンクスページへのリダイレクト
 */
// add_action('wp_footer', 'redirect_thanks_page');
function redirect_thanks_page()
{
  $contact = 'contact';
  $thanks = 'thanks';
  if (is_page($contact)) {
?>

    <script>
      document.addEventListener('wpcf7mailsent', function(event) {
        location = '<?php echo home_url($contact . '/' . $thanks); ?>';
      }, false);
    </script>

<?php
  }
}



/**
 * メール送信時のみサンクスページへ
 */
add_action('init', function () {
  if (!session_id()) {
    session_start();
  }
});

add_action('wpcf7_mail_sent', function ($contact_form) {
  $_SESSION['form_sent'] = true;
});


add_action('template_redirect', function () {
  if (is_page('thanks')) {
    if (empty($_SESSION['form_sent'])) {
      wp_redirect(home_url()); // トップページなどにリダイレクト
      exit;
    }
    unset($_SESSION['form_sent']); // 確認後セッションを削除
  }
});
