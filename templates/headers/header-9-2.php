<?php global $header_container,$header_middle,$header_container,$header_bottom; ?>
<div class=" <?php echo esc_attr( $header_middle ); ?>">
    <div  class="<?php echo esc_attr( $header_container ); ?>">
	    <div class="row d-flex justify-content-between">
  		  <div class="logo"><?php echo fastway_getLogo();?></div>
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
        <a class="mudamos" href="">
            <i class="fa fa-map-marker"></i>
            <strong>NOS MUDAMOS</strong>
            <span>Sarmiento 2608 </span>
          </a>
      </div>
  </div>
        
</div>