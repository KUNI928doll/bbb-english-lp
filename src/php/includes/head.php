<?php
$logo_tag = ((is_home() || is_front_page()) ? 'h1' : 'div');
?>

<header id="header" class="l-header js-header">
  <div class="p-header">
    <div class="l-container">
      <div class="p-header__inner">
        <?php if (has_custom_logo()) : ?>
          <<?php echo $logo_tag; ?> class="p-header__logo"><?php the_custom_logo(); ?></<?php echo $logo_tag; ?>>
        <?php else : ?>
          <<?php echo $logo_tag; ?> class="p-header__logo"><a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_url(get_theme_file_uri('assets/img/common/logo.png')); ?>" alt="<?php bloginfo('name'); ?>"></a></<?php echo $logo_tag; ?>>
        <?php endif; ?>
        <?php
        /**
         * カスタムメニューを使用する場合は以下のコメントを外す
         * 使用しない場合は独自にメニューを作成する
         */
        // wp_nav_menu(
        //   array(
        //     'depth' => 2,
        //     'theme_location' => 'global',
        //     'container' => 'nav',
        //     'container_class' => 'p-header__nav drawer-content for-drawer',
        //     'menu_class' => 'p-header__nav',
        //     'add_li_class' => 'p-header__navItem',
        //     'add_a_class' => 'p-header__navLink',
        //   )
        // );
        ?>

        <div class="p-header__drawer p-drawer">
          <button class="p-drawer__icon js-drawer for-drawer" type="button" data-target="for-drawer" aria-controls="drawer-content1" aria-expanded="false" role="button">
            <span class="p-drawer__bars">
              <span class="p-drawer__bar"></span>
              <span class="p-drawer__bar"></span>
              <span class="p-drawer__bar"></span>
            </span>
          </button>
          <div class="p-drawer__bg for-drawer js-drawer" data-target="for-drawer" aria-controls="drawer-content1" role="button"></div>
          <div id="drawer-content1" class="p-drawer__content for-drawer" aria-hidden="true">
            <div class="p-drawer__inner">
              <?php
              /**
               * カスタムメニューを使用する場合は以下のコメントを外す
               * 使用しない場合は独自にメニューを作成する
               */
              // wp_nav_menu(
              //   array(
              //     'depth' => 2,
              //     'theme_location' => 'drawer',
              //     'container' => false,
              //     'menu_class' => 'p-drawer__navList',
              //     'add_li_class' => 'p-drawer__navItem',
              //     'add_a_class' => 'p-drawer__navLink',
              //   )
              // );
              ?>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</header>