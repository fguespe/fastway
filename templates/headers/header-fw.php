<?php global $header_container,$header_middle,$header_bottom; 
$antdesp=explode("bottom_init",fw_header_html());
$middleh=$antdesp[0];
$afterh=$antdesp[1];
?>
<div class="<?php echo esc_attr( $header_middle ); ?>">
    <div  class="<?php echo esc_attr( $header_container ); ?>">
	      <div class=" d-flex row align-items-center codes">
            <?php echo $middleh; ?>
      	</div>
    </div>
</div>
<div class="<?php echo esc_attr( $header_bottom ); ?>">
  <div class="<?php echo esc_attr( $header_container ); ?>">
        <div class="d-flex row align-items-center codes">
            <?php echo $afterh; ?>
      	</div>
  </div>
</div>

<style>
/*
centrar menu
.fw_header.bottom.desktop #fw-menu .navbar-nav{
		margin:0 auto;
}
centrar logo o cualquier otro
.logo{
margin:0 auto !important;
}


#fw-menu{
		width:100% !important;
}
.fw_header.bottom.desktop #fw-menu .navbar-nav{
  width:100% !important;
  justify-content:space-around !important;
}

*/
</style>