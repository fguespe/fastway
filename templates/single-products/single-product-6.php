<?php 
add_filter ( 'woocommerce_product_thumbnails_columns', 'bbloomer_change_gallery_columns' );
 
function bbloomer_change_gallery_columns() {
     return 1; 
}

add_filter( 'woocommerce_get_price_html', 'fw_price_html', 100, 2 );
function fw_price_html( $price, $product ){
	if($product->product_type == 'variable'){
		$available_variations = $product->get_available_variations();								
		$maximumper = 0;
		for ($i = 0; $i < count($available_variations); ++$i) {
			$variation_id=$available_variations[$i]['variation_id'];
			$variable_product1= new WC_Product_Variation( $variation_id );
			$regular_price = $variable_product1 ->regular_price;
			$sale_price = $variable_product1 ->sale_price;
			$percentage= round((( ( $regular_price - $sale_price ) / $regular_price ) * 100));	
			if ($percentage > $maximumper) {
				$maximumper = $percentage;
			}
		}
		$percentage=$maximumper;
	}else{
		$regular_price=$product->regular_price;
		$sale_price=$product->sale_price;
		$percentage= round((( ( $regular_price - $sale_price ) / $regular_price ) * 100));	
	}
	if($product->is_on_sale()){
		return '<div class="precioproducto">
		    <span class="precio">$'.$sale_price.'</span>
			<div class="tachado">
				<span class="precio-anterior t1 tachado">$'.$regular_price.'</span>
				<span class="badge badge-success txt-12">'.$percentage.'% OFF</span>
			</div>
			</div>';
	}else{
		 return '<div class="precioproducto">
		    <span class="precio">$'.$regular_price.'</span>
			</div>';
	}
   
}
?>
<style type="text/css">


</style>
<?
global $single_desktop,$product;
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
			remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',20);
			remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);
			do_action( 'woocommerce_single_product_summary' );
		?>
		<div class="compra-segura"><i class="fa fa-shield"></i> <a href="#" target="_blank">Compra segura</a>, recibi el producto que esperas o te devolvemos el dinero.</div>
		<a target="_blank" href="https://www.mercadolibre.com.ar/gz/promociones-bancos" class="fancybox btn-medios block btn-mobile t2">
            <div class="row">
                <div class="col-2 text-left v-top txt-28"><i class="fa fa-credit-card"></i></div>
                <div class="col-10 text-left calcular-costo-envio">
                	<h4 class="verde">Pagá en cuotas sin interes</h4>
                    <span class="azul">(Chequear promociones vigentes)</span>
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

