<?php
/**
 * Optimize WooCommerce Scripts
 * Remove WooCommerce Generator tag, styles, and scripts from non WooCommerce pages.
 */
add_action( 'wp_enqueue_scripts', 'child_manage_woocommerce_styles', 99 );
 
function child_manage_woocommerce_styles() {
     //remove generator meta tag
     remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
     
     //first check that woo exists to prevent fatal errors
     if ( function_exists( 'is_woocommerce' ) ) {
         //dequeue scripts and styles
         if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
             wp_dequeue_style( 'woocommerce_frontend_styles' );
             wp_dequeue_style( 'woocommerce_fancybox_styles' );
             wp_dequeue_style( 'woocommerce_chosen_styles' );
             wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
             wp_dequeue_script( 'wc_price_slider' );
             wp_dequeue_script( 'wc-single-product' );
             wp_dequeue_script( 'wc-add-to-cart' );
             wp_dequeue_script( 'wc-cart-fragments' );
             wp_dequeue_script( 'wc-checkout' );
             wp_dequeue_script( 'wc-add-to-cart-variation' );
             wp_dequeue_script( 'wc-single-product' );
             wp_dequeue_script( 'wc-cart' );
             wp_dequeue_script( 'wc-chosen' );
             wp_dequeue_script( 'woocommerce' );
             wp_dequeue_script( 'prettyPhoto' );
             wp_dequeue_script( 'prettyPhoto-init' );
             wp_dequeue_script( 'jquery-blockui' );
             wp_dequeue_script( 'jquery-placeholder' );
             wp_dequeue_script( 'fancybox' );
             wp_dequeue_script( 'jqueryui' );
         }
         
     }
 
}


add_action( 'init', 'fw_otherwoo_options');
function fw_otherwoo_options(){
    

    if(fw_theme_mod("prices-enabled")){
        add_filter( 'woocommerce_get_price_html', function( $price ) {
            return '';
        } );
    }
    if(fw_theme_mod("purchases-enabled")){
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart',30 ); 
    }
    if(fw_theme_mod("sold-alone")){
        add_filter( 'woocommerce_add_to_cart_redirect', 'my_custom_add_to_cart_redirect' ); 
        add_filter( 'woocommerce_is_sold_individually', 'wc_remove_all_quantity_fields', 10, 2 );
    }
    if(!empty(fw_theme_mod("checkout-msg"))){
        error_log(fw_theme_mod("checkout-msg"));
        add_action( 'woocommerce_before_checkout_form', 'fw_before_paying_notice' );
    }

}

function wc_remove_all_quantity_fields( $return, $product ){
    return true;
}

function my_custom_add_to_cart_redirect( $url ) {
    $url = WC()->cart->get_checkout_url();
    return $url;
}

function fw_before_paying_notice() {
    
    wc_print_notice(fw_theme_mod("checkout-msg"), 'error' );
}

//Stock labels
add_filter( 'woocommerce_get_availability', 'fw_custom_get_availability', 1, 2); 

function fw_custom_get_availability( $availability, $_product ) { // Change Out of Stock Text 
    
    if ( $_product->is_in_stock() )$availability['availability'] = fw_theme_mod("in-stock-text");
    if ( !$_product->is_in_stock() )$availability['availability'] =  fw_theme_mod("out-of-stock-text");
    return $availability; 
}





/**
 * Change number of related products output
 */ 

add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
  function jk_related_products_args( $args ) {
    
    $args['posts_per_page'] = 4; // 4 related products
    $args['columns'] = 4; // arranged in 2 columns
    return $args;
}
// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
    function loop_columns() {
        return fw_theme_mod('shop_columns');
    }
}

// Change add to cart text on archives depending on product type
add_filter( 'woocommerce_product_add_to_cart_text' , 'custom_woocommerce_product_add_to_cart_text' );
add_filter( 'woocommerce_product_single_add_to_cart_text', 'custom_woocommerce_product_add_to_cart_text' );
add_filter( 'woocommerce_booking_single_add_to_cart_text', 'custom_woocommerce_product_add_to_cart_text' );
function custom_woocommerce_product_add_to_cart_text() {
    global $product;
    
    $product_type = $product->product_type;
    
    switch ( $product_type ) {
        case 'external':
            return __( fw_theme_mod('add-to-cart-text'), 'woocommerce' );
        break;
        case 'grouped':
            return __( fw_theme_mod('add-to-cart-text'), 'woocommerce' );
        break;
        case 'simple':
            return __( fw_theme_mod('add-to-cart-text'), 'woocommerce' );
        break;
        case 'variable':
            return __( fw_theme_mod('add-to-cart-text'), 'woocommerce' );
        break;
        default:
            return __( fw_theme_mod('add-to-cart-text'), 'woocommerce' );
    }
    
}
