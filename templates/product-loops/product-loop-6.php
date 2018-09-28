<?php //if not woocommerce_after_shop_loop_item close with </a> at the end?>
<style type="text/css">
.fw_product_loop .woocommerce-loop-product__title{
font-size:12px !important;
min-height:25px;;
line-height:12px !important;
text-align:left !important;
text-transform:uppercase !important;
color: #35434e !important;
margin-top:10px;
margin-bottom:10px;
font-weight:600 !important;
}
.fw_product_loop img{
max-height:250px;
width:auto !important;
margin:0 auto;
}
.fw_product_loop{
background:white;
padding:10px;
}

.fw_product_loop .price span{
color:black !important;
font-size:20px !important;
line-height:20px !important;
font-weight:bold;
}

.fw_product_loop .monthly{
color:#ff710b !important;
font-size:13px !important;
line-height:14px !important;
font-weight:bold !important;
text-transform:uppercase !important;
display:block ;
margin-top:15px;
}
</style>
<?php
    global $product;
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
    <span class="monthly"> 6 CUOTAS SIN INTERES DE $<?php echo round($product->regular_price/6); ?></span>
    </a>
    