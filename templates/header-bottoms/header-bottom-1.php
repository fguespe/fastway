<?php global $header_container,$header_bottom; ?>
<div class="<?php echo esc_attr( $header_bottom ); ?>">
  <div class="<?php echo esc_attr( $header_container ); ?>">
      <?php fw_menu("primary"); ?>
      <?php fw_header_html(); ?>
  </div>
</div>

<style>
/*
.fw_header_bottom.desktop #fw-menu .navbar-nav{
		margin:0 auto;
}
.fw_header_bottom.desktop #fw-menu .navbar-nav{
  width:100% !important;
  justify-content:space-around !important;
}*/
</style>