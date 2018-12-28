<?php global $header_container,$header_middle,$header_container,$header_bottom; ?>
<div class="<?php echo esc_attr( $header_middle ); ?>">
    <div  class="<?php echo esc_attr( $header_container ); ?>">
      <div  class="d-flex row justify-content-between <?php echo esc_attr( $header_container ); ?>">
          <?php echo fastway_getLogo();?>
          <?php fw_mega_menu("primary"); 
          if(is_plugin_active("woocommerce")) echo fw_shoppingCart();?>
          <?php fastway_getWidgetHeaderText();?>
      </div>
      
      </div>
</div>