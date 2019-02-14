<?php

$sidebar_pos =fw_theme_mod('layout-main');
$sidebarname='right-sidebar';
$ratio=2;

if(is_plugin_active("woocommerce/woocommerce.php")){
	if(is_shop() || is_product_category()){
		$sidebar_pos = fw_theme_mod('shop-layout');
		$sidebarname='s-'.$sidebarname;
	}else if(is_product()){
		$sidebar_pos = fw_theme_mod('product-page-layout');
		$sidebarname='sp-'.$sidebarname;
	}
}
if ( is_home() && ! is_front_page() ){
	$sidebar_pos = fw_theme_mod('layout-blog');
	$ratio=3;
}
?>

<?php if ( 'both' === $sidebar_pos ) : ?>
<div class="col-md-<?php echo $ratio;?> widget-area" id="right-sidebar" role="complementary">
	<?php else : ?>
<div class="col-md-<?php echo $ratio;?> widget-area" id="right-sidebar" role="complementary">
	<?php endif; ?>
<?php dynamic_sidebar( $sidebarname ); ?>

</div><!-- #secondary -->
