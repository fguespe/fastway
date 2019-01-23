<?php global $header_container,$header_middle; ?>
<div class="<?php echo esc_attr( $header_middle ); ?>">
    <div  class="<?php echo esc_attr( $header_container ); ?>">
	    <div class="row">
            <div class="col-3 d-flex align-items-center">
                <?php echo fastway_getLogo();?>
            </div>
            <div class="col-9 form-row align-items-center" >
                <?php fw_header_html();?>
            </div>
      	</div>
    </div>
</div>