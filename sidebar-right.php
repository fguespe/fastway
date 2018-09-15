<?php
/**
 * The right sidebar containing the main widget area.
 *
 * @package understrap
 */


$sidebar_pos =fw_theme_mod('layout-main');
$sidebarname='right-sidebar';
if(is_shop() || is_product_category()){
	$sidebar_pos = fw_theme_mod('shop-layout');
	$sidebarname='s-'.$sidebarname;
}else if(is_product()){
	$sidebar_pos = fw_theme_mod('product-page-layout');
	$sidebarname='sp-'.$sidebarname;
}


?>

<?php if ( 'both' === $sidebar_pos ) : ?>
<div class="col-md-3 widget-area" id="right-sidebar" role="complementary">
	<?php else : ?>
<div class="col-md-3 widget-area" id="right-sidebar" role="complementary">
	<?php endif; ?>
<?php dynamic_sidebar( $sidebarname ); ?>

</div><!-- #secondary -->
