<?php
add_filter( 'woocommerce_product_tabs', 'woo_new_product_taba' );
function woo_new_product_taba( $tabs ) {
    global $product;
    if (!class_exists('WC_Product_Documents_Collection'))return $tabs;
    $documents_collection = new WC_Product_Documents_Collection( $product->id );
	if ( $documents_collection->has_sections() ) {
		$tabs['descargas'] = array(
        'title'     => __( 'Descargas', 'woocommerce' ),
        'priority'  => 50,
        'callback'  => 'pestana_descargas'
        );
	}
    return $tabs;

}
function pestana_descargas() {
    echo '<table id="myTable">
<tr class="header">
<th style="width: 60%;">Producto</th>
<th style="width: 40%;">Descargas</th>
</tr>';
    echo do_shortcode('[woocommerce_product_documents]');
    echo '</table>';

    
}