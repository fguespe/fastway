<?php

$sidebarname='left-sidebar';
$ratio=2;

if(is_plugin_active("woocommerce/woocommerce.php")){
	if(is_shop() || is_product_category()){
		$sidebarname='s-'.$sidebarname;
		$ratio=fw_theme_mod("sidebar-ratio");
	}else if(is_product()){
		$sidebarname='sp-'.$sidebarname;
		$ratio=fw_theme_mod("sidebar-ratio");
	}
}
if ( is_home() && ! is_front_page() ){
	$ratio=3;
}

?>
<div class="col-md-<?php echo $ratio;?> widget-area" id="left-sidebar" role="complementary">
	<?php dynamic_sidebar( $sidebarname ); ?>
</div>