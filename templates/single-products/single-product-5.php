<?php 
add_filter ( 'woocommerce_product_thumbnails_columns', 'bbloomer_change_gallery_columns' );
 
function bbloomer_change_gallery_columns() {
     return 1; 
}
?>
<style type="text/css">
@media (min-width: 799px) {
		.single-product div.product .woocommerce-product-gallery .flex-viewport {
    width: 80%;
    float: right;
}

.single-product div.product .woocommerce-product-gallery li{
width:100% !important;
}
.single-product div.product .woocommerce-product-gallery .flex-control-thumbs {
    width: 20%;
    float: right;
display:block !important;
}

.single-product div.product .woocommerce-product-gallery .flex-control-thumbs li img {
    width: 90%;
    float: none;
    margin: 0 0 10% 10%;
}

.woocommerce #content div.product div.images, .woocommerce div.product div.images, .woocommerce-page #content div.product div.images, .woocommerce-page div.product div.images{
width:65%;

}
.woocommerce #content div.product div.summary, .woocommerce div.product div.summary, .woocommerce-page #content div.product div.summary, .woocommerce-page div.product div.summary{
width:30%;
}.summary{
text-align:right;
font-weight: 300 !important;
}
.woocommerce-page div.product .flex-viewport img,.woocommerce-product-gallery__wrapper div{
margin:0px !important;
height:500px;
width:auto !important;

}
.flex-viewport{
overflow: auto !important;
}

}


</style>
<?
global $single_desktop;
?>
<div id="product-<?php the_ID(); ?>" <?php post_class($single_desktop); ?>>

	<?php
		/**
		 * Hook: woocommerce_before_single_product_summary.
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">
		<?php
			/**
			 * Hook: Woocommerce_single_product_summary.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 * @hooked WC_Structured_Data::generate_product_data() - 60
			 */
			do_action( 'woocommerce_single_product_summary' );
		?>
	</div>

	<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>