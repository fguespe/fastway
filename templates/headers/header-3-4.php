<?php global $header_container,$header_middle,$header_container; ?>
<div class="<?php echo esc_attr( $header_middle ); ?>">
      <div  class="<?php echo esc_attr( $header_container ); ?>">
        <!-- Nav -->
        <nav class="js-mega-menu navbar navbar-expand-md ">
          <!-- Logo -->
          <?php echo fastway_getLogo();?>
          <?php wp_nav_menu(
            array(
                  'theme_location'  => 'primary',
                  'container_class' => 'navbar-collapse py-0',
                  'container_id'    => 'navBar',
                  'menu_class'      => 'navbar-nav ',
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