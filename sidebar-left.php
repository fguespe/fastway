<?php



$sidebar_pos = fw_theme_mod('layout-main');
$sidebarname='left-sidebar';
$ratio=2;
if(is_shop() || is_product_category()){
	$sidebar_pos = fw_theme_mod('shop-layout');
	$sidebarname='s-'.$sidebarname;
	$ratio=fw_theme_mod("sidebar-ratio");
}else if(is_product()){
	$sidebar_pos = fw_theme_mod('product-page-layout');
	$sidebarname='sp-'.$sidebarname;
	$ratio=fw_theme_mod("sidebar-ratio");
}

?>
<div class="col-md-<? echo $ratio;?> widget-area" id="left-sidebar" role="complementary">
	<?php dynamic_sidebar( $sidebarname ); ?>
</div>