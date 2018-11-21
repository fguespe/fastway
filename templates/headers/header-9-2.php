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
<div class=" <?php echo esc_attr( $header_bottom ); ?> ">
  <div class="<?php echo esc_attr( $header_container ); ?> ">
      <div class="row d-flex justify-content-between">
	       <?php fw_mega_menu("primary"); ?>
        <a class="mudamos" href="">
            <i class="fa fa-map-marker"></i>
            <strong>NOS MUDAMOS</strong>
            <span>Sarmiento 2608 </span>
          </a>
      </div>
  </div>
        
</div>