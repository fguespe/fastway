<?php 
global $header_middle;
?>
<div class="u-header__section <?php echo esc_attr( $header_middle ); ?>">
      <div  class="container">
        <!-- Nav -->
        <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar">
          <!-- Logo -->
          <?php echo fastway_getLogo();?>
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
