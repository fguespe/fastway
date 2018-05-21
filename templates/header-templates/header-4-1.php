<?php 
global $header_container,$header_main,$header_middle;
?>
<header id="header" class="u-header u-header--center-aligned  <?php echo esc_attr( $header_main ); ?>">
<?php do_action( 'add_topbar');?>
<div class="u-header__section <?php echo esc_attr( $header_middle ); ?>">
  <div id="logoAndNav" class="<?php echo esc_attr( $header_container ); ?>">
      <div class="u-header__hide-content">
      <div class="u-header--center-aligned__inner u-header--center-aligned-md__inner">
        <?php echo fastway_getLogo();?>
      </div>
      </div>
    <!-- Nav -->
        <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar">
          <!-- Logo -->
          <?php wp_nav_menu(
            array(
                  'theme_location'  => 'primary',
                  'container_class' => 'navbar-collapse py-0',
                  'container_id'    => 'navBar',
                  'menu_class'      => 'navbar-nav u-header__navbar-nav mx-lg-auto',
                  'fallback_cb'     => '',
                  'menu_id'         => '',
                  'walker'          => new understrap_WP_Bootstrap_Navwalker(),
                )
            ); 
            ?>
        </nav>
        <!-- End Nav -->
  </div>
</div>
</header>