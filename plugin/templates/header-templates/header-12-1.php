<?php global $header_container,$header_middle,$header_container,$header_bottom; ?>
<div class=" <?php echo esc_attr( $header_middle ); ?>">
    <div  class="<?php echo esc_attr( $header_container ); ?>">
	    <div class="row">
		    <div class="col-3"><?php echo fastway_getLogo();?> 
			</div>
			<div class="col-6 form-row align-items-center">
				<?php echo fw_search_form(1);?> 
			</div>
			<div class="col-3 row align-items-center justify-content-center">
          <?php echo fw_shoppingCart();?>
			</div>
	        	
        <!-- End Nav -->
      	</div>
  </div>
</div>
<div id="main-nav" class="row <?php echo esc_attr( $header_bottom ); ?>">
  <?php wp_nav_menu(
  array(
        'theme_location'  => 'primary',
        'container_class' => 'container d-flex flex-column flex-md-row justify-content-between',
        'container_id'    => '',
        'menu_class'      => 'nav d-flex  container d-flex flex-column flex-md-row justify-content-between',
        'fallback_cb'     => '',
        'menu_id'         => 'main-menu',
        'walker'          => new fw_Navwalker(),
      )
  ); 
  ?>
</div>