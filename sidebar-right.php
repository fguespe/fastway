<?php
/**
 * The right sidebar containing the main widget area.
 *
 * @package understrap
 */

if ( ! is_active_sidebar( 'right-sidebar' ) ) {
	return;
}
global $redux_demo;
// when both sidebars turned on reduce col size to 3 from 4.

$sidebar_pos = $redux_demo['layout-main'];

?>

<?php if ( 'both' === $sidebar_pos ) : ?>
<div class="col-md-3 widget-area" id="right-sidebar" role="complementary">
	<?php else : ?>
<div class="col-md-4 widget-area" id="right-sidebar" role="complementary">
	<?php endif; ?>
<?php dynamic_sidebar( 'right-sidebar' ); ?>

</div><!-- #secondary -->
