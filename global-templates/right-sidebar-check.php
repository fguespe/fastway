<?php
/**
 * Right sidebar check.
 *
 * @package understrap
 */
?>

<?php 
global $redux_demo;

// when both sidebars turned on reduce col size to 3 from 4.
$sidebar_pos = $redux_demo['layout-main'];
$shop_pos = $redux_demo['shop-layout'];
echo $shop_pos;
?>

<?php if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

  <?php get_sidebar( 'right' ); ?>

<?php endif; ?>
