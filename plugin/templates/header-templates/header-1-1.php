<?php 
global $header_container,$header_main,$header_middle;
?>
<header id="header" class="u-header <?php echo esc_attr( $header_main ); ?>">
<?php do_action( 'add_topbar');?>
<div class="u-header__section <?php echo esc_attr( $header_middle ); ?>">
  
      <div id="logoAndNav" class="<?php echo esc_attr( $header_container ); ?>">
        <!-- Nav -->
        <nav class="navbar navbar-expand-md u-header__navbar">
          <!-- Logo -->
          <?php echo fastway_getLogo();?>
          <?php wp_nav_menu(
          array(
            'theme_location'  => 'primary',
            'container_class' => 'collapse navbar-collapse show align-items-center',
            'container_id'    => 'navbarNavDropdown',
            'menu_class'      => 'navbar-nav ml-auto',
            'fallback_cb'     => '',
            'menu_id'         => 'main-menu',
            'depth'           => 2,
            'walker'          => new fw_Navwalker(),
          )
        ); ?>
        </nav>
        <!-- End Nav -->
      </div>
</div>
</header>