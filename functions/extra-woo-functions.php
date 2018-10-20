<?php

// Function to add subscribe text to posts and pages
function pngcheckout_short() {
    $active1="";
    $active2="";
    $active3="";
    $devuelvo="";
    if(is_cart()){
        $active1="active";
    }else if( is_checkout() && !is_order_received_page() ) {

        $active2="active";
        $devuelvo .='<div class="logocheckout"><img src="'.fw_theme_mod('general-logo').'"/></div>';
    
    }else if( is_checkout() && is_order_received_page() ) {
        
        $active3="active";   
        
    }
    $devuelvo.='<ul class="pasoscheckout">
              <li class="'.$active1.'"><a>MI COMPRA</a></li>
              <li class="'.$active2.'"><a>PAGO Y ENVÍO</a></li>
              <li class="'.$active3.'"><a>TERMINAR</a></li>
            </ul>';

    echo $devuelvo;

}
if(fw_theme_mod("cart-steps")){
add_action('woocommerce_before_cart', 'pngcheckout_short');   
add_action('woocommerce_before_checkout_form', 'pngcheckout_short');  
}

if(fw_theme_mod("checkout-minimal")){
add_action( 'wp_head', 'add_chkstl_to_head' );
}

function add_chkstl_to_head() {
    echo "<style>.woocommerce-checkout:not(.woocommerce-order-received) header,.woocommerce-checkout:not(.woocommerce-order-received) footer{
    display:none !important;
}</style>";
}


//Aplicar precio global
add_action( 'woocommerce_product_data_panels', 'fw_global_variation_price' );
function fw_global_variation_price() {
    global $woocommerce;
    ?>
        <script type="text/javascript">
            function addVariationLinks() {
                a = jQuery( '<br><a href="#">Aplicar a todas las variaciones</a>' );
                b = jQuery( 'input[name^="variable_regular_price"]' );
                a.click( function( c ) {
                    d = jQuery( this ).parent( 'label' ).next( 'input[name^="variable_regular_price"]' ).val();
                    e = confirm( "Desea aplicar $" + d + " a todas las variaciones?" );
                    if ( e ) b.val( d ).trigger( 'change' );
                    c.preventDefault();
                } );
                b.prev( 'label' ).append( " " ).append( a );
            }
            function addVariationLinksale() {
                z = jQuery( '<br><a href="#">Aplicar a todas las ofertas</a>' );
                y = jQuery( 'input[name^="variable_sale_price["]' );
                z.click( function( x ) {
                    w = jQuery( this ).parent( 'label' ).next( 'input[name^="variable_sale_price["]' ).val();
                    v = confirm( "Desea aplicar $" + w + " a todas las ofertas?" );
                    if ( v ) y.val( w ).trigger( 'change' );
                    x.preventDefault();
                } );
                y.prev( 'label' ).append( " " ).append( z );
            }
            <?php if ( version_compare( $woocommerce->version, '2.4', '>=' ) ) : ?>
                jQuery( document ).ready( function() {
                    jQuery( document ).ajaxComplete( function( event, request, settings ) {
                        if ( settings.data.lastIndexOf( "action=woocommerce_load_variations", 0 ) === 0 ) {
                            addVariationLinks();addVariationLinksale();
                        }
                    } );
                } );
            <?php else: ?>
                addVariationLinks();addVariationLinksale();
            <?php endif; ?>
        </script>
    <?php
}


function fw_price_html1( $price, $product ){
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

    //if($product->is_on_sale()){
  
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
$my_theme = wp_get_theme();
if($my_theme!="lombok-child")
    add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Optimize WooCommerce Scripts
 * Remove WooCommerce Generator tag, styles, and scripts from non WooCommerce pages.
 */
add_action( 'wp_enqueue_scripts', 'child_manage_woocommerce_styles', 100 );

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

            wp_enqueue_style( 'woocommerce-layout' );

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
    //error_log(fw_theme_mod("related_columns"));
    $args['posts_per_page'] = 4;//fw_theme_mod("related_columns"); // 4 related products
    $args['columns'] = 4;//fw_theme_mod("related_columns"); // arranged in 2 columns
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
