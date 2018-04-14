<?php

global $redux_demo;
$container   = $redux_demo['header-width'];
$logo = $redux_demo['general-logo'];
$sticky="";
if($redux_demo['sticky-menu'])$sticky="sticky-top";
$classes=$container." ".$sticky;
?>
<div class="<?php echo esc_attr( $classes ); ?> d-none d-md-block">
<header class="fw_header_middle blog-header py-3 ">
    <div class="row flex-nowrap">
      <div class="col-4 ">
        <?php echo fastway_getLogo();?>
      </div>
      <div class="d-flex col-8 align-items-center">
      <?php 
      if($redux_demo['header-headerwidget-switch']){
      echo do_shortcode(stripslashes(htmlspecialchars_decode( $redux_demo['header-headerwidget-text'].'<style>'.$redux_demo['css_editor-header-headerwidget'].'</style>' )));
      }
      ?>
      </div>
    </div>
</header>

<div id="main-nav" class="row flex-nowrap">
  <?php wp_nav_menu(
  array(
        'theme_location'  => 'primary',
        'container_class' => 'container d-flex flex-column flex-md-row justify-content-between',
        'container_id'    => '',
        'menu_class'      => 'nav d-flex  container d-flex flex-column flex-md-row justify-content-between',
        'fallback_cb'     => '',
        'menu_id'         => 'main-menu',
        'walker'          => new understrap_WP_Bootstrap_Navwalker(),
      )
  ); 
  ?>
</div>
</div>
<style type="text/css">

</style>

      