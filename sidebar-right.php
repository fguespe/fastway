<?php
/**
 * The right sidebar containing the main widget area.
 *
 * @package understrap
 */


global $redux_demo;
// when both sidebars turned on reduce col size to 3 from 4.

$sidebar_pos = $redux_demo['layout-main'];
$sidebarname='right-sidebar';
if(is_shop() || is_product_category()){
	$sidebar_pos = $redux_demo['shop-layout'];
	$sidebarname='s-'.$sidebarname;
}else if(is_product()){
	$sidebar_pos = $redux_demo['product-page-layout'];
	$sidebarname='sp-'.$sidebarname;
}


?>

<?php if ( 'both' === $sidebar_pos ) : ?>
<div class="col-md-2 widget-area" id="right-sidebar" role="complementary">
	<?php else : ?>
<div class="col-md-2 widget-area" id="right-sidebar" role="complementary">
	<?php endif; ?>
<?php dynamic_sidebar( $sidebarname ); ?>

</div><!-- #secondary -->
