<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package understrap
 */


global $redux_demo;

// when both sidebars turned on reduce col size to 3 from 4.
$sidebar_pos = $redux_demo['layout-main'];
$sidebarname='left-sidebar';
if(is_shop() || is_product_category()){
	$sidebar_pos = $redux_demo['shop-layout'];
	$sidebarname='s-'.$sidebarname;
}else if(is_product()){
	$sidebar_pos = $redux_demo['product-page-layout'];
	$sidebarname='sp-'.$sidebarname;
}

?>

<?php if ( 'both' === $sidebar_pos ) : ?>
<div class="col-md-3 widget-area" id="left-sidebar" role="complementary">
	<?php else : ?>
<div class="col-md-3 widget-area" id="left-sidebar" role="complementary">
	<?php endif; ?>
<?php dynamic_sidebar( $sidebarname ); ?>

</div><!-- #secondary -->
