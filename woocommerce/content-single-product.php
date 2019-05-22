<?php




if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function woo_single(){
    return do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('woo_single_code'))));
}


do_action( 'woocommerce_before_single_product' );

global $product;
if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

?>

<!-- EL de bidcom -->
<?php

woo_single();

?>

<script>
//Fix fancybox
jQuery( document ).ready(function( $ ) {
   $.fancybox.defaults.hash = false;
});
</script>

