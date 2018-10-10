<?php //if not woocommerce_after_shop_loop_item close with </a> at the end?>
<style type="text/css">
.fw_product_loop .woocommerce-loop-product__title{

    line-height:20px;
    padding:5px;
    text-align: center
}
.fw_product_loop{
    border-radius: 5px;
    border: 1px solid #d8d8d8;
    box-sizing: border-box;
    overflow: hidden;
}
.fw_product_loop .meta{
    background:#F0F0F0 !important;
    overflow: hidden;
    padding:4px;
}
.fw_product_loop .price del{
    display: block!important;
}
.fw_product_loop .price del span{
    font-weight: normal;;
    color:grey !important;
    font-size: 12px !important;
}
.fw_product_loop .price span{
    font-size:16px !important;
    font-weight:bold;
}
.fw_product_loop .add_to_cart_button {
    background:var(--main);
    border: 1px solid var(--main);;
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


?>
</a>
<?
echo fw_price_html1($product);
?>
