<style type="text/css">
.product-loop-7 .woocommerce-loop-product__title{
font-size:14px !important;
line-height:20px;
padding:5px;
}
.product-loop-7{
    border-radius: 5px;
    border: 1px solid #d8d8d8;
    
    box-sizing: border-box;
    overflow: hidden;
}
.product-loop-7 .meta{
background:#F0F0F0 !important;
overflow: hidden;
padding:4px;
}
.product-loop-7 .price del{
display:block !important;
color:grey;
}
.product-loop-7  .price span{
font-size:16px !important;
font-weight:bold;
}
.product-loop-7 .add_to_cart_button {
background: #52c76b;
    border: 1px solid #3aac4f;
    border-radius: 5px;
    color: #fff !important;
    display: block;
    font-size: 15px;
    font-weight: 600;
    line-height: 33px;
    text-align: center;
    transition: all 
}
</style>
<div class='productloop_desktop d-none d-md-block product-loop-7'>
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
    <div class="meta">
    <div class="pull-left ">
    <span class="price">
        <del>$<?php echo $product->regular_price;?></del>
        <span>$<?php echo $product->regular_price;?><span>
    </span>
    </div>
    <div class="pull-right">
    <?    do_action( 'woocommerce_after_shop_loop_item' );    ?>
    </div>
    </div>
    

</div>