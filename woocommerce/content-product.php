<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

/*SHOP MANAGER ROLES*/
if(!function_exists('fw_loop_image')){
    add_shortcode('fw_loop_image', 'fw_loop_image');
    function fw_loop_image(){
        global $product;
        echo woocommerce_get_product_thumbnail();
    }
    add_shortcode('fw_loop_title', 'fw_loop_title');
    function fw_loop_title(){
        global $product;
        echo '<h2 class="product_title">'.$product->post->post_title.'</h2>';
    }
    add_shortcode('fw_loop_price', 'fw_loop_price');
    function fw_loop_price(){
        global $product;
        echo '<span class="price">'.fw_price_html1(null,$product).'</span>';
    }
    add_shortcode('fw_loop_cart', 'fw_loop_cart');
    function fw_loop_cart() {
        if((fw_theme_mod("fw_purchases_visibility")==="logged" && !is_user_logged_in()) || fw_theme_mod("fw_purchases_visibility")==="hide")return;
        global $product;
        echo sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="%s product_type_%s single_add_to_cart_button btn  btn-block %s">
        <i class="fas fa-spinner fa-spin" style="display:none;"></i> %s</a>',
                esc_url( $product->add_to_cart_url() ),
                esc_attr( $product->get_id() ),
                esc_attr( $product->get_sku() ),
                esc_attr( isset( $quantity ) ? $quantity : 1 ),
                $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                esc_attr( $product->get_type() ),
                $product->get_type() == 'simple' ? 'ajax_add_to_cart' : '',
                esc_html( $product->add_to_cart_text() )
            );
    }
    add_shortcode('fw_loop_meta', 'fw_loop_meta');
    function fw_loop_meta($atts = [], $content = null){
        $atts = shortcode_atts(array('type' => '' ), $atts );
        echo '<div class="meta">';
        echo do_shortcode(stripslashes(htmlspecialchars_decode($content)));
        echo '</div>';
    }


    add_shortcode('fw_loop_container', 'fw_loop_container');
    function fw_loop_container($atts = [], $content = null){
        global $product;
        echo '<a href="'.$product->get_permalink($product->id).'">';
        echo do_shortcode(stripslashes(htmlspecialchars_decode($content)));
        echo '</a>';

    }

    function woo_loop_code(){
        echo do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('woo_loop_code'))));
    }
}

$classname_desktop="fw_product_loop desktop ";

?>

<li <?php wc_product_class($classname_desktop, $product ); ?>>
<?php 
woo_loop_code();
?>
</li>