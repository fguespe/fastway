<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$classname_desktop="fw_product_loop desktop ";
$classname_desktop.=fw_theme_mod('fw_builder_pl_class');

?>

<li <?php wc_product_class($classname_desktop, $product ); ?>>
<?php woo_loop_code(); ?>
</li>