<?php 
global $header_main,$header_middle_mobile,$redux_demo;
?>
<div class="<?php echo esc_attr( $header_middle_mobile ); ?>  align-items-center ">
    <div class="col-2 align-items-center">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button></div>
    <div class="col-7 align-items-center text-center"><?php echo fastway_getLogo();?></div>
		<div class="col-2 align-items-center"><?php echo fw_shoppingCart();?></div>
    <div class="col-1 align-items-center">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-search"></i></button>
      </div>
      
      <div class="collapse navbar-collapse" id="navbarsExample01">
        <nav class="navbar navbar-expand-md u-header__navbar">
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