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
if(fw_checkPlugin("woocommerce/woocommerce.php")){
if(is_shop() || is_product_category())$sidebar_pos = $redux_demo['shop-layout'];
else if(is_product())$sidebar_pos = $redux_demo['product-page-layout'];
}

?>

<?php if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

  <?php get_sidebar( 'right' ); ?>

<?php endif; ?>
