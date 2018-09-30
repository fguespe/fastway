<?php 
add_filter ( 'woocommerce_product_thumbnails_columns', 'bbloomer_change_gallery_columns' );
 
function bbloomer_change_gallery_columns() {
     return 1; 
}
?>
<style type="text/css">


</style>
<?
global $single_desktop;
?>
<div id="product-<?php the_ID(); ?>" <?php post_class($single_desktop); ?>>
	<div class="fw_gallery">
	<?php
		/**
		 * Hook: woocommerce_before_single_product_summary.
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>
	</div>

	<div class="summary entry-summary side-detalle">
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
		<div class="compra-segura"><i class="fa fa-shield"></i> <a href="#" target="_blank">Compra segura</a>, garantía de fábrica en todo el país.</div>
		<a data-fancybox="" href="https://wp.bidcom.com.ar/cuotas-tarjetas-bancos.php?preciocontado=28149&amp;_ga=2.165564543.1796437698.1538259347-188261107.1538053526" class="fancybox btn-medios block btn-mobile t2">
		                <div class="row">
		                    <div class="col-2 text-left v-top txt-28"><i class="fa fa-credit-card"></i></div>
		                    <div class="col-10 text-left calcular-costo-envio">
		                    	<h4 class="t1">Ver cuotas y medios de pago</h4>
			                    <span class="link1 t1">Hasta 12 cuotas fijas de $ 2,347</span>
		                    </div>
		                </div>
        </a>
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