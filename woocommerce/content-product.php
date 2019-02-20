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
    echo sprintf( '<div class="add-to-cart-container"><a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="%s product_type_%s single_add_to_cart_button btn  btn-block %s"> %s</a></div>',
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
    echo '<div class="meta">';
    echo do_shortcode(stripslashes(htmlspecialchars_decode($content)));
    echo '</div>';
}
add_shortcode('fw_echo', 'fw_echo');
function fw_echo($atts = [], $content = null){
    
    echo stripslashes(htmlspecialchars_decode($content));
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
<li <?php wc_product_class($classname_desktop); ?>>
<?php 

woo_loop_code();
?>
<?
/**
 * woocommerce_before_shop_loop_item hook.
 *
 * @hooked woocommerce_template_loop_product_link_open - 10
 */
//do_action( 'woocommerce_before_shop_loop_item' );

/**
 * woocommerce_before_shop_loop_item_title hook.
 *
 * @hooked woocommerce_show_product_loop_sale_flash - 10
 * @hooked woocommerce_template_loop_product_thumbnail - 10
 */
//do_action( 'woocommerce_before_shop_loop_item_title' );
    /**
     * woocommerce_shop_loop_item_title hook.
     *
     * @hooked woocommerce_template_loop_product_title - 10
     */
    //do_action( 'woocommerce_shop_loop_item_title' );

    /**
     * woocommerce_after_shop_loop_item_title hook.
     *
     * @hooked woocommerce_template_loop_rating - 5
     * @hooked woocommerce_template_loop_price - 10
     */
   // do_action( 'woocommerce_after_shop_loop_item_title' );

    /**
     * woocommerce_after_shop_loop_item hook.
     *
     * @hooked woocommerce_template_loop_product_link_close - 5
     * @hooked woocommerce_template_loop_add_to_cart - 10
     */

  //  do_action('woocommerce_after_shop_loop_item');
    ?>


</li>