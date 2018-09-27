<style type="text/css">
.fw_product_loop .woocommerce-loop-product__title{
    font-size:12px !important;
    line-height:12px !important;
}
</style>
    <?php
    /**
     * woocommerce_before_shop_loop_item hook.
     *
     * @hooked woocommerce_template_loop_product_link_open - 10
     */
    do_action( 'woocommerce_before_shop_loop_item' );

    /**
     * woocommerce_before_shop_loop_item_title hook.
     *
     * @hooked woocommerce_show_product_loop_sale_flash - 10
     * @hooked woocommerce_template_loop_product_thumbnail - 10
     */
    do_action( 'woocommerce_before_shop_loop_item_title' );

    /**
     * woocommerce_shop_loop_item_title hook.
     *
     * @hooked woocommerce_template_loop_product_title - 10
     */
    do_action( 'woocommerce_shop_loop_item_title' );

    /**
     * woocommerce_after_shop_loop_item_title hook.
     *
     * @hooked woocommerce_template_loop_rating - 5
     * @hooked woocommerce_template_loop_price - 10
     */
    do_action( 'woocommerce_after_shop_loop_item_title' );

    ?>
