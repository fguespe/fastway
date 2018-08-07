<?php 
global $header_container,$header_main,$header_middle;
?>
<div class="<?php echo esc_attr( $header_middle ); ?>">
      <div  class="<?php echo esc_attr( $header_container ); ?>">
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
                  'walker'          => new fw_Navwalker('desktop-1'),
                )
            ); 
            ?>
        </nav>
        <!-- End Nav -->
      </div>
</div>