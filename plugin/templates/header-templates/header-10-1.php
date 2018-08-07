<?php 
global $header_container,$header_main,$header_middle,$header_bottom;
?>
<div class="<?php echo esc_attr( $header_middle ); ?>">
    <div id="logoAndNav" class="<?php echo esc_attr( $header_container ); ?>">
	    <div class="row">
		  <div class="col-2">
          <?php echo fastway_getLogo();?>
			</div>
       <div class="col-1 row align-items-center">
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
      </div>
			<div class="col-6 form-row align-items-center" >
          <?php echo fw_search_form(1);?> 
        </div> 
			<div class="col-3 row align-items-center justify-content-around px-4">
          <a href="">Login</a> <span>|</span>
          <a href="">Register</a>
          <?php echo fw_shoppingCart();?>
          </table>
			</div>
	        	
        <!-- End Nav -->
      	</div>
  </div>
</div>