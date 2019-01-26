<?php global $header_container,$header_middle,$header_container,$header_bottom; ?>
<div class="<?php echo esc_attr( $header_middle ); ?>">
    <div  class="<?php echo esc_attr( $header_container ); ?>">
      <div class="row">
      <div class="col-2 d-flex align-items-center">
          <?php echo fw_logo();?>
      </div>
      
      <div class="col-5 form-row align-items-center" >
          <?php echo fw_search_form(1);?> 
        </div> 
      <div class="d-flex col-4 align-items-center header-text">
        <?php echo fw_header_html();?>
      </div>
      <div class="col-1 row align-items-center justify-content-end px-4">
          <?php echo fw_shoppingCart();?>
      </div>
            
        <!-- End Nav -->
        </div>
  </div>
</div>
<div class="<?php echo esc_attr( $header_bottom ); ?>">
  <div class="<?php echo esc_attr( $header_container ); ?>">
         <nav class="js-mega-menu  navbar-expand-md">
          <!-- Logo -->
          <?php echo fw_menu("primary"); ?>
        </nav>
  </div>
</div>