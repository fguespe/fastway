<?php 
global $header_container,$header_main,$header_middle,$header_bottom;
?>
<header id="header" class="u-header <?php echo esc_attr( $header_main ); ?>">
<?php do_action( 'add_topbar');?>
<div class="u-header__section <?php echo esc_attr( $header_middle ); ?>">
    <div id="logoAndNav" class="<?php echo esc_attr( $header_container ); ?>">
	    <div class="row">
		    <div class="col-3"><?php echo fastway_getLogo();?> 
			</div>
			<div class="col-6 form-row align-items-center">
				<?php echo fw_search_form();?> 
			</div>
			<div class="icons col-3 row align-items-center justify-content-center">
          <table border="collapse" style="border: grey !important;">
          <td><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="align-items-center justify-content-center"><i class="fa fa-user"></i><span class="ingresar"> INGRESAR</span></a></td>
		      <td><?php echo fw_shoppingCart();?></td>
          </table>
			</div>
	        	
        <!-- End Nav -->
      	</div>
  </div>
</div>
<div class="fw_header_bottom <?php echo esc_attr( $header_bottom ); ?>">
  <div class="<?php echo esc_attr( $header_container ); ?>">
	       <nav class="js-mega-menu  navbar-expand-md u-header__navbar">
          <!-- Logo -->
          <?php wp_nav_menu(
            array(
                  'theme_location'  => 'primary',
                  'container_class' => 'navbar-collapse py-0',
                  'container_id'    => 'navBar',
                  'menu_class'      => 'navbar-nav u-header__navbar-nav',
                  'fallback_cb'     => '',
                  'menu_id'         => '',
                  'walker'          => new fw_Navwalker('desktop-1'),
                )
            ); 
            ?>
        </nav>
  </div>
</div>
</header>