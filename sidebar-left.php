<?php



$sidebar_pos = fw_theme_mod('layout-main');
$sidebarname='left-sidebar';
if(is_shop() || is_product_category()){
	$sidebar_pos = fw_theme_mod('shop-layout');
	$sidebarname='s-'.$sidebarname;
}else if(is_product()){
	$sidebar_pos = fw_theme_mod('product-page-layout');
	$sidebarname='sp-'.$sidebarname;
}

?>

<?php if ( 'both' === $sidebar_pos ) : ?>
<div class="col-md-2 widget-area" id="left-sidebar" role="complementary">
	<?php else : ?>
<div class="col-md-2 widget-area" id="left-sidebar" role="complementary">
	<?php endif; ?>
<?php dynamic_sidebar( $sidebarname ); ?>

</div><!-- #secondary -->
