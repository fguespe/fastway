<?php //if not woocommerce_after_shop_loop_item close with </a> at the end?>
<style type="text/css">
.fw_product_loop .woocommerce-loop-product__title{
font-size:12px ;
min-height:25px;;
line-height:12px ;
text-align:left ;
text-transform:uppercase ;
color: #35434e ;
margin-top:10px;
margin-bottom:10px;
font-weight:600 ;
}
.fw_product_loop img{
max-height:250px;
width:auto ;
margin:0 auto;
}
.fw_product_loop{
background:white;
padding:10px;
}

.fw_product_loop .price span{
color:black ;
font-size:20px ;
line-height:20px ;
font-weight:bold;
}

.fw_product_loop .monthly{
color:#ff710b ;
font-size:13px ;
line-height:14px ;
font-weight:bold ;
text-transform:uppercase ;
display:block ;
margin-top:15px;
}
.fw_product_loop .star-rating{
  display: none;
}
.fw_product_loop{
float:left ;
width:100% ;
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
    $precio=$product->regular_price;
    if($product->is_on_sale()){
        $precio=$product->sale_price;
    }
    ?>
    <span class="monthly"> 12 CUOTAS SIN INTERES DE $<?php echo round($precio/12); ?></span>
    </a>
    