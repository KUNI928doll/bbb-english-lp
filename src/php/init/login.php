<?php
// ログイン画面のカスタマイズ
function custom_login_style()
{ ?>
  <style>
    /* ここにスタイルを記述 */
    body.login {
      background: #f0f0f1 url(<?php echo get_theme_file_uri('/assets/img/common/login-bg.jpg') ?>) no-repeat center center / cover;
    }

    body.login::before {
      content: '';
      position: absolute;
      inset: 0;
      z-index: -1;
      background-color: rgba(255, 255, 255, .6);
    }

    #login h1 a {
      width: 300px;
      height: auto;
      aspect-ratio: 1000/158;
      background-repeat: no-repeat;
      background-size: contain;
      background-position: center;
      background-image: url(<?php echo get_theme_file_uri('/assets/img/common/logo.png'); ?>);
    }


    /* フォームのテキスト */
    /*     body.login label {
      color: #fff;
      font-size: 14px;
    }
 */
    /* フォームのボタン */
    /*     body.login .submit input#wp-submit {
      background: #0091D8;
      border: solid 1px #0091D8;
      text-shadow: none;
    }
 */
    /* フォームのリンク */
    /*     body.login #backtoblog a,
    body.login #nav a {
      color: #fff;
    }
 */
    /* フォームのリンク */
    /*     body.login a,
    body.login #backtoblog a {
      color: #73EBEA;
    }
 */
    /*     .login #backtoblog a:hover,
    .login #nav a:hover,
    .login h1 a:hover {
      color: #0091D8;
      text-decoration: underline;
    }
 */
    /*     .login #backtoblog a:focus,
    .login #nav a:focus,
    .login h1 a:focus {
      color: #0091D8
    }
 */
    /* フォームのエラーメッセージ */
    /*     body.login #login_error,
    body.login .message,
    body.login .success {
      border-left: 4px solid #E67676;
      padding: 12px;
      margin-left: 0;
      margin-bottom: 20px;
      color: #E67676;
      background: rgba(10, 10, 10, .6);
      box-shadow: 0 1px 3px rgba(0, 0, 0, 1);
    }
 */
  </style>
<?php }
// add_action('login_enqueue_scripts', 'custom_login_style');
