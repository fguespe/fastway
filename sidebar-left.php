<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package understrap
 */

if ( ! is_active_sidebar( 'left-sidebar' ) ) {
	return;
}

global $redux_demo;

// when both sidebars turned on reduce col size to 3 from 4.
$sidebar_pos = $redux_demo['layout-main'];
if(is_shop())$sidebar_pos = $redux_demo['shop-layout'];
$sidebarname='left-sidebar';
if(is_shop()){
	$sidebar_pos = $redux_demo['shop-layout'];
	$sidebarname='s-'.$sidebarname;
}


?>

<?php if ( 'both' === $sidebar_pos ) : ?>
<div class="col-md-3 widget-area" id="left-sidebar" role="complementary">
	<?php else : ?>
<div class="col-md-4 widget-area" id="left-sidebar" role="complementary">
	<?php endif; ?>
<?php dynamic_sidebar( $sidebarname ); ?>

</div><!-- #secondary -->
