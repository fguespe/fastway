<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$classname_desktop="fw_product_loop desktop ";
if(fw_theme_mod('shop-loop-mobile-product-style')>0){
	$classname_desktop.=" d-none d-md-block ";
}
?>
<li <?php wc_product_class($classname_desktop); ?>>

		<?php do_action( 'fastway_product_loop_init', fw_theme_mod('shop-loop-product-style'),"product-loop" );?>

	<? if(fw_theme_mod('shop-loop-mobile-product-style')>0){?>
		<div class='fw_product_loop mobile d-md-none'>
			<?php do_action( 'fastway_product_loop_init', fw_theme_mod('shop-loop-mobile-product-style'),"mobile-product-looop");?>
		</div>
	<? } ?>
</li>

