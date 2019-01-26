<?php global $header_middle_mobile,$header_bottom_mobile; 
$antdesp=explode("bottom_init",fw_header_html_mobile());
$middleh=$antdesp[0];
$afterh=$antdesp[1];
?>
<div class="<?php echo esc_attr( $header_middle_mobile ); ?>">
	      <div class=" d-flex row align-items-center codes" style="width:100%;">
            <?php echo $middleh; ?>
      	</div>
    </div>
</div>
<div class="<?php echo esc_attr( $header_bottom_mobile ); ?>">
        <div class="d-flex row align-items-center codes" style="width:100%;">
            <?php echo $afterh; ?>
      	</div>
  </div>
</div>
