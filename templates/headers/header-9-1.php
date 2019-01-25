<?php global $header_container,$header_middle,$header_container,$header_bottom; ?>
<div class=" <?php echo esc_attr( $header_middle ); ?>">
    <div  class="<?php echo esc_attr( $header_container ); ?>">
	    <div class="row">
  		  <div class="col-3"><?php echo fw_logo();?></div>
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

          <?php echo fw_menu("primary"); ?>
        </nav>
  </div>
</div>