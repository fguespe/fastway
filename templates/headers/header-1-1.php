<?php global $header_container,$header_middle,$header_container; ?>
<div class="<?php echo esc_attr( $header_middle ); ?>">
      <div  class="<?php echo esc_attr( $header_container ); ?>">
        <nav class="navbar navbar-expand-md">
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
        ); 
        if(is_plugin_active("woocommerce")) echo fw_shoppingCart();?>
        </nav>
      </div>
      
      
</div>