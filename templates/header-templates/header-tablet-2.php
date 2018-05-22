<?php 
global $header_main,$header_middle_mobile;
?>
<header id="header" class="u-header <?php echo esc_attr( $header_main ); ?>">
<div class="u-header__section <?php echo esc_attr( $header_middle_mobile ); ?> ">
    <?php echo fw_sidebarMenu();?>
    <?php echo fastway_getLogo();?>
	  <?php echo fw_shoppingCart();?>
</div>
</header>

