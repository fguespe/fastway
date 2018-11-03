<?php global $header_container,$header_middle,$header_container,$header_bottom; ?>
<div class="<?php echo esc_attr( $header_middle ); ?>">
    <div  class="<?php echo esc_attr( $header_container ); ?>">
	    <div class="row">
		  <div class="col-3 d-flex align-items-center">
          <?php echo fastway_getLogo();?>
			</div>
      
			<div class="col-4 form-row align-items-center" >
          <?php echo fw_search_form(1);?> 
        </div> 
      <div class="d-flex col-5 align-items-center header-text"><?php fastway_getWidgetHeaderText();?></div>
			
	        	
        <!-- End Nav -->
      	</div>
  </div>
</div>
<div class="<?php echo esc_attr( $header_bottom ); ?>">
  <div class="<?php echo esc_attr( $header_container ); ?>">
         <nav class="js-mega-menu  navbar-expand-md">
          <!-- Logo -->
          <?php wp_nav_menu(
            array(
                  'theme_location'  => 'primary',
                  'container_class' => 'collapse navbar-collapse show align-items-center',
                  'container_id'    => 'navbarNavDropdown',
                  'menu_class'      => 'navbar-nav ',
                  'fallback_cb'     => '',
                  'menu_id'         => 'main-menu',
                  'depth'           => 2,
                  'cart'           => true,
                  'user'           => true,
                  'walker'          => new fw_Navwalker(''),
                )
            ); 
            ?>
            <div class="col-1 row align-items-center justify-content-end px-4">
              <?php echo fw_shoppingCart();?>
            </div>
        </nav>
        
  </div>
</div>