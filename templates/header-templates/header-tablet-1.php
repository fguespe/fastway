<?php
global $redux_demo;
$container   = $redux_demo['header-width'];
$logo = $redux_demo['general-logo'];
$classes="d-md-none";
?>
<style type="text/css">
.header-mobile .logo img {
height:auto !important;
width:100% !important;
}
.header-mobile .logo {
height:auto !important;
width:60% !important;
}
</style>
<div class="header-mobile <?php echo esc_attr( $classes ); ?> fw_header_middle navbar">
      <?php echo fastway_getLogo();?>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarsExample01">
        <?php wp_nav_menu(
        array(
          'theme_location'  => 'mobile',
          'container_class' => '',
          'container_id'    => '',
          'menu_class'      => 'navbar-nav',
          'fallback_cb'     => '',
          'menu_id'         => 'main-menu',
          'walker'          => new understrap_WP_Bootstrap_Navwalker(),
        )
        ); 
        if($redux_demo['fw-quicklinks'])quicklinks();
        ?>
        
      </div>
</div>
