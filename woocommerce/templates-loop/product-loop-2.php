<style type="text/css">
#productloop_desktop .woocommerce-loop-product__title{
    margin: 5px 0 10px;
    text-transform: uppercase;
    text-align: left;
    color: #D1030F;
    font-weight: bold;
}
#productloop_desktop  .price .woocommerce-Price-amount.amount{
    font-size: 30px;
    line-height: 40px;
    font-weight: bold;
    color: #D1030F;
    text-align: left;
    margin-right: 4px;
}
#productloop_desktop{
    border: 1px solid #ccc;
}

#productloop_desktop .add-to-cart-container .add_to_cart_button{
    color: #fff;
    text-transform: uppercase;
    font-size: 16px;
    font-weight: 700;
    background-color: #D1030F;
    padding: 10px;
    border-radius: 4px;
    border:0px;
    width:50%;
    margin:auto;
}

</style>
<div id="productloop_desktop" class='d-none d-md-block'>
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

    /**
     * woocommerce_after_shop_loop_item hook.
     *
     * @hooked woocommerce_template_loop_product_link_close - 5
     * @hooked woocommerce_template_loop_add_to_cart - 10
     */
     ?>
     <p class="nscproduct_extra">Oferta en 1 Pago</p>
     <?
    do_action( 'woocommerce_after_shop_loop_item' );
    ?>
</div>