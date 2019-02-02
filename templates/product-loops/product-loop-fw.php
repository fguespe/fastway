<?php 
global $product;
if(!function_exists('fw_loop_image')){
    add_shortcode('fw_loop_image', 'fw_loop_image');
    function fw_loop_image(){
        global $product;
        return woocommerce_get_product_thumbnail();
    }
    add_shortcode('fw_loop_title', 'fw_loop_title');
    function fw_loop_title(){
        global $product;
        return '<h2 class="product_title">'.$product->post->post_title.'</h2>';
    }
    add_shortcode('fw_loop_price', 'fw_loop_price');
    function fw_loop_price(){
        global $product;
        return '<span class="price">'.fw_price_html1(null,$product).'</span>';
    }
    add_shortcode('fw_loop_cart', 'fw_loop_cart');
    function fw_loop_cart() {
        global $product;
        return sprintf( '<div class="add-to-cart-container"><a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="%s product_type_%s single_add_to_cart_button btn  btn-block %s"> %s</a></div>',
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

    function fw_loop_container($atts = [], $content = null){
        global $product;
        error_log('sds');
        return '<a href="'.$product->get_permalink($product->id).'">'.do_shortcode(stripslashes(htmlspecialchars_decode($content))).'</a>';
    
    }

    add_shortcode('fw_loop_container', 'fw_loop_container');

    function woo_loop_code(){
        return do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('woo_loop_code'))));
    }
}
echo woo_loop_code();
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
