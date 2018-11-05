<?php 
global $header_middle_mobile;
?>
<style type="text/css">

  .fw_header_middle.mobile i{
    font-size:24px !important;
}
.fw_header_middle.mobile.navbar{
    padding:0px;
}

  .fw_header_middle.mobile .col-3:nth-child(1){
        padding:0px
    }

</style>
<div class="<?php echo esc_attr( $header_middle_mobile ); ?>  align-items-center">
      <div class="col-3 d-flex justify-content-around">
          <button class="navbar-toggler fw-header-icon toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>



                 <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas"><i class="fa fa-bars"></i></button>
          <button class="navbar-toggler fw-header-icon search" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-search"></i></button>
          
      </div>
      <div class="col-6 text-center align-items-center"><?php echo fastway_getLogo();?></div>
      <div class="col-3 text-right align-items-center"><?php echo fw_shoppingCart();?></div>
      <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <nav class="navbar navbar-expand-md u-header__navbar">
          <?php wp_nav_menu(
            array(
                  'theme_location'  => 'mobile',
                  'container_class' => 'navbar-collapse py-0',
                  'container_id'    => 'navBar',
                  'menu_class'      => 'navbar-nav  ml-lg-auto',
                  'fallback_cb'     => '',
                  'menu_id'         => 'main-menu-mobile',
                  'depth'           => 2,
                  'walker'          => new fw_Navwalker(''),
                )
            ); 
            if(fw_theme_mod('fw-quicklinks'))quicklinks();
            ?>
            </nav>
          </div>
           <div class="collapse navbar-collapse" id="navbarsExample02">
          <?php echo fw_search_form(3);?>
        
      </div>
      <div class="collapse navbar-collapse" id="navbarsExample01">
        <nav class="navbar navbar-expand-md u-header__navbar">
          <?php wp_nav_menu(
            array(
                  'theme_location'  => 'mobile',
                  'container_class' => 'navbar-collapse py-0',
                  'container_id'    => 'navBar',
                  'menu_class'      => 'navbar-nav  ml-lg-auto',
                  'fallback_cb'     => '',
                  'menu_id'         => 'main-menu-mobile',
                  'depth'           => 2,
                  'walker'          => new fw_Navwalker(''),
                )
            ); 
            if(fw_theme_mod('fw-quicklinks'))quicklinks();
            ?>
            </nav>
          </div>
           <div class="collapse navbar-collapse" id="navbarsExample02">
          <?php echo fw_search_form(3);?>
      </div>
</div>
