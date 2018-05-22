<?php 
global $header_main,$header_middle_mobile;
?>
<header id="header" class="u-header <?php echo esc_attr( $header_main ); ?>">
<div class="u-header__section <?php echo esc_attr( $header_middle_mobile ); ?> ">
      <?php echo fastway_getLogo();?>
      <div id="mobileicons">
      <?php if($redux_demo['fw-quicklinks'])quicklinks();?>
      </div>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
      <div class="collapse navbar-collapse" id="navbarsExample01">
        <!-- Nav -->
        <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar">
          <!-- Logo -->

          <?php wp_nav_menu(
            array(
                  'theme_location'  => 'primary',
                  'container_class' => 'navbar-collapse py-0',
                  'container_id'    => 'navBar',
                  'menu_class'      => 'navbar-nav u-header__navbar-nav ml-lg-auto',
                  'fallback_cb'     => '',
                  'menu_id'         => '',
                  'walker'          => new fw_Navwalker('mobile-1'),
                )
            ); 
            ?>
        </nav>
        <!-- End Nav -->
       
        
      </div>
      
</div>
</header>