<?php
/**
 * Left sidebar check.
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

<?php if ( 'left' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>
	<?php get_sidebar( 'left' ); ?>
<?php endif; ?>

<?php 
	$html = '';
	if ( 'right' === $sidebar_pos || 'left' === $sidebar_pos ) {
		$html = '<div class="';
		if ( is_active_sidebar( 'right-sidebar' ) || is_active_sidebar( 'left-sidebar' ) ) {
			$html .= 'col-md-10 content-area" id="primary">';
		} else {
			$html .= 'col-md-12 content-area" id="primary">';
		}
		echo $html; // WPCS: XSS OK.
	} elseif ( 'both' === $sidebar_pos ) {
		$html = '<div class="';
		if ( 'both' === $sidebar_pos ) {
			$html .= 'col-md-8 content-area" id="primary">';
		} else {
			$html .= 'col-md-12 content-area" id="primary">';
		}
		echo $html; // WPCS: XSS OK.
	} else {
	    echo '<div class="col-md-12 content-area" id="primary">';
	}

