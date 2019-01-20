<?php global $header_container,$header_middle,$header_container,$header_bottom; ?>
<div class=" <?php echo esc_attr( $header_middle ); ?>">
    <div  class="<?php echo esc_attr( $header_container ); ?>">
	    <div class="row">
  		  <div class="col-3"><?php echo fastway_getLogo();?></div>
  			<div class="col-6 form-row align-items-center">
  				<?php echo fw_search_form();?> 
  			</div>
  			<div class="icons col-3 row align-items-center justify-content-center">
            <table border="collapse" style="border: grey !important;">
            <td><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="align-items-center justify-content-center"><?php echo fw_userAccount();?></td>
  		      <td><?php echo fw_shoppingCart();?></td>
            </table>
  			</div>
	    </div>
  </div>
</div>
<div class=" <?php echo esc_attr( $header_bottom ); ?>">
  <div class="<?php echo esc_attr( $header_container ); ?>">
	       <nav class="js-mega-menu  navbar-expand-md ">
          <!-- Logo -->
          <?php wp_nav_menu(
            array(
              'theme_location'  => 'primary',
              'container_class' => 'collapse navbar-collapse show align-items-center',
              'container_id'    => 'navbarNavDropdown',
              'menu_class'      => 'navbar-nav mr-auto',
              'fallback_cb'     => '',
              'menu_id'         => 'main-menu',
              'depth'           => 2,
              'walker'          => new fw_Navwalker(),
            )
          ); ?>
        </nav>
  </div>
</div>