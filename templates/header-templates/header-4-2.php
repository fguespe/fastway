<?php 

global $header_container,$header_main,$header_middle,$header_bottom;
?>
<header id="header" class="u-header u-header--center-aligned  <?php echo esc_attr( $header_main ); ?>">
<?php do_action( 'add_topbar');?>
<div class="u-header__section <?php echo esc_attr( $header_middle ); ?>">
    <div id="logoAndNav" class="<?php echo esc_attr( $header_container ); ?>">
      <div class="row">
        <div class="col-4">
            
        </div>
        
        <div class="col-4 form-row align-items-center" >
            <?php echo fastway_getLogo();?> 
        </div>    
        <div class="col-4 form-row align-items-center" >
          <?php echo fw_search_form(1);?> 
        </div> 
    </div>
  </div>
</div>

<!-- Nav -->
<div class="<?php echo esc_attr( $header_bottom ); ?>">
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
            'walker'          => new fw_Navwalker('desktop-1'),
          )
      ); 
      ?>
</nav>
</div>
</header>