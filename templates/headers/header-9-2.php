<?php global $header_container,$header_middle,$header_container,$header_bottom; ?>
<div class=" <?php echo esc_attr( $header_middle ); ?>">
    <div  class="<?php echo esc_attr( $header_container ); ?>">
	    <div class="row d-flex justify-content-between">
  		  <div class=""><?php echo fastway_getLogo();?></div>
  			<div class="form-row align-items-center">
          
  				<?php fastway_getWidgetHeaderText();?>
  			</div>
	    </div>
  </div>
</div>
<div class="fw_header_bottom <?php echo esc_attr( $header_bottom ); ?> ">
  <div class="<?php echo esc_attr( $header_container ); ?> ">
      <div class="row d-flex justify-content-between">
	       <nav class="js-mega-menu  navbar-expand-md u-header__navbar">
          <?php wp_nav_menu(
            array(
                  'theme_location'  => 'primary',
                  'container_class' => 'navbar-collapse py-0',
                  'container_id'    => 'navBar',
                  'menu_class'      => 'navbar-nav',
                  'fallback_cb'     => '',
                  'menu_id'         => '',
                  'walker'          => new fw_Navwalker('desktop-1'),
                )
            ); 
            ?>
        </nav>
        <a class="mudamos" href="">
            <i class="fa fa-map-marker"></i>
            <strong>NOS MUDAMOS</strong>
            <span>Sarmiento 2608 </span>
          </a>
      </div>
  </div>
        
</div>