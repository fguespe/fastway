<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'fastway' ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout fw_checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
<div class="mostrar" style="display:none;text-align:center;width:100%;">
  <i class="fal fa-sync fa-spin" style="color:var(--main);width:100%;font-size:80px !important;margin-bottom:50px;"></i>
  <span>Estamos procesando su pedido...aguarde unos segundos.</span>
</div>
<style>

form.processing div:not(.mostrar){
display:none;
}

form.processing .mostrar{
display:block !important;

}
</style>
		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
    <div class="col-lg-7 col-sm-12">
      <div class="fw_checkout-main" id="customer_details">
         <div class="woocommerce-billing-fields">
            <?php do_action( 'woocommerce_checkout_billing' ); ?>
            <?php do_action( 'woocommerce_checkout_shipping' ); ?>
         </div>
         
      </div>

      
      
      
      <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

      <div id="order_review" class="woocommerce-checkout-review-order"></div>

      <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

   </div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>


   <div class="col-lg-5  col-sm-12" >
    <div class="inner-wrapper-sticky" style="position: relative; transform: translate3d(0px, 0px, 0px);">
    <div class="fw_summary-box" style="background:white;">

    <h3 id=""><?php echo __('Order details','woocommerce')?></h3>
        <a href="<?=wc_get_cart_url()?>" style="font-size:12px;"><?php echo __('Return to cart','woocommerce')?></a>
        <div class="fw_promo" style="">
          <div id="show-promo-form">
              Got promo code?
              <span class="fw_arrow">
                <i class="fa fa-arrow-down" id="coupon" onclick="abrir()"></i>
              </span>
          </div>
          <script>
            function abrir(event){
              jQuery('.fw_promo-content').toggle();
            }
          </script>
          <div class="fw_promo-content" style="display:none;">

            <span class="woocommerce-input-wrapper">
              <input type="text" name="coupon_code" class="form-control" placeholder="<?php esc_attr_e( 'Coupon code', 'fastway' ); ?>" id="coupon_code" value="" />
            </p>

            <p class="form-row form-row-last">
              <input type="submit" class="btn " name="apply_coupon" value="<?php _e( 'Aplicar Código', 'fastway' ); ?>" />
            </p>

              <div class="clear"></div>
              </form>
          </div>
        </div>
        <div id="order_review" class="woocommerce-checkout-review-order">
          <table class="shop_table woocommerce-checkout-review-order-table"></table>
        </div>
        <div class="fw_block-overlay"></div>
    </div>
    <h3 id="" class="mt20" style="margin-top:30px;"><?php echo 'Seleccione una forma de pago'//__('Payment method','woocommerce')?></h3>
    <div id="payment" class="woocommerce-checkout-payment">
        <?php do_action( 'woocommerce_checkout_order_review' ); ?>
      </div>
    <p class="description">
        <!-- El mejor precio garantizado -->
    </p>
</form>


<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>



