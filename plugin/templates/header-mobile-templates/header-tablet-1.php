<?php 
global $header_main,$header_middle_mobile,$redux_demo;
?>
<header id="header" class="<?php echo esc_attr( $header_main ); ?>">
<div class="<?php echo esc_attr( $header_middle_mobile ); ?> " style="padding: 0px;">
      <div class="col-6 " style="padding: 0px;" ><?php echo fastway_getLogo();?></div>
      <div class="col-4 align-items-center"><div id="mobileicons"><?php if($redux_demo['fw-quicklinks'])quicklinks();?></div></div>
      <div class="col-1 align-items-center">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
      </div>
      <div class="col-1 align-items-center">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-search"></i></button>
      </div>
      
      <div class="collapse navbar-collapse" id="navbarsExample01">
        <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar">
          <?php wp_nav_menu(
            array(
                  'theme_location'  => 'mobile',
                  'container_class' => 'navbar-collapse py-0',
                  'container_id'    => 'navBar',
                  'menu_class'      => 'navbar-nav u-header__navbar-nav ml-lg-auto',
                  'fallback_cb'     => '',
                  'menu_id'         => '',
                  'walker'          => new fw_Navwalker('mobile-1'),
                )
            ); 
            if($redux_demo['fw-quicklinks'])quicklinks();
            ?>

        </nav>
      </div>
      <div class="collapse navbar-collapse" id="navbarsExample02">
          <?php echo fw_search_form(3);?>
      </div>

     
      
</div>
</header>