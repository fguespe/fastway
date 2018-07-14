<style type="text/css">
#productloop_desktop .add_to_cart_button{
font-size:0px;
border-radius:0px ;
border:0px;
border-left:1px solid grey;
line-height: 1.5 !important;
}
#productloop_desktop .add_to_cart_button:before{
content:"\f07a" !important;
font-family:"fontawesome" !important;
color:black !important;
font-size:20px !important;
padding:0px !important;
}

#productloop_desktop{
font-family:'GOTHAMRND-MEDIUM_0','Arial','sans-serif';
border:1px solid grey;
float:left;
}
#productloop_desktop .woocommerce-loop-product__title{
font-size:13px;
 min-height: 52px !important;
border-bottom:1px solid grey;
border-top:1px solid grey;
padding:5px;

line-height: inherit !important;

}

#productloop_desktop .price{
vertical-align: middle !important;
padding:0px !important;
margin:0px !important;
line-height: inherit !important;
}
#productloop_desktop .price {
color:black !important;
font-size:25px;
line-height:40px !important;
float:left !important;
margin:0 auto !important;
display:block !important;
float:left !important;
}
.added_to_cart{
float:left !important;
position: absolute !important;
width:100% !important;
}

</style>
<div id="productloop_desktop" class='d-none d-md-block'>
    <div>
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
    do_action( 'woocommerce_shop_loop_item_title' );?>
    </div>
    <div class="pull-left ">
    <span class="price">$<?php echo $product->regular_price;?></span>
    </div>
    <div class="pull-right">
    <?    do_action( 'woocommerce_after_shop_loop_item' );    ?>
    </div>
 

</div>