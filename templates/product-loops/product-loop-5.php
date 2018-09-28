<?php //if not woocommerce_after_shop_loop_item close with </a> at the end?>
<style type="text/css">
.fw_product_loop .woocommerce-loop-product__title{
    font-size:12px !important;
    line-height:12px !important;
    margin-bottom: 20px !important;
}

.fw_product_loop .price span{
    color:var(--main) !important;
}

.fw_product_loop .add-to-cart-container a{
    border-radius:4px !important;
    max-width:90%;
    margin-top: 30px !important;
    border-color: var(--main) !important;
}
@media (min-width: 799px) {
    .woocommerce-page ul.products li{
        border-left:1px solid grey;
        border-top:1px solid grey;

        padding:10px !important;
    }
    .woocommerce-page ul.products li.last{
        border-right:1px solid grey;

    }
    .woocommerce-page ul.products li{
        width: 25% !important;
        margin:0px !important;
        background:#FFFFFF;
    }
}


.fw_product_loop  .woocommerce-loop-product__link img{
    max-width:150px;
    margin:0 auto !important;
    margin-bottom:30px !important;
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

    
    do_action( 'woocommerce_after_shop_loop_item' );
    ?>
