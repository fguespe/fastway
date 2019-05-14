<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}


$classname_desktop="fw_product_loop desktop ";

?>

<li <?php wc_product_class($classname_desktop, $product ); ?>>
<?php 
woo_loop_code();
?>
</li>