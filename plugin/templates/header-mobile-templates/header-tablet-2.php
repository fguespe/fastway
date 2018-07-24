<?php 
global $header_main,$header_middle_mobile;
?>
<header id="header" class="u-header <?php echo esc_attr( $header_main ); ?>">
<div class="u-header__section <?php echo esc_attr( $header_middle_mobile ); ?> align-items-center">

    	<div class="col-2 align-items-center"><?php echo fw_sidebarMenu();?></div>
    	<div class="col-8 align-items-center text-center"><?php echo fastway_getLogo();?></div>
		<div class="col-2 align-items-center"><?php echo fw_shoppingCart("sidebar");?></div>

</div>
</header>

