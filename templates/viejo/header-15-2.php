<?php global $header_container,$header_middle,$header_container,$header_bottom; ?>
<div class="<?php echo esc_attr( $header_middle ); ?>">
    <div  class="<?php echo esc_attr( $header_container ); ?>">
	    <div class="row">
		  <div class="col-3 d-flex align-items-center">
          <?php echo fw_logo();?>
			</div>
      
			<div class="col-4 form-row align-items-center" >
          <?php echo fw_search_form(1);?> 
        </div> 
      <div class="d-flex col-5 align-items-center header-text"><?php echo fw_header_html();?></div>
			
	        	
        <!-- End Nav -->
      	</div>
  </div>
</div>
<div class="<?php echo esc_attr( $header_bottom ); ?>">
  <div class="<?php echo esc_attr( $header_container ); ?> justify-content-end">
         <nav class="row navbar-expand-md">
          <!-- Logo -->

          <?php echo fw_menu("primary"); ?>
            <div class="col-1 row align-items-center">
              <?php echo fw_shoppingCart();?>
            </div>
            <div class="col-1 row align-items-center">
              <?php echo fw_userAccount();?>
            </div>
        </nav>
        
  </div>
</div>