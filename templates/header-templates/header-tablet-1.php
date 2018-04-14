<?php
global $redux_demo;
$container   = $redux_demo['header-width'];
$logo = $redux_demo['general-logo'];
$sticky="";
if($redux_demo['sticky-menu'])$sticky="sticky-top";
$classes=$container." ".$sticky;
?>
<style type="text/css">
.fw_header_middle_mobile .logo img{
height:50px !important;
width:auto !important;
}
</style>
<header class="fw_header_middle_mobile d-md-none navbar">
      <?php echo fastway_getLogo();?>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarsExample01">
        <?php wp_nav_menu(
        array(
          'theme_location'  => 'primary',
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
    </header>
